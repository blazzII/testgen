<?php include $_SERVER['DOCUMENT_ROOT'] . '/common/session.php'; ?>
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
                    <h1 class="categoryTitle"><?php echo $type; ?> Products</h1>
                    <?php 
                            if (isset($_SESSION['message'])) {
                                echo $_SESSION['message'];
                            } elseif (isset($message)) {
                                echo $message;
                            }
                    ?>
                    <?php if(isset($prodDisplay)){ echo $prodDisplay; } ?>
                </main>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
        </div>
    </body>
</html>
