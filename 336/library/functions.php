<?php 

    // get categories array and build unordered list for menu
    function buildNavList($categories) {
        // Build a navigation bar using the $categories array
        $navList = '<ul class="siteNav" id="siteNav">';
        $navList .= "<li class=\"icon\"><a href=\"javascript:void(0);\" onclick=\"myFunction()\"><i class=\"fa fa-bars\"></i></a></li>";
        $navList .= "<li><a href='/' title='View the Acme home page'>Home</a></li>";
        foreach ($categories as $category) {
            $navList .= "<li><a href='/products/index.php?action=category&type=".urlencode($category['categoryName'])."' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
        }
        $navList .= '</ul>';
        $navList .= '<script>function myFunction() {';
        $navList .= '   var x = document.getElementById("siteNav");';
        $navList .= '    if (x.className === "siteNav") {';
        $navList .= '        x.className += "_responsive";';
        $navList .= '    } else {';
        $navList .= '        x.className = "siteNav"; } }';
        $navList .= '</script>';
        return $navList;
    }

    function checkEmail($clientEmail){
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

    // Check the price for valid format
    function checkPrice($invPrice){
        $pattern = '/^\d+(?:\.\d{2})?$/';
        return preg_match($pattern, $invPrice);
    }

    // builds a display of products in a <ul>
    function buildProductsDisplay($products){
        $pd = '<ul id="prod-display">';
        foreach ($products as $product) {
         $pd .= '<li><a href="/products/index.php?action=viewProduct&product=' . $product["invId"] . '"><div class="productImage">';
         $pd .= "<img src='$product[invThumbnail]' alt='Image of $product[invName] on Acme.com'></div>";
         $pd .= '<hr>';
         $pd .= "<h2>$product[invName]</h2>";
         setlocale(LC_MONETARY, 'en_US');
         $pd .= "<div class=\"productPrice\">" . money_format('%n', $product['invPrice']) . "</div></a>";
         $pd .= '</li>';
        }
        $pd .= '</ul>';
        return $pd;
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
    

    /* * ********************************
    * Functions for working with images
    * ********************************* */

    // Adds "-tn" designation to file name
    function makeThumbnailName($image) {
        $i = strrpos($image, '.');
        $image_name = substr($image, 0, $i);
        $ext = substr($image, $i);
        $image = $image_name . '-tn' . $ext;
        return $image;
    }

    // Build images display for image management view
    function buildImageDisplay($imageArray) {

        $id = '<table>';
        $id .= '<thead>';
        $id .= '<tr><th>Product Name</th><td>&nbsp;</td></tr>';
        $id .= '</thead>';
        $id .= '<tbody>';
        foreach ($imageArray as $image) {
            $id .= "<tr><td><p>$image[imgName]</p><a href='/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image' class=\"deleteButton2\">Delete</a></td>";
            $id .= "<td><a href='$image[imgPath]'><img src='$image[imgPath]' title='$image[invName] image on Acme.com' alt='$image[invName] image on Acme.com' class='adminImage'></a></td></tr>";
            
        }
        $id .= '</tbody></table>';



        /*$id = '<ul id="image-display">';
        foreach ($imageArray as $image) {
            $id .= '<li>';
            $id .= "<img src='$image[imgPath]' title='$image[invName] image on Acme.com' alt='$image[invName] image on Acme.com'>";
            $id .= "<p><a href='/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image' class=\"logButton\">Delete $image[imgName]</a></p>";
            $id .= '</li>';
        }
        $id .= '</ul>';*/
        return $id;
    }

    //build thumbnail display for a single product page
    function buildSingleProductThumbsDisplay($thumbsArray, $invName) {
        $td = '<div class="productThumbs" id="productThumbs"><p>' . $invName . ' Thumbnails:</p><ul id="thumbs-display">';
        foreach ($thumbsArray as $thumb) {
            $td .= '<li>';
            $td .= "<img src='$thumb[imgPath]' title='$thumb[imgName] image on Acme.com' alt='$thumb[imgName] image on Acme.com' class='imageThumb'>";
            $td .= '</li>';
        }
        $td .= '</ul></div>';
        return $td;
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

    // Handles the file upload process and returns the path
    // The file path is stored into the database
    function uploadFile($name) {
        // Gets the paths, full and local directory
        global $image_dir, $image_dir_path;
        if (isset($_FILES[$name])) {
            // Gets the actual file name
            $filename = urlencode($_FILES[$name]['name']);
            if (empty($filename)) {
                return;
            }
            // Get the file from the temp folder on the server
            $source = $_FILES[$name]['tmp_name'];
            // Sets the new path - images folder in this directory
            $target = $image_dir_path . '/' . $filename;
            // Moves the file to the target folder
            move_uploaded_file($source, $target);
            // Send file for further processing
            processImage($image_dir_path, $filename);
            // Sets the path for the image for Database storage
            $filepath = $image_dir . '/' . $filename;
            // Returns the path where the file is stored
            return $filepath;
        }
    }

    // Processes images by getting paths and 
    // creating smaller versions of the image
    function processImage($dir, $filename) {
        // Set up the variables
        $dir = $dir . '/';
    
        // Set up the image path
        $image_path = $dir . $filename;
    
        // Set up the thumbnail image path
        $image_path_tn = $dir.makeThumbnailName($filename);
    
        // Create a thumbnail image that's a maximum of 200 pixels square
        resizeImage($image_path, $image_path_tn, 200, 200);
    
        // Resize original to a maximum of 500 pixels square
        resizeImage($image_path, $image_path, 500, 500);
    }

    // Checks and Resizes image
    function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {

        // Get image type
        $image_info = getimagesize($old_image_path);
        $image_type = $image_info[2];
    
        // Set up the function names
        switch ($image_type) {
            case IMAGETYPE_JPEG:
                $image_from_file = 'imagecreatefromjpeg';
                $image_to_file = 'imagejpeg';
                break;
            case IMAGETYPE_GIF:
                $image_from_file = 'imagecreatefromgif';
                $image_to_file = 'imagegif';
                break;
            case IMAGETYPE_PNG:
                $image_from_file = 'imagecreatefrompng';
                $image_to_file = 'imagepng';
                break;
            default:
                return;
        }
    
        // Get the old image and its height and width
        $old_image = $image_from_file($old_image_path);
        $old_width = imagesx($old_image);
        $old_height = imagesy($old_image);
    
        // Calculate height and width ratios
        $width_ratio = $old_width / $max_width;
        $height_ratio = $old_height / $max_height;
    
        // If image is larger than specified ratio, create the new image
        if ($width_ratio > 1 || $height_ratio > 1) {
        
            // Calculate height and width for the new image
            $ratio = max($width_ratio, $height_ratio);
            $new_height = round($old_height / $ratio);
            $new_width = round($old_width / $ratio);
        
            // Create the new image
            $new_image = imagecreatetruecolor($new_width, $new_height);
        
            // Set transparency according to image type
            if ($image_type == IMAGETYPE_GIF) {
                $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
                imagecolortransparent($new_image, $alpha);
            }
        
            if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
                imagealphablending($new_image, false);
                imagesavealpha($new_image, true);
            }
        
            // Copy old image to new image - this resizes the image
            $new_x = 0;
            $new_y = 0;
            $old_x = 0;
            $old_y = 0;
            imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
        
            // Write the new image to a new file
            $image_to_file($new_image, $new_image_path);
            // Free any memory associated with the new image
            imagedestroy($new_image);
        } else {
            // Write the old image to a new file
            $image_to_file($old_image, $new_image_path);
        }
        // Free any memory associated with the old image
        imagedestroy($old_image);
    }