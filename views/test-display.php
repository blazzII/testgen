<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/header.php'; ?>
      <main>
        
        <form action="/testgen/tests/" method="post">
            <h2>Test: <?php echo $_SESSION['testID'] ?></h2>
            <hr>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/messagecheck.php'; 
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
            <?php } 
              echo $testQuestions; ?>
            <div class="formitem">
              <input type="submit">
              <input type="hidden" name="action" value="submitTest">
            </div>
            <div class="formitem">
              <input class="smaller" type="button" onclick="location.href='/testgen/'" value="Cancel">
            </div>
        </form>
      </main>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>
  </body>
</html>
