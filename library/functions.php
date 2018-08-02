<?php 

    function buildCategoryList($categories) {
        // page level?
        $navList = '<ul>';
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