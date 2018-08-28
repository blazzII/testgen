<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/head.php';?>
  </head>
  <body>
    <div class="flex-container">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/header.php';?>
      <main>
        <h2>Manage Test Categories</h2>
        <hr>
        <form action="./" method="post">
          <?php echo $markup; ?>
          <hr>
          <div class="formitem">
           
            <input type="hidden" name="action" value="viewAddNewCategory">
            <input class="submit" type="submit" value="Add New Category">
          </div>
          <div class="formitem">
            <input class="cancel" type="button" onclick="location.href='/testgen/accounts?action=accountView'" value="&#10008; Close">
          </div>
        </form>

      </main>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php';?>
    </div>
  </body>
</html>
