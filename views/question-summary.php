<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/head.php';?>
  </head>
  <body>
    <div class="flex-container">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/header.php';?>

      
      <main>
      
        <h2>Question Use Summary<br> By Category</h2>

        <hr>
          <?php echo $markup; ?>
        <hr>
        
        <div style="text-align: right;">
          <input class="cancel" type="button" onclick="location.href='../accounts?action=accountView'" value="&#10008; Close">
        </div>

      </main>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php';?>
    </div>
  </body>
</html>
