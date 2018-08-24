<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/header.php'; ?>
      <main>
        <h2>Create a New Test</h2>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/messagecheck.php'; ?>
        <form action="/testgen/tests/" method="post">
          <div class="msg good">Choose the number of questions per topic.</div>	
          <hr>
          <?php if (isset($formItems)) echo $formItems; ?>
          <hr>
          <input type="submit" value="Create Test">
          <input type="hidden" name="action" value="createTest">
          <div class="formitem">
            <input class="smaller" type="button" onclick="location.href='../accounts/?action=accountView'" value="Cancel">
          </div>
        </form>
      </main>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>
  </body>
</html>
