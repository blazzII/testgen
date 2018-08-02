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
                    <form action="/products/index.php" method="post" id="delProdForm">
                        <div class="container">
                        <h1><?php if(isset($prodInfo['invName'])){ echo "Delete $prodInfo[invName] ";} ?></h1>
                            <p>Please confirm the deletion of this product. This delete is permanent and cannot be undone.</p>
                            <hr>
                            <label for="invName"><b>Product Name:</b></label>
                            <input type="text" placeholder="Enter Product Name" name="invName" id="invName" readonly <?php if(isset($prodInfo['invName'])) {echo "value='$prodInfo[invName]'"; } ?>>

                            <label for="invDescription"><b>Product Description:</b></label>
                            <input type="text" placeholder="Enter Product Description" name="invDescription" id="invDescription" readonly <?php if(isset($prodInfo['invDescription'])) {echo "value='$prodInfo[invDescription]'"; } ?>>

                            <div class="clearfix">
                            <button type="submit" class="signupbtn" form="delProdForm" value="Submit">Delete Product</button>
                            <!-- Add the action name - value pair -->
                            <input type="hidden" name="action" value="submitProductDelete">
                            <input type="hidden" name="invId" value="<?php if(isset($prodInfo['invId'])){ echo $prodInfo['invId'];} ?>">
                            </div>
                        </div>
                    </form>
                </main>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
        </div>
    </body>
</html>
