<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include '../shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include '../shared/header.php'; ?>
      <main>
            <h2>Test: <?php echo $testID ?></h2>
            <hr>
            <?php include '../shared/messagecheck.php'; ?>
            <div class="clearfix"></div>
              <?php echo $testQuestions; ?>
            <br>
            <hr>
            <form action="./" method="post">
              <div class="formitem">
                <input type="email" placeholder="Enter Pilot Email" size="40" name="pilotEmail" required>
              </div>  
              <div class="formitem">
                <input type="hidden" name="testID" value="<?php echo $testID ?>">
                <input type="hidden" name="action" value="emailTest">
                <input type="submit" value="Send Test Code">
              </div>
              <div class="formitem">
                <input class="cancel" type="button" onclick="location.href='./?action=viewAllTestsByAccount'" value="&#10008; Close">
              </div>
            </form>
            
      </main>
      <?php include '../shared/footer.php'; ?>
    </div>
  </body>
</html>
