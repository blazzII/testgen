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
<?php 
    /*if (isset($message)) {
    echo $message;
    }*/
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
    }
    if (isset($message)) {
        echo $message;
    }
?>
                    <form action="/accounts/index.php" method="post">
                        <div class="imgcontainer">
                            <img src="/images/site/free-vector-roadrunner_053395_roadrunner.png" alt="Avatar" class="avatar">
                        </div>

                        <div class="container">
                            <label for="clientEmail"><b>Email:</b></label>
                            <input type="email" placeholder="Enter Email" name="clientEmail" id="clientEmail" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>>

                            <label for="clientPassword"><b>Password:</b></label><br>
                            <span>Note: Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
                            <input type="password" placeholder="Enter Password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                            <label for="remember">
                            <input type="checkbox" checked="checked" name="remember" id="remember" value="1"> Remember me<br>
                            <button class="login" type="submit">Login</button>
                            <input type="hidden" name="action" value="submitLogin">
                            </label>
                        </div>
                    </form>
                    <form action="/accounts/index.php" method="post">
                        <div class="container">
                            <input type="hidden" name="action" value="registerPage">
                            <label>
                            <b>New Here?</b><br>
                            </label>
                            <button class="register" type="submit">Create New Account</button>
                        </div>
                    </form>
                </main>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
        </div>
    </body>
</html>
<?php unset($_SESSION['message']); ?>