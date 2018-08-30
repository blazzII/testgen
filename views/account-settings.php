<!doctype html>
<html class="no-js" lang="">
  <head>
    <?php include '../shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
        <?php include '../shared/header.php'; ?>
        <main>
            <h2>Update Account Settings</h2>
            <hr>
            <?php include '../shared/messagecheck.php'; ?>
            
            <div class="infocolumn">
              <span class="bolder">First Name:</span> <?php echo $account['accFirstName']; ?><br>  
              <span class="bolder">Last Name:</span> <?php echo $account['accLastName']; ?><br>
              <span class="bolder">Account Type:</span> <?php echo $accLevelText; ?><br>
              <span class="bolder">Email:</span> <?php echo $account['accEmail']; ?><br>
              <span class="bolder">Registration Date:</span> <?php echo date('j F Y', strtotime($account['accDateRegistered'])); ?>
            </div>
           
            <hr>
            <div class="sub-container">

                <form action="../accounts/" method="post" id="accUpdate">
                  <div class="formitem">
                    <label for="accFirstName">First Name:</label>
                    <input type="text" name="accFirstName" required  value="<?php echo $account['accFirstName']; ?>">
                  </div>  
                  <div class="formitem">
                    <label for="accLastName">Last Name:</label>
                    <input type="text" name="accLastName" required value="<?php echo $account['accLastName']; ?>">
                  </div>  
                  <div class="formitem">
                    <label for="accEmail">Email:</label>
                    <input type="text" name="accEmail" required value="<?php echo $account['accEmail']; ?>">
                  </div>  

                  <?php if ($_SESSION['accountData']['accLevel'] == 3) { ?>
                    <div class="formitem">
                      <label for="accLevel">Account Level/Type:</label>
                      <input class="center" type="text" name="accLevel" size="2" required value="<?php echo $account['accLevel']; ?>">
                    </div>  
                  <?php } ?>

                  <hr>
                  <div class="formitem">
                    <input type="hidden" name="action" value="updateAccount">
                    <input type="hidden" name="accID" value="<?php echo $account['accID']; ?>">
                    <input class="submit" type="submit" form="accUpdate" value="Update Account">
                  </div>
                  <div class="formitem">
                    <input class="cancel" type="button" onclick="location.href='./?action=accountView'" value="Cancel">
                  </div>
                </form>

              
          </div>  
        </main>
        <?php include '../shared/footer.php'; ?>
    </div>
  </body>
</html>