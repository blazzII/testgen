<?php include $_SERVER['DOCUMENT_ROOT'] . '/shared/session.php'; ?>
<?php 
if(!empty($_SESSION)) {
    if(!$_SESSION['loggedin']) {
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
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/shared/head.php'; ?>
    </head>
    <body>
        <div class="flex-container">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/shared/header.php'; ?>
            
            <div class="main_child">
                <main>
                    <div class="accountCard">
                        <h1><?php echo $_SESSION['clientData']['clientFirstname'] . ' ' . $_SESSION['clientData']['clientLastname']; ?></h1>
                        <?php 
                            if (isset($_SESSION['message'])) {
                                echo $_SESSION['message'];
                            } elseif (isset($message)) {
                                echo $message;
                            }
                        ?>
                        <ul>
                            <?php echo $_SESSION['clientData']['clientLevel']; ?></span></li>-->
                            <li><strong>You are currently logged in.<br>Session Time Remaining:</strong>&nbsp;&nbsp;&nbsp;<span><?php echo number_format(($_SESSION['timeout']-time())/60, 1, '.', '') . ' Minutes'; ?></span></li>
                            <li><strong>Email Address:</strong>&nbsp;&nbsp;&nbsp;<span><?php echo $_SESSION['clientData']['clientEmail']; ?></span></li>
                        </ul>
                        <p><a href="/accounts/index.php?action=updateAccount" class="accountButton"><strong>Update Your Account Information</strong></a></p>
                        <?php 
                            if($_SESSION['clientData']['clientLevel']>1) {
                                echo '<br><br><h2>For product administration, please click the link below:</h2>';
                                echo '<p><a href="/products/" class="accountButton"><strong>Product Management</strong></a></p>';
                                echo '<br><br><h2>For image administration, please click the link below:</h2>';
                                echo '<p><a href="/uploads/" class="accountButton"><strong>Image Management</strong></a></p>';
                            }
                        ?>
                    </div>
                </main>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/shared/footer.php'; ?>
        </div>
    </body>
</html>
<?php unset($_SESSION['message']); ?>