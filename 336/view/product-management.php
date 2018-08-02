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
?><!DOCTYPE html>
<html class="no-js" lang="">
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/head.php'; ?>
    </head>
    <body>
        <div class="flex-container">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/header.php'; ?>
            
            <div class="main_child">
                <main>
                    <div class="accountCard">
                        <?php 
                            if (isset($_SESSION['message'])) {
                                echo $_SESSION['message'];
                            } elseif (isset($message)) {
                                echo $message;
                            }
                        ?>
                        <h1>Product Management Home</h1>
                        <p><a href="/products/index.php?action=newCategory" class="accountButton">Add New Category</a></p>
                        <p><a href="/products/index.php?action=newProduct" class="accountButton">Add New Product</a></p>
                        <?php
                            if (isset($prodList)) {
                                echo $prodList;
                            }
                        ?>
                    </div>
                </main>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
        </div>
    </body>
</html>
<?php unset($_SESSION['message']); ?>