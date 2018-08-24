<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/header.php'; ?>   
      <main>
        <h2>Login</h2>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/messagecheck.php'; ?>

        <form action="/testgen/accounts/" method="post">    
          <hr>
          <div class="formitem">
            <input type="email" placeholder="Email" name="accountEmail" id="accountEmail" required <?php if(isset($accountEmail)){echo "value='$accountEmail'";}  ?>>
          </div>           
          <div class="formitem">
            <input type="password" placeholder="Password" name="accountPassword" id="accountPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
          </div>
          <hr>
          <div class="formitem">
            <input type="submit" value="Login">
            <a href="./?action=retrievePasswordView">&#9757; Forgot Your Password?</a>
            <input type="hidden" name="action" value="login">
          </div>  
        </form>

            
        <form action="./" method="post">
          <div class="formitem">
            <input type="hidden" name="action" value="registrationView">
            <input class="smallerFont" type="submit" value="Create New Account">
          </div>
        </form>

      </main>
      <aside>
        or ...
        <form action="/testgen/tests/" method="post">
          <input class="menubutton" type="submit" value="Take a Test">
          <input type="hidden" name="action" value="testSelectView">
        </form>  
      </aside>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>

  </body>
</html>
<?php unset($_SESSION['message']); ?>