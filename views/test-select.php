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
        <h2>Enter a Test Code</h2>

        <?php 
          if (isset($_SESSION['message'])) {echo $_SESSION['message'];}
          if (isset($message)) {echo $message;}
        ?>

        <form action="/testgen/tests/" method="post">    
          <hr>
          <div class="formitem">
            <input type="text" placeholder=" " name="testID" id="testID" required <?php if(isset($testIDE)){echo "value='$testID'";}  ?>>
            <span class="placeholdertext">Test Code</span>
          </div>           
          <hr>
          <div class="formitem">
            <input type="submit">
            <input type="hidden" name="action" value="testView">
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
<?php unset($_SESSION['message']); ?>