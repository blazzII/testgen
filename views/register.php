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
            <h2>Register</h2>
            <hr>
            <div class="formitem">
              <label for="accountFirstname"><strong>First Name:</strong></label>
              <input type="text" name="accountFirstname" id="accountFirstname" required <?php if(isset($accountFirstname)){echo "value='$accountFirstname'";}  ?>>
            </div>
            <div class="formitem">
              <label for="accountLastname"><strong>Last Name:</strong></label>
              <input type="text" name="accountLastname" id="accountLastname" required <?php if(isset($accountLastname)){echo "value='$accountLastname'";}  ?>>
            </div>
            <div class="formitem">
              <label for="accountEmail"><strong>Email (username):</strong></label>
              <input type="email" name="accountEmail" id="accountEmail" required <?php if(isset($accountEmail)){echo "value='$accountEmail'";}  ?>>
            </div>
            <div class="formitem">
              <label for="accountPassword"><strong>Password:</strong></label>
              <input type="password" name="accountPassword" id="accountPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
            </div>  
            <div class="msg info">Note: Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</div> 
            <div class="formitem">
              <label for="accountPasswordRepeated"><strong>Repeat Password:</strong></label>
              <input type="password" name="accountPasswordRepeated" id="accountPasswordRepeated" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" oninput="check(this)">
                <script>
                  function check(input) {
                    if (input.value != document.getElementById('accountPassword').value) {
                      input.setCustomValidity('Password Must be Matching.');
                    } else {
                      input.setCustomValidity('');
                    }
                  }
                </script>
            </div>
            <hr>
            <div class="formitem">
              <input type="submit" form="regForm" value="Register New Account">
              <input type="hidden" name="action" value="registration">
            </div>
            <div class="formitem">
              <input class="smaller" type="button" onclick="location.href='/testgen/'" value="Cancel">
            </div>
        </form>
      </main>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>
  </body>
</html>
