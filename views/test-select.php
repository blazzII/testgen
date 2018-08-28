
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
        <hr>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/messagecheck.php'; ?>
        <form action="/testgen/tests/" method="post"> 
          <div class="formitem">
            <input type="text" placeholder="Enter a Test Code" name="testID" id="testID" max-length="20" required>
          </div>           
          <hr>
          <div class="formitem">
            <input type="hidden" name="action" value="testView">
            <input class="submit" type="submit">
          </div>  
          <div class="formitem">
            <input class="cancel" type="button" onclick="location.href='../'" value="Cancel">
          </div>
        </form>
      </main>
    
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>

  </body>
</html>
<?php unset($_SESSION['message']); ?>