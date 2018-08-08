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
        <h2>Login</h2>
        <hr>
        <?php 
          if (isset($_SESSION['message'])) {echo $_SESSION['message'];}
          if (isset($message)) {echo $message;}
        ?>
        <form action="/testgen/accounts/" method="post">    
            <input type="email" placeholder="Enter Email" name="accountEmail" id="accountEmail" required onfocus="changeinput()" <?php if(isset($accountEmail)){echo "value='$accountEmail'";}  ?>><br>         
            <input type="password" placeholder="Enter Password" name="accountPassword" id="accountPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
                           
            <input type="checkbox" checked="checked" name="remember" id="remember" value="1"> Remember me<br>
            <input type="submit" value="Login">
            <input type="hidden" name="action" value="login">
        </form>
            
                    <form action="/testgen/accounts/" method="post">
                        <div class="formfields">
                            <input type="hidden" name="action" value="registrationView">
                            <label>New Account? </label>
                            <input class="smallerFont" type="submit" value="Create New Account">
                        </div>
                    </form>
      </main>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>

    <script>
      function changeinput(){
        
      }
    </script>
  </body>
</html>
<?php unset($_SESSION['message']); ?>