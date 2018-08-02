<?php include $_SERVER['DOCUMENT_ROOT'] . '/common/session.php'; ?>
<?php 
if(!empty($_SESSION)) {
    if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel']==1) {
        header('Location: /');
        exit;
    }
} else {
    header('Location: /');
    exit;    
}
$catList = '<br><br><label for="categoryIdType"><b>Product Category:&nbsp;&nbsp;</b></label>';
$catList .= '<select name="categoryIdType" id="categoryIdType">';
$catList .= '<option>Choose a Category</option>';
foreach ($categories as $category) {
    $catList .= "<option value=\"$category[categoryId]\"";
    if(isset($categoryIdType)){
        if($category['categoryId'] === $categoryIdType){
            $catList .= ' selected ';
        }
     } elseif (isset($prodInfo['categoryId'])) {
            if($category['categoryId'] === $prodInfo['categoryId']){
                $catList .= ' selected ';
        }
    }
    $catList .= ">$category[categoryName]</option>";
}
$catList .= '</select><br><br>';

?>
<!DOCTYPE html>
<html class="no-js" lang="">
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/head.php'; ?>
    </head>
    <body>
        <div class="flex-container">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/header.php'; ?>
            
            <div class="main_child">
                <main>
<?php 
    if (isset($message)) {
    echo $message;
    }
?>
                    <form action="/products/index.php" method="post" id="modProdForm">
                        <div class="container">
                        <h1><?php if(isset($prodInfo['invName'])){ echo "Modify $prodInfo[invName] ";} elseif(isset($invName)) { echo $invName; }?></h1>
                            <p>Please fill in this form to modify the product. All fields are required.</p>
                            <hr>
<?php 
    echo $catList;
?>
                            <label for="invName"><b>Product Name:</b></label>
                            <input type="text" placeholder="Enter Product Name" name="invName" id="invName" required <?php if(isset($invName)){echo "value='$invName'";} 
                                    elseif(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; } ?>>

                            <label for="invDescription"><b>Product Description:</b></label>
                            <input type="text" placeholder="Enter Product Description" name="invDescription" id="invDescription" required <?php if(isset($invDescription)){echo "value='$invDescription'";}
                                    elseif(isset($prodInfo['invDescription'])) {echo "value='$prodInfo[invDescription]'"; } ?>>

                            <label for="invImage"><b>Product Image</b></label>
                            <input type="text" placeholder="Enter Image Path" name="invImage" id="invImage" value="/images/no-image.png" required <?php if(isset($invImage)){echo "value='$invImage'";}  
                                    elseif(isset($prodInfo['invImage'])) {echo "value='$prodInfo[invImage]'"; } ?>>

                            <label for="invThumbnail"><b>Product Thumbnail</b></label>
                            <input type="text" placeholder="Enter Imag Path" name="invThumbnail" id="invThumbnail" value="/images/no-image.png" required <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} 
                                    elseif(isset($prodInfo['invThumbnail'])) {echo "value='$prodInfo[invThumbnail]'"; } ?>>

                            <label for="invPrice"><b>Product Price</b></label>
                            <input type="number" placeholder="Enter Product Price" name="invPrice" id="invPrice" step=".01" required min="0" <?php if(isset($invPrice)){echo "value='$invPrice'";}
                                    elseif(isset($prodInfo['invPrice'])) {echo "value='$prodInfo[invPrice]'"; } ?>>

                            <label for="invStock"><b>Product Stock</b></label>
                            <input type="number" placeholder="Enter Product Stock" name="invStock" id="invStock" required min="0" max="999999" <?php if(isset($invStock)){echo "value='$invStock'";}
                                    elseif(isset($prodInfo['invStock'])) {echo "value='$prodInfo[invStock]'"; } ?>>

                            <label for="invSize"><b>Product Size</b></label>
                            <input type="number" placeholder="Enter Product Size" name="invSize" id="invSize" required min="0" max="999999" <?php if(isset($invSize)){echo "value='$invSize'";}
                                    elseif(isset($prodInfo['invSize'])) {echo "value='$prodInfo[invSize]'"; } ?>>

                            <label for="invWeight"><b>Product Weight</b></label>
                            <input type="number" placeholder="Enter Product Weight" name="invWeight" id="invWeight" required min="0" max="999999" <?php if(isset($invWeight)){echo "value='$invWeight'";}
                                    elseif(isset($prodInfo['invWeight'])) {echo "value='$prodInfo[invWeight]'"; } ?>>

                            <label for="invLocation"><b>Product Location</b></label>
                            <input type="text" placeholder="Enter Product Location" name="invLocation" id="invLocation" required <?php if(isset($invLocation)){echo "value='$invLocation'";}
                                    elseif(isset($prodInfo['invLocation'])) {echo "value='$prodInfo[invLocation]'"; } ?>>

                            <label for="invVendor"><b>Product Vendor</b></label>
                            <input type="text" placeholder="Enter Product Vendor" name="invVendor" id="invVendor" required <?php if(isset($invVendor)){echo "value='$invVendor'";}
                                    elseif(isset($prodInfo['invVendor'])) {echo "value='$prodInfo[invVendor]'"; } ?>>

                            <label for="invStyle"><b>Product Style</b></label>
                            <input type="text" placeholder="Enter Product Style" name="invStyle" id="invStyle" required <?php if(isset($invStyle)){echo "value='$invStyle'";}
                                    elseif(isset($prodInfo['invStyle'])) {echo "value='$prodInfo[invStyle]'"; } ?>>

                            <div class="clearfix">
                            <button type="submit" class="signupbtn" form="modProdForm" value="Submit">Submit</button>
                            <!-- Add the action name - value pair -->
                            <input type="hidden" name="action" value="submitProductUpdate">
                            <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} elseif(isset($invId)){ echo $invId; } ?>">
                            </div>
                        </div>
                    </form>
                </main>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
        </div>
    </body>
</html>
