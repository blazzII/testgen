<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/head.php';?>
  </head>
  <body>
    <div class="flex-container">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/header.php';?>
      <main>
        <h2>Accounts: <?php echo $accLevelText ?> List</h2>
        <hr>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/messagecheck.php';?>
        <?php echo $markup; ?>
        <hr>
        <div class="formitem">
          <input class="smaller" type="button" onclick="location.href='/testgen/accounts'" value="Close">
        </div>
        </form>
      </main>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php';?>
    </div>
  </body>
</html>