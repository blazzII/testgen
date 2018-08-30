<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include '../shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include '../shared/header.php'; ?>
      <main>
        <h2>Tests: <?php echo $_SESSION['accountData']['accFirstName'] . ' ' . $_SESSION['accountData']['accLastName']; ?></h2>
        <hr>
        
        <?php include '../shared/messagecheck.php'; ?>
        
        <?php echo $testlistoutput; ?>
        
        <hr>
        <div class="formitem">
          <input class="cancel" type="button" onclick="location.href='../accounts?action=accountView'" value="Close">
        </div>
        </form>
      </main>
      <?php include '../shared/footer.php'; ?>
    </div>
  </body>
</html>
