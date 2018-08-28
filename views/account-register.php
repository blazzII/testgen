<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/header.php'; ?>
      <main>
        <form action="/testgen/accounts/" method="post" id="regForm">
            <h2>Register</h2>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/messagecheck.php'; ?>
            <hr>
            <div class="formitem">
              <label for="accountFirstName"><strong>First Name:</strong></label>
              <input type="text" name="accountFirstName" id="accountFirstName" required <?php if(isset($accountFirstName)){echo "value='$accountFirstName'";}  ?>>
            </div>
            <div class="formitem">
              <label for="accountLastName"><strong>Last Name:</strong></label>
              <input type="text" name="accountLastName" id="accountLastName" required <?php if(isset($accountLastName)){echo "value='$accountLastName'";}  ?>>
            </div>
            <div class="formitem">
              <label for="accountEmail"><strong>Email (username):</strong></label>
              <input type="email" name="accountEmail" id="accountEmail" required size="35" <?php if(isset($accountEmail)){echo "value='$accountEmail'";}  ?>>
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
              <input class="smaller" type="button" onclick="location.href='../'" value="Cancel">
            </div>
        </form>
      </main>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>
  </body>
</html>
