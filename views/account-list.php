<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include '../shared/head.php';?>
  </head>
  <body>
    <div class="flex-container">
      <?php include '../shared/header.php';?>
      <main>
        <h2>Accounts: <?php echo $accLevelText ?> List</h2>
        <hr>
        <?php include '../shared/messagecheck.php';?>

        <?php echo $markup; ?>
        
        <hr>
        <div class="formitem">
          <input class="cancel" type="button" onclick="location.href='./?action=accountView'" value="Close">
        </div>
      </main>
      <?php include '../shared/footer.php';?>
    </div>
  </body>
</html>