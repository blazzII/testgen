<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include '../shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include '../shared/header.php'; ?>
      <main>
        
        <form action="../tests/" method="post">
            <h2>Test: <?php echo $_SESSION['testID'] ?></h2>
            <hr>
            <?php include '../shared/messagecheck.php'; 
            
            if (isset($_SESSION['loggedin'])) {
             if (!$_SESSION['loggedin']) { ?>
              <div class="formitem">
                <label for="accountFirstName"><strong>Enter Your First Name:</strong></label>
                <input type="text" name="accountFirstName" id="accountFirstName" required <?php if(isset($accountFirstName)){echo "value='$accountFirstName'";}  ?>>
              </div>
              <div class="formitem">
                <label for="accountLastName"><strong>Enter Your Last Name:</strong></label>
                <input type="text" name="accountLastName" id="accountLastName" required <?php if(isset($accountLastName)){echo "value='$accountLastName'";}  ?>>
              </div>
              <div class="formitem">
                <label for="accountEmail"><strong>Enter Your Email:</strong></label>
                <input type="email" name="accountEmail" id="accountEmail" required <?php if(isset($accountEmail)){echo "value='$accountEmail'";}  ?>>
              </div>
            <hr>
            <?php 
            } } // end of new user condition - name/email section 
              echo $testQuestions; 
            ?>
            
            <div class="formitem">
              <input type="hidden" name="action" value="submitTest">
              <input type="hidden" name="testID" value="<?php echo $_SESSION['testID']; ?>">
              <input class="submit" type="submit">
            </div>
            <div class="formitem">
              <input class="smaller" type="button" onclick="location.href='./?action=accountView'" value="&#10008; Cancel">
            </div>
        </form>
      </main>
      <?php include '../shared/footer.php'; ?>
    </div>
  </body>
</html>
