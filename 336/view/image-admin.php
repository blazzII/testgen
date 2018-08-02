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
                        <h1>Image Management</h1>
                        <?php 
                                    if (isset($_SESSION['message'])) {
                                        echo $_SESSION['message'];
                                    } elseif (isset($message)) {
                                        echo $message;
                                    }
                        ?>
                        <p>
                            Welcome to the image management page.  Please choose one of the following options:
                        </p>
                        <div class="imageAccountCard accountCard">
                            <h2>Add New Product Image</h2>

                            <form action="/uploads/" method="post" enctype="multipart/form-data" id="uploadForm">
                                <label for="invItem">Product</label><br>
                                <?php echo $prodSelect; ?><br><br>
                                <label>Upload Image:</label><br>
                                <input type="file" name="file1" class="logButton"><br>
                                <input type="submit" class="logButton" value="Upload">
                                <input type="hidden" name="action" value="upload">
                            </form>
                        </div>

                        <div class="imageAccountCard accountCard">
                            <h2>Existing Images</h2>
                            <p class="displayMessage">If deleting an image, delete the thumbnail too and vice versa.</p>
                            <div class="itemDisplay, accountCard">
                                <?php
                                    if (isset($imageDisplay)) {
                                    echo $imageDisplay;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
        </div>
    </body>
</html>
<?php unset($_SESSION['message']); ?>