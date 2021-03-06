<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include '../shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
        <?php include '../shared/header.php'; ?>
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
            <?php include '../shared/messagecheck.php'; ?>
            <?php
              if ($_SESSION['accountData']['accLevel'] != 3) { 
                  echo '<div class="grid-container">';
              } else { 
                  echo '<div class="admin-grid-container">';
              }
            ?>
              <section>    
                <h3>Accounts</h3>
                <form action="../accounts/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="updateAccountView">
                    <input type="hidden" name="accID" value="<?php echo $_SESSION['accountData']['accID']; ?>">
                    <input class="submit" type="submit" value="Update My Account">
                  </div>
                </form>
                <?php if ($_SESSION['accountData']['accLevel'] > 1) { // first block ?>
                <form action="../accounts/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="getAccountsView">
                    <input type="hidden" name="accLevel" value="1">
                    <input class="submit" type="submit" value="Pilots">
                  </div>
                </form>
                <?php if ($_SESSION['accountData']['accLevel'] > 1) { // second block ?>
                <form action="../accounts/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="getAccountsView">
                    <input type="hidden" name="accLevel" value="2">
                    <input class="submit" type="submit" value="Evaluators">
                  </div>
                </form>
                <form action="../accounts/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="getAccountsView">
                    <input type="hidden" name="accLevel" value="3">
                    <input class="submit" type="submit" value="Administrators">
                  </div>
                </form>
                <?php }} //end of second and firstblock ?>
              </section>
              
              <section>  
                <h3>Tests</h3>
              
              <?php if ($_SESSION['accountData']['accLevel'] == 1) { ?>     
                <form action="../tests/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="testSelectView">
                    <input class="submit" type="submit" value="Take a Test">
                  </div>
                </form>
              
                <form action="../tests/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="testReviewView">
                    <input class="submit" type="submit" value="Review Tests">
                  </div>
                </form>
              <?php } ?>  
              <?php if ($_SESSION['accountData']['accLevel'] > 1) { ?> 
                <form action="../tests/" method="post">
                <div class="menuitem">
                  <input type="hidden" name="action" value="createTestView">
                  <input class="submit" type="submit" value="Create Test">
              </div>
                </form>
                <form action="../tests/" method="post">
                  <div class="menuitem">
                    <!-- <input type="hidden" name="accID" value="<?php //echo $_SESSION['accountData']['accID']; ?>"> -->
                    <input type="hidden" name="action" value="manageTestsView">
                    <input class="submit" type="submit" value="Review Tests">
                  </div>
                </form>
              <?php } ?>
              </section> 
              
              <?php if ($_SESSION['accountData']['accLevel'] > 2) { ?> 
              <section>
                <h3>Questions</h3>
                <form action="../questions/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="questionSummary">
                    <input class="submit" type="submit" value="Question Use Summary">
                  </div>
                </form>
                <form action="../questions/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="viewQuestionsByCategory">
                    <input type="hidden" name="catID" value="1">
                    <input class="submit" type="submit" value="Manage Questions">
                  </div>
                </form>
                <form action="../categories/" method="post">
                  <div class="menuitem">
                    <input type="hidden" name="action" value="viewAllCategories">
                    <input class="submit" type="submit" value="Manage Categories">
                  </div>
                </form>
              </section>
              <?php } ?>
          </div>  
        </main>
        <?php include '../shared/footer.php'; ?>
    </div>
  </body>
</html>