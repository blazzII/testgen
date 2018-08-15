<?php 

function buildCatList() {
    $categories = getAllCategories();
    $options = "";
        foreach($categories as $category) {
            $options .= '<option value="' . $category['catID'] . '">' . htmlspecialchars($category['catName']) . '</option>';
        }
    return $options;
}

function buildFormItemCategories() {
    $numOfValues = 5; // maximum question count per category
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

// Check the password for a minimum of 8 characters, at least one 1 capital letter, at least 1 number and at least 1 special character
function checkPassword($clientPassword){
        $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])[[:print:]]{8,}$/';
        return preg_match($pattern, $clientPassword);
}

// ? testId uses current time and random number - consider
function buildRandomTestID() {
        return substr(md5(time() * rand()),0,7);
}