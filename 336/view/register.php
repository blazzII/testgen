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
    if (isset($message)) {
    echo $message;
    }
?>
                    <form action="/accounts/index.php" method="post" id="regForm">
                        <div class="container">
                            <h1>Sign Up</h1>
                            <p>Please fill in this form to create an account. All fields are required.</p>
                            <hr>

                            <label for="clientFirstname"><b>First Name:</b></label>
                            <input type="text" placeholder="Enter First Name" name="clientFirstname" id="clientFirstname" required <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?>>

                            <label for="clientLastname"><b>Last Name:</b></label>
                            <input type="text" placeholder="Enter Last Name" name="clientLastname" id="clientLastname" required <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?>>

                            <label for="clientEmail"><b>Email</b></label>
                            <input type="email" placeholder="Enter Email" name="clientEmail" id="clientEmail" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>>

                            <label for="clientPassword"><b>Password</b></label><br>
                            <span>Note: Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span> 
                            <input type="password" placeholder="Enter Password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">

                            <label for="clientPasswordRepeated"><b>Repeat Password</b></label>
                            <input type="password" placeholder="Repeat Password" name="clientPasswordRepeated" id="clientPasswordRepeated" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" oninput="check(this)">
                            <script language='javascript' type='text/javascript'>
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
                            <button type="submit" class="signupbtn" form="regForm" value="Submit">Sign Up</button>
                            <!-- Add the action name - value pair -->
                            <input type="hidden" name="action" value="registerSubmit">
                            </div>
                        </div>
                    </form>
                </main>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
        </div>
    </body>
</html>
