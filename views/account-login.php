<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include '../shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include '../shared/header.php'; ?>   
      <main>
        <h2>Login</h2>
        <hr>
        <?php include '../shared/messagecheck.php'; ?>
        <form action="../accounts/" method="post">    
          <div class="formitem">
            <input type="email" placeholder="Email" name="accountEmail" id="accountEmail" size="25" required <?php if(isset($accountEmail)){echo "value='$accountEmail'";}  ?>>
          </div>           
          <div class="formitem">
            <input type="password" placeholder="Password" name="accountPassword" id="accountPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
          </div>
          <div class="formitem">
            <input type="hidden" name="action" value="login">
            <input class="submit" type="submit" value="Login">
            <!-- <a href="./?action=retrievePasswordView">&#9757; Forgot Your Password?</a> -->     
          </div>  
          <div class="formitem">
              <input class="cancel" type="button" onclick="location.href='../'" value="&#10008; Cancel">
          </div>
        </form>
        <br> 
        <hr>
        <form action="./" method="post">
          <div class="formitem">
            <input type="hidden" name="action" value="registrationView">
            <input class="submit" type="submit" value="Create New Account">
          </div>
        </form>

      </main>
      
      <?php include '../shared/footer.php'; ?>
    </div>

  </body>
</html>
<?php unset($_SESSION['message']); ?>