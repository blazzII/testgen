<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include '../shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include '../shared/header.php'; ?>
      <main>
        <h2>Test Review</h2>
 
        
        <?php include '../shared/messagecheck.php'; ?>
        
        <?php echo $testdetails; ?>
        
       
        <div class="formitem">
          <input class="cancel" type="button" onclick="location.href='../accounts?action=accountView'" value="Close">
        </div>
      </main>
      <?php include '../shared/footer.php'; ?>
    </div>
  </body>
</html>
