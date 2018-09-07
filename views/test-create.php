<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include '../shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include '../shared/header.php'; ?>
      <main>
        <h2>Create a New Test</h2>
        <?php include '../shared/messagecheck.php'; ?>

        <form action="./" method="post">
          <div class="msg good">Choose the number of questions per category topic.</div>	
          <hr>
          <?php if (isset($formItems)) echo $formItems; ?>
          <hr>
          <div class="formitem">
            <input type="hidden" name="action" value="createTest">
            <input class="submit" type="submit" value="Create Test">
          </div>
          <div class="formitem">
            <input class="cancel" type="button" onclick="location.href='../accounts/?action=accountView'" value="&#10008; Cancel">
          </div>
        </form>
      </main>
      <?php include '../shared/footer.php'; ?>
    </div>
  </body>
</html>
