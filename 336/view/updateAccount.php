<?php include $_SERVER['DOCUMENT_ROOT'] . '/common/session.php'; ?>
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
                        if (isset($_SESSION['message'])) {
                            echo $_SESSION['message'];
                        } elseif (isset($message)) {
                            echo $message;
                        }
                    ?>
                    <form action="/accounts/index.php" method="post" id="updateProfile">
                        <div class="container">
                            <h1>Change your profile</h1>
                            <p>Please update your name or email here.</p>
                            <hr>

                            <label for="clientFirstname"><b>First Name:</b></label>
                            <input type="text" placeholder="Enter First Name" name="clientFirstname" id="clientFirstname" required 
                                <?php if(isset($clientFirstname)) { echo "value=$clientFirstname"; }
                                elseif (isset($_SESSION['clientData']['clientFirstname'])) { echo "value=\"" . $_SESSION['clientData']['clientFirstname'] ."\"";}  ?>>

                            <label for="clientLastname"><b>Last Name:</b></label>
                            <input type="text" placeholder="Enter Last Name" name="clientLastname" id="clientLastname" required 
                                <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  
                                elseif (isset($_SESSION['clientData']['clientLastname'])) { echo "value=\"" . $_SESSION['clientData']['clientLastname'] ."\"";}  ?>>

                            <label for="clientEmail"><b>Email</b></label>
                            <input type="email" placeholder="Enter Email" name="clientEmail" id="clientEmail" required 
                                <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  
                                elseif (isset($_SESSION['clientData']['clientEmail'])) { echo "value=\"" . $_SESSION['clientData']['clientEmail'] ."\"";}  ?>>

                            <div class="clearfix">
                            <button type="submit" class="signupbtn" form="updateProfile" value="Submit">Update Profile</button>
                            <!-- Add the action name - value pair -->
                            <input type="hidden" name="action" value="updateProfileSubmit">
                            <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])) { echo $_SESSION['clientData']['clientId'];} 
                                elseif(isset($clientId)){ echo $clientId; } ?>">
                            </div>
                        </div>
                    </form>
                    <form action="/accounts/index.php" method="post" id="updatePw">
                        <div class="container">
                            <h1>Change your password</h1>
                            <p>Please change your password here.</p>
                            <hr>
                            <label for="clientPassword"><b>New Password</b></label><br>
                            <span>Note: Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span> 
                            <input type="password" placeholder="Enter New Password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">

                            <label for="clientPasswordRepeated"><b>Repeat Password</b></label>
                            <input type="password" placeholder="Repeat New Password" name="clientPasswordRepeated" id="clientPasswordRepeated" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" oninput="check(this)">
                            <script type='text/javascript'>
                                function check(input) {
                                    if (input.value != document.getElementById('clientPassword').value) {
                                        input.setCustomValidity('Password Must be Matching.');
                                    } else {
                                        // input is valid -- reset the error message
                                        input.setCustomValidity('');
                                    }
                                }
                            </script>

                            <div class="clearfix">
                            <button type="submit" class="signupbtn" form="updatePw" value="Submit">Change Password</button>
                            <!-- Add the action name - value pair -->
                            <input type="hidden" name="action" value="updatePwSubmit">
                            <input type="hidden" name="clientId" value="<?php if(isset($_SESSION['clientData']['clientId'])) { echo $_SESSION['clientData']['clientId'];} 
                                elseif(isset($clientId)){ echo $clientId; } ?>">
                            </div>
                        </div>
                    </form>
                </main>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
        </div>
    </body>
</html>
