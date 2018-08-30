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
        <form action="../tests/" method="post">
          <?php echo $markup; ?>
          <div class="formitem">
            <input type="hidden" name="testID" value="<?php echo $testID ?>">
            <input type="hidden" name="action" value="addReviewNotes">
            <input class="submit" type="submit" value="Record Evaluator Notes">
          </div>   
          <div class="formitem">
            <input class="cancel" type="button" onclick="location.href='../accounts?action=accountView'" value="Close">
          </div>
        </form>
      </main>
      <?php include '../shared/footer.php'; ?>
    </div>
  </body>
</html>
