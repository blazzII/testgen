<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/header.php'; ?>
      <main>
            <h2>Test: <?php echo $testID ?></h2>
            <hr>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/messagecheck.php'; ?>
            <div class="clearfix"></div>
              <?php echo $testQuestions; ?>
            <br>
            <hr>
            <form action="/testgen/tests/" method="post">
              <div class="formitem">
                <input type="email" placeholder="Enter Pilot Email" size="40" name="pilotEmail" required>
                <input type="hidden" name="testID" value="<?php echo $testID ?>">
              </div>  
              <div class="formitem">
                <input type="submit" value="Send Test Code">
                <input type="hidden" name="action" value="emailTest">
              </div>
              <div class="formitem">
                <input class="cancel" type="button" onclick="location.href='../tests/?action=viewAllTestsByAccount'" value="Cancel">
              </div>
            </form>
            
      </main>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>
  </body>
</html>
