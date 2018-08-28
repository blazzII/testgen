<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/header.php'; ?>
      <main>
        <h2>Print Review</h2>
 
        
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/messagecheck.php'; ?>
        <form>
          <?php echo $markup; ?>
          <div class="formitem">
            <input class="button" type="button" onclick="" value="Print">
          </div>   
          <div class="formitem">
            <input class="cancel" type="button" onclick="location.href='../accounts?action=accountView'" value="Close">
          </div>
        </form>
      </main>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>
  </body>
</html>
