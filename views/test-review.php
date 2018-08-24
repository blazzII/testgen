<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/header.php'; ?>
      <main>
        <h2>Test Review</h2>
 
        
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/messagecheck.php'; ?>
        <form>
          <?php echo $markup; ?>
          <div class="formitem">
            <input type="hidden" name="testID" value="'.$testID.'">
            <input type="hidden" name="action" value="addReviewNotes">
            <input type="submit">
          </div>   
          <div class="formitem">
            <input class="smaller" type="button" onclick="location.href='/testgen/accounts?action=accountView'" value="Close">
          </div>
        </form>
      </main>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>
  </body>
</html>
