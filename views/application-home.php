<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/header.php'; ?>   
      <main>

        <h2>Welcome</h2>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/messagecheck.php'; ?>
        
        <form action="/testgen/tests/" method="post">
          <input class="menubutton" type="submit" value="Take a Test">
          <input type="hidden" name="action" value="testSelectView">
        </form>  

      </main>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>

  </body>
</html>
<?php unset($_SESSION['message']); ?>