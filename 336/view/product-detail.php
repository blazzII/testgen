<?php include $_SERVER['DOCUMENT_ROOT'] . '/common/session.php'; ?>
<!DOCTYPE html>
<html class="no-js" lang="">
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/head.php'; ?>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.imageThumb').click(function(){
                    $('#itemMainImage').attr('src',$(this).attr('src').replace('-tn',''));
                });
            });
        </script>
    </head>
    <body>
        <div class="flex-container">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/header.php'; ?>
            
            <div class="main_child">
                <main>
                    <div class="itemDisplay">    
                        <h1><?php echo $singleProduct['invName']; ?></h1>
                        <?php 
                                if (isset($_SESSION['message'])) {
                                    echo $_SESSION['message'];
                                } elseif (isset($message)) {
                                    echo $message;
                                }
                        ?>
                        <?php if(isset($prodDisplay)){ echo $prodDisplay; } ?>
                        
                    </div>
                </main>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
        </div>
    </body>
</html>
