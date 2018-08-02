<?php 

/*
------------------------------------------------
PRODUCTS CONTROLLER FILE
------------------------------------------------
*/
// Create or access a Session
session_start();
// Get the database connection file
require_once '../library/connections.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the products model
require_once '../model/products-model.php';
// Get the uploads model
require_once '../model/uploads-model.php';
// Get the misc. functions
require_once '../library/functions.php';
// Get the array of categories
$categories = getCategories();

// get the navList
$navList = buildNavList($categories);


// $catList = '<br><br><label for="categoryId"><b>Product Category:&nbsp;&nbsp;</b></label>';
// $catList .= '<select name="categoryId" id="categoryId">';
// foreach ($categories as $category) {
//     $catList .= "<option value=\"$category[categoryId]\">$category[categoryName]</option>";
// }
// $catList .= '</select><br><br>';

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    }

switch ($action) {
    case 'newCategory':
        $pageTitle = 'New Category';
        include '../view/new-category.php';
        break;
    case 'newProduct':
        $pageTitle = 'New Product';
        include '../view/new-product.php';
        break;
    case 'submitNewCategory':
        // Filter and store the data
        $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);
        $pageTitle = 'New Category';
        // Check for missing data
        if(empty($categoryName)){
            $message = '<div class="displayErrMessage">Please provide information for all empty form fields.</div>';
            include '../view/new-category.php';
            exit; 
        }
        // Send the data to the model
        $addCatResult = addCategory($categoryName);

        // Check and report the result
        if($addCatResult === 1){
            //$message = "<div class=\"displayMessage\">$categoryName added successfully.</div>";
            header("Location: /products/");
            exit;
        } else {
            $message = "<div class=\"displayErrMessage\">Sorry, adding $categoryName failed. Please try again.</div>";
            include '../view/new-category.php';
            exit;
        }
        break;
    case 'submitNewProduct':
        // Filter and store the data
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
        $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
        $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
        $categoryIdType = filter_input(INPUT_POST, 'categoryIdType', FILTER_SANITIZE_NUMBER_INT);
        $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
        $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
        $checkPrice = checkPrice($invPrice);

        $pageTitle = 'New Product';
        //check for empty or invalid price
        if(empty($checkPrice)) {
            $message = '<div class="displayErrMessage">Please enter a valid price.</div>';
            include '../view/new-product.php';
            exit; 
        }

        // Check for missing data
        if(empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($checkPrice)
        || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation)
        || empty($categoryIdType) || empty($invVendor) || empty($invStyle)){
            $message = '<div class="displayErrMessage">Please provide information for all empty form fields.</div>';
/*             $message .= '<br>' . $invName 
            . ' ' . $invDescription  
            . ' ' . $invImage
            . ' ' . $invThumbnail
            . ' ' . $invPrice
            . ' ' . $invStock
            . ' ' . $invSize
            . ' ' . $invWeight
            . ' ' . $invLocation
            . ' ' . $categoryIdType
            . ' ' . $invVendor
            . ' ' . $invStyle; */
            include '../view/new-product.php';
            exit; 
        }

        // check for invalid stock, size, weight
        if($invStock > 999999 || $invStock < 0 || $invSize > 999999 || $invSize < 0 || $invWeight > 999999 || $invWeight < 0) {
            $message = '<div class="displayErrMessage">Stock, Size, and Weight must be between 0 and 999999.</div>';
            include '../view/new-product.php';
            exit; 
        }
        // Send the data to the model
        $addProdResult = addProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock
                                , $invSize, $invWeight, $invLocation, $categoryIdType, $invVendor, $invStyle);

        // Check and report the result
        if($addProdResult === 1){
            $message = "<div class=\"displayMessage\">$invName added successfully</div>";
            include '../view/product-management.php';
            exit;
        } else {
            $message = "<div class=\"displayErrMessage\">Sorry $invName submission failed. Please try again.</div>";
            include '../view/new-product.php';
            exit;
        }
        break;
    case 'mod':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
        if (isset($prodInfo['invName'])) {
            $pageTitle = "Modify $prodInfo[invName] ";
        } elseif (isset($invName)) {
            $pageTitle = "Modify $invName";
        }   
        if(count($prodInfo)<1){
            $message = 'Sorry, no product information could be found.';
        }
        include '../view/product-update.php';
        break;
    case 'submitProductUpdate';
        // Filter and store the data
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
        $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
        $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
        $categoryIdType = filter_input(INPUT_POST, 'categoryIdType', FILTER_SANITIZE_NUMBER_INT);
        $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
        $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $checkPrice = checkPrice($invPrice);

        $pageTitle = 'Modify Product';
        //check for empty or invalid price
        if(empty($checkPrice)) {
            $message = '<div class="displayErrMessage">Please enter a valid price.</div>';
            include '../view/product-update.php';
            exit; 
        }

        // Check for missing data
        if(empty($invName) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($checkPrice)
        || empty($invStock) || empty($invSize) || empty($invWeight) || empty($invLocation)
        || empty($categoryIdType) || empty($invVendor) || empty($invStyle)){
            $message = '<div class="displayErrMessage">Please provide information for all empty form fields.</div>';
            include '../view/product-update.php';
            exit; 
        }

        // check for invalid stock, size, weight
        if($invStock > 999999 || $invStock < 0 || $invSize > 999999 || $invSize < 0 || $invWeight > 999999 || $invWeight < 0) {
            $message = '<div class="displayErrMessage">Stock, Size, and Weight must be between 0 and 999999.</div>';
            include '../view/product-update.php';
            exit; 
        }
        // Send the data to the model
        $updateProdResult = updateProduct($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock
                                , $invSize, $invWeight, $invLocation, $categoryIdType, $invVendor, $invStyle, $invId);

        // Check and report the result
        if($updateProdResult === 1){
            $_SESSION['message'] = "<div class=\"displayMessage\">$invName modified successfully</div>";
            header('location: /products/');
            exit;
        } else {
            $message = "<div class=\"displayErrMessage\">Sorry $invName modification failed. Please try again.</div>";
            include '../view/product-update.php';
            exit;
        }
        break;
    case 'del';
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($invId);
        if (count($prodInfo) < 1) {
            $message = 'Sorry, no product information could be found.';
        } elseif (isset($prodInfo['invName'])) {
            $pageTitle = "Delete $prodInfo[invName] ";
        } elseif (isset($invName)) {
            $pageTitle = "Delete $invName";
        }  
        include '../view/product-delete.php';
        break;
    case 'submitProductDelete';
        // Filter and store the data
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $pageTitle = 'Delete Product';
        //check for empty or invalid price

        // Send the data to the model
        $deleteProdResult = deleteProduct($invId);

        // Check and report the result
        if($deleteProdResult === 1){
            $_SESSION['message'] = "<div class=\"displayMessage\">$invName deleted successfully</div>";
            header('location: /products/');
            exit;
        } else {
            $_SESSION['message'] = "<div class=\"displayMessage\">$invName deletion failed.  Please try again.</div>";
            header('location: /products/');
            exit;
        }
        break;
    case 'category':
        $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
        $products = getProductsByCategory($type);
        if(!count($products)){
            $message = "<p class='notice'>Sorry, no $type products could be found.</p>";
        } else {
            $prodDisplay = buildProductsDisplay($products);
        }
        $pageTitle = $type . ' Products';
        include '../view/category.php';
        break;
    case 'viewProduct':
        $prodId = filter_input(INPUT_GET, 'product', FILTER_SANITIZE_STRING);
        $singleProduct = getProductInfo($prodId);
        if (!$singleProduct) {
            $message = 'Sorry, that product could not be found or does not exist!';
        } elseif (count($singleProduct) < 1) {
            $message = 'Sorry, an error occured, please try again.';
        } elseif (isset($singleProduct['invName'])) {
            $pageTitle = $singleProduct['invName'] . " Details";
            $prodDisplay = buildSingleProductDisplay($singleProduct,$prodId);
        }
        //$productThumbs = getImagesByInvId($prodId);
        //print_r(array_values($productThumbs)); //TESTING ARRAY CONTENTS
        /*if ($productThumbs) {
            $thumbsDisplay = buildSingleProductThumbsDisplay($productThumbs);
        }*/
        include '../view/product-detail.php';
        break;
    default:
        $products = getProductBasics();
        if (count($products) > 0) {
            $prodList = '<table>';
            $prodList .= '<thead>';
            $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
            $prodList .= '</thead>';
            $prodList .= '<tbody>';
            foreach ($products as $product) {
                $prodList .= "<tr><td>$product[invName]</td>";
                $prodList .= "<td><a href='/products?action=mod&id=$product[invId]' title='Click to modify' class=\"logButton\">Modify</a></td>";
                $prodList .= "<td><a href='/products?action=del&id=$product[invId]' title='Click to delete' class=\"deleteButton\">Delete</a></td></tr>";
            }
            $prodList .= '</tbody></table>';
        } else {
            $message = '<p class="displayMessage">Sorry, no products were returned.</p>';
        }
        $pageTitle = "Product Management";
        include '../view/product-management.php';
}