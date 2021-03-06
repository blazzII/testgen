
<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include '../shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include '../shared/header.php'; ?>   
      <main>
        <h2>Enter Test Code</h2>
        <hr>
        <?php include '../shared/messagecheck.php'; ?>
        <form action="./" method="post"> 
          <div class="formitem">
            <input type="text" name="testID" id="testID" required>
          </div>           
          <hr>
          <div class="formitem">
            <input type="hidden" name="action" value="testView">
            <input class="submit" type="submit">
          </div>  
          <div class="formitem">
            <input class="cancel" type="button" onclick="location.href='../'" value="&#10008; Cancel">
          </div>
        </form>
      </main>
    
      <?php include '../shared/footer.php'; ?>
    </div>

  </body>
</html>
<?php unset($_SESSION['message']); ?>