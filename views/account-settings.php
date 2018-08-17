<!doctype html>
<html class="no-js" lang="">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/header.php'; ?>
        <main>
            <h2>Account Settings</h2>
            <hr>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/messagecheck.php'; ?>
            <?php // determine account level text only
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
              <span class="bolder">First Name:</span> <?php echo $_SESSION['accountData']['accFirstName']; ?><br>  
              <span class="bolder">Last Name:</span> <?php echo $_SESSION['accountData']['accLastName']; ?><br>
              <span class="bolder">Account Type:</span> <?php echo $accLevel; ?><br>
              <span class="bolder">Email:</span> <?php echo $_SESSION['accountData']['accEmail']; ?><br>
              <span class="bolder">Registration Date:</span> <?php echo date('j F Y', strtotime($_SESSION['accountData']['accDateRegistered'])); ?>
            </div>
           
            <hr>
            <div class="grid-container">

                <form action="/testgen/accounts/" method="post">
                  <div class="menuitem">
                    <label for="accFirstName">First Name:</label><input type="text" name="accFirstName" value="">

                  </div>  
                  <div class="menuitem">
                    <input type="hidden" name="action" value="updateAccount">
                    <input class="btn" type="submit" value="Submit Updates">
                  </div>
                </form>

              
          </div>  
        </main>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>
  </body>
</html>