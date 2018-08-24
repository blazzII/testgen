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
            

            <div class="infocolumn">
              <span class="bolder">Account Type:</span> <?php echo $accLevelText; ?><br>
              <span class="bolder">Email:</span> <?php echo $_SESSION['accountData']['accEmail']; ?><br>
              <span class="bolder">Registration Date:</span> <?php echo date('j F Y', strtotime($_SESSION['accountData']['accDateRegistered'])); ?>
            </div>
            <div class="infocolumn">
              <?php
              if(isset($testCount) && $_SESSION['accountData']['accLevel'] == 1) { ?>
                <span class="bolder">Tests Taken: </span> <?php echo $testCount; ?><br>  
              <?php
              }
              if ($_SESSION['accountData']['accLevel'] != 1) { ?>
                <br>
                <span class="bolder">Tests Written: </span> <?php echo $testWCount . ' &#10148; '; ?>
                 <?php 
                 foreach($tests as $test) {
                   echo $test['testID'] . ', ';  
                 }
                 ?><br>
              <?php
              } ?>  
            </div>
            <hr>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/messagecheck.php'; ?>
            <?php
              if ($_SESSION['accountData']['accLevel'] != 3) { 
                  echo '<div class="grid-container">';
              } else { 
                  echo '<div class="admin-grid-container">';
              }
            ?>
              <section>    
                <h3>Accounts</h3>
                <form action="/testgen/accounts/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="updateAccountView">
                    <input type="hidden" name="accID" value="<?php echo $_SESSION['accountData']['accID']; ?>">
                    <input class="btn" type="submit" value="Update My Account">
                  </div>
                </form>
                <?php if ($_SESSION['accountData']['accLevel'] > 1) { // first block ?>
                <form action="/testgen/accounts/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="getAccountsView">
                    <input type="hidden" name="accLevel" value="1">
                    <input class="btn" type="submit" value="Pilots">
                  </div>
                </form>
                <?php if ($_SESSION['accountData']['accLevel'] > 1) { // second block ?>
                <form action="/testgen/accounts/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="getAccountsView">
                    <input type="hidden" name="accLevel" value="2">
                    <input class="btn" type="submit" value="Evaluators">
                  </div>
                </form>
                <form action="/testgen/accounts/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="getAccountsView">
                    <input type="hidden" name="accLevel" value="3">
                    <input class="btn" type="submit" value="Adminstrators">
                  </div>
                </form>
                <?php }} //end of second and firstblock ?>
              </section>
              
              <section>  
                <h3>Tests</h3>
              
              <?php if ($_SESSION['accountData']['accLevel'] == 1) { ?>     
                <form action="/testgen/tests/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="testSelectView">
                    <input class="btn" type="submit" value="Take a Test">
                  </div>
                </form>
              
                <form action="/testgen/tests/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="testReviewView">
                    <input class="btn" type="submit" value="Review Tests">
                  </div>
                </form>
              <?php } ?>  
              <?php if ($_SESSION['accountData']['accLevel'] > 1) { ?> 
                <form action="/testgen/tests/" method="post">
                <div class="menuitem">
                  <input type="hidden" name="action" value="createTestView">
                  <input class="btn" type="submit" value="Create Test">
              </div>
                </form>
                <form action="/testgen/tests/" method="post">
                  <div class="menuitem">
                    <!-- <input type="hidden" name="accID" value="<?php //echo $_SESSION['accountData']['accID']; ?>"> -->
                    <input type="hidden" name="action" value="manageTestsView">
                    <input class="btn" type="submit" value="Review Tests">
                  </div>
                </form>
              <?php } ?>
              </section> 
              
              <?php if ($_SESSION['accountData']['accLevel'] > 2) { ?> 
              <section>
                <h3>Questions</h3>
                <form action="/testgen/questions/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="viewQuestionsByCategory">
                    <input type="hidden" name="catID" value="1">
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