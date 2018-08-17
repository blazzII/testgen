<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/header.php'; ?>
        <main>
            <h2><?php echo $_SESSION['accountData']['accFirstName'] . ' ' . $_SESSION['accountData']['accLastName']; ?></h2>
            <hr>
            
            <?php // determine level
              switch ($_SESSION['accountData']['accLevel']) {
                case 1:
                  $accLevel = "Pilot";
                  break;
                case 2:
                  $accLevel = "Evaluator";
                  break;
                case 3:
                  $accLevel = "Administrator";
                  break;
                default:
                  $message = 'There is a problem with your account. Please contact the administrator.';
                  break;
              }
            ?>
            <div class="infocolumn">
              <span class="bolder">Account:</span> <?php echo $accLevel; ?><br>
              <span class="bolder">Email:</span> <?php echo $_SESSION['accountData']['accEmail']; ?><br>
              <span class="bolder">Registration Date:</span> <?php echo date('j F Y', strtotime($_SESSION['accountData']['accDateRegistered'])); ?>
            </div>
            <div class="infocolumn">
              <span class="bolder">Test Count:</span> <?php echo $testCount; ?><br>  
              <?php if ($_SESSION['accountData']['accLevel'] != 1) { ?>
                <span class="bolder">Tests Written:</span> <?php echo 'list' ?><br> 
              <?php } ?>  
            </div>
            <hr>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/messagecheck.php'; ?>
            <div class="grid-container">
              <section>    
                <h3>Account</h3>
                <form action="/testgen/accounts/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="updateAccountView">
                    <input class="btn" type="submit" value="Update My Account">
                  </div>
                </form>
                <?php if ($_SESSION['accountData']['accLevel'] > 1) { // first block ?>
                <form action="/testgen/accounts/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="getPilots">
                    <input class="btn" type="submit" value="Pilots">
                  </div>
                </form>
                <?php if ($_SESSION['accountData']['accLevel'] > 1) { // second block ?>
                <form action="/testgen/accounts/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="getEvaluators">
                    <input class="btn" type="submit" value="Evaluators">
                  </div>
                </form>
                <form action="/testgen/accounts/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="getAdministrators">
                    <input class="btn" type="submit" value="Adminstrators">
                  </div>
                </form>
                <?php }} //end of second and firstblock ?>
              </section>
              <section>  
                <h3>Tests</h3>
                <form action="/testgen/tests/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="testSelectView">
                    <input class="btn" type="submit" value="Take a Test">
                  </div>
                </form>
                <?php if($accLevel=='Administrator' || $accLevel == 'Evaluator') { ?> 
                <form action="/testgen/tests/" method="post">
                  <input class="btn" type="submit" value="Create New Test">
                  <input type="hidden" name="action" value="createTestView">
                </form>
                <form action="/testgen/tests/" method="post">
                  <div class="menuitem">
                    <!-- <input type="hidden" name="accID" value="<?php //echo $_SESSION['accountData']['accID']; ?>"> -->
                    <input type="hidden" name="action" value="viewAllTestsByAccount">
                    <input class="btn" type="submit" value="Manage Tests">
                  </div>
                </form>
                <?php } ?>
              </section> 
              <?php if($accLevel=='Administrator') { ?> 
              <section>
                <h3>Questions</h3>
                <form action="/testgen/questions/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="viewAllQuestions">
                    <input class="btn" type="submit" value="Manage Questions">
                  </div>
                </form>
                <form action="/testgen/categories/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="viewAllCategories">
                    <input class="btn" type="submit" value="Manage Categories">
                  </div>
                </form>
              </section>
              <?php } ?>
          </div>  
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>
  </body>
</html>