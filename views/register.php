<?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/session.php'; ?>
<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/header.php'; ?>
      <main>
        <?php if (isset($message)) { echo $message;} ?>
        <form action="/testgen/accounts/" method="post" id="regForm">
          <div class="formfields">
            <h1>Register</h1>
            <hr>

            <label for="accountFirstname"><b>First Name:</b></label>
            <input type="text" placeholder="Enter First Name" name="accountFirstname" id="accountFirstname" required <?php if(isset($accountFirstname)){echo "value='$accountFirstname'";}  ?>>

            <label for="accountLastname"><b>Last Name:</b></label>
            <input type="text" placeholder="Enter Last Name" name="accountLastname" id="accountLastname" required <?php if(isset($accountLastname)){echo "value='$accountLastname'";}  ?>>

                            <label for="accountEmail"><b>Email</b></label>
                            <input type="email" placeholder="Enter Email" name="accountEmail" id="accountEmail" required <?php if(isset($accountEmail)){echo "value='$accountEmail'";}  ?>>

                            <label for="accountPassword"><b>Password</b></label><br>
                            <span>Note: Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span> 
                            <input type="password" placeholder="Enter Password" name="accountPassword" id="accountPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">

                            <label for="accountPasswordRepeated"><b>Repeat Password</b></label>
                            <input type="password" placeholder="Repeat Password" name="accountPasswordRepeated" id="accountPasswordRepeated" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" oninput="check(this)">
                            <script language='javascript' type='text/javascript'>
                                function check(input) {
                                    if (input.value != document.getElementById('accountPassword').value) {
                                        input.setCustomValidity('Password Must be Matching.');
                                    } else {
                                        // input is valid -- reset the error message
                                        input.setCustomValidity('');
                                    }
                                }
                            </script>

                            <div class="clearfix">
                            <input type="submit" form="regForm" value="Register New Account">
                            <input type="hidden" name="action" value="registration">
                            </div>
                        </div>
                    </form>
                </main>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
        </div>
    </body>
</html>
