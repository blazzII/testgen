<?php 

function buildCatList() {
    $categories = getAllCategories();
    $catDataList = '<datalist>';
    foreach ($categories as $category) {
        $catDataList .= '<option value="' . $category['catID'] . '">' . $category['catName'] . '</option>';
    }
    $catDataList .= '</datalist>';
    return $catDataList;
}

function buildFormItemCategories() {
    $numOfValues = 5;
    $categories = getAllCategories();
    $formItems = "";
    foreach ($categories as $category) 
    {
        $formItems .= '<div class="formitem">';
        $formItems .= '<span class="formitemlabel">' . htmlspecialchars($category['catName']) . '</span>';
        $formItems .= '<select name="' . $category['catID'] . '">';
        for ( $i = 0; $i <= $numOfValues; $i++) {
            $formItems .= '<option value="' . $i . '">' . $i . '</option>';
        }
        $formItems .= '</select>';
        $formItems .= '</div>';
    }
    return $formItems;
}

function checkEmail($clientEmail) {
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

    // Check the password for a minimum of 8 characters,
    // at least one 1 capital letter, at least 1 number and
    // at least 1 special character
    function checkPassword($clientPassword){
        $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])[[:print:]]{8,}$/';
        return preg_match($pattern, $clientPassword);
    }

    // builds a display of a single product
    function buildSingleProductDisplay($singleProduct,$prodId){
        $pd = '<div class="itemImage">';
        $pd .= '<img src="' . $singleProduct['invImage'] . '" alt="' . $singleProduct['invName'] . '" id="itemMainImage">';
        $productThumbs = getImagesByInvId($prodId);
        if ($productThumbs) {
            $pd .= buildSingleProductThumbsDisplay($productThumbs, $singleProduct['invName']);
        }
        $pd .= '</div>';
        $pd .= '<div class="itemInfo">';
        $pd .= '<ul>';
        setlocale(LC_MONETARY, 'en_US');
        $pd .= '<li><span class="itemHeading">Price:</span> <span class="itemPrice">' . money_format('%n', $singleProduct['invPrice']) . '</span> & FREE Instant Shipping</li>';
        $pd .= '<li><span class="itemHeading">Description:</span> ' . $singleProduct['invDescription'] . '</li>';
        $pd .= '<li><span class="itemHeading">Vendor:</span> ' . $singleProduct['invVendor'] . '</li>';
        $pd .= '<li><span class="itemHeading">Size:</span> ' . $singleProduct['invSize'] . ' Inches</li>';
        $pd .= '<li><span class="itemHeading">Weight:</span> ' . $singleProduct['invWeight'] . ' Pounds</li>';
        $pd .= '<li><span class="itemHeading">Stock:</span> ' . $singleProduct['invStock'] . '</li>';
        $pd .= '<li><span class="itemHeading">Ships From:</span> ' . $singleProduct['invLocation'] . '</li>';
        $pd .= '</ul>';
        $pd .= '</div>';
        return $pd;
    }



    // Build the products select list
    function buildProductsSelect($products) {
        $prodList = '<select name="invId" id="invId" class="logButton">';
        $prodList .= "<option>Choose a Product</option>";
        foreach ($products as $product) {
            $prodList .= "<option value='$product[invId]'>$product[invName]</option>";
        }
        $prodList .= '</select>';
        return $prodList;
    }

    function buildRandomTestID() {
        // using time and random number
        return substr(md5(time() * rand()),0,7);
    }