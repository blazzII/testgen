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
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/shared/head.php'; ?>
    </head>
    <body>
        <div class="flex-container">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/shared/header.php'; ?>
                <main>
                        <h1><?php echo $_SESSION['accountData']['accountFirstName'] . ' ' . $_SESSION['accountData']['accountLastName']; ?></h1>
                        <?php 
                            if (isset($_SESSION['message'])) {
                                echo $_SESSION['message'];
                            } elseif (isset($message)) {
                                echo $message;
                            }
                        ?>
                        <section>
                            <h2>Admin Menu</h2>
                        <ul>
                            <?php echo $_SESSION['accountData']['accountLevel']; ?></span></li>
                            <li><?php echo number_format(($_SESSION['timeout']-time())/60, 1, '.', '') . ' Minutes'; ?></span></li>
                            <li>Manage Test Categories</li>
                            <li>Manage Accounts</li>
                            <li>Manage Tests</li>

                        </ul>
                        </section>
                </main>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/shared/footer.php'; ?>
        </div>
    </body>
</html>
<?php unset($_SESSION['message']); ?>