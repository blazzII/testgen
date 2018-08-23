<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/head.php';?>
  </head>
  <body>
    <div class="flex-container">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/header.php';?>
        <main>
            <h2>Delete this Account?</h2>
            <hr>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/messagecheck.php';?>
            
            <div class="infocolumn">
              <span class="bolder">First Name:</span> <?php echo $account['accFirstName']; ?><br>
              <span class="bolder">Last Name:</span> <?php echo $account['accLastName']; ?><br>
              <span class="bolder">Account:</span> <?php echo $accLevelText; ?><br>
              <span class="bolder">Email:</span> <?php echo $account['accEmail']; ?><br>
              <span class="bolder">Registration Date:</span> <?php echo date('j M Y', strtotime($account['accDateRegistered'])); ?>
            </div>

            <div class="infocolumn">
              <?php
              if (isset($testCount) && $account['accLevel'] == 1) {?>
                <span class="bolder">Tests Taken: </span> <?php echo $testCount; ?><br>
              <?php
              }
              ?>
            </div>

            <hr>
            <form action="/testgen/accounts/" method="post">
              <div class="menuitem">
                <input type="hidden" name="action" value="deleteAccount">
                <input type="hidden" name="accID" value="<?php echo $account['accID'] ?>">
                <input type="hidden" name="accLevel" value="<?php echo $account['accLevel'] ?>">
                <input class="btn" type="submit" value="Confirm Delete">
              </div>
            </form>

          </div>
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php';?>
    </div>
  </body>
</html>