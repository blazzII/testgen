<?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/session.php'; ?>
<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/header.php'; ?>
      <main>
        <?php 
          if (isset($_SESSION['message'])) echo $_SESSION['message'];
          if (isset($message)) echo $message;    
        ?>
        <hr>
        <section>
          <form action="tests/" method="post">
            <input class="menubutton" type="submit" value="Create New Test">
            <input type="hidden" name="action" value="createTestView">
          </form>
        </section>
        <section>
          <form action="tests/" method="post">
            <input class="menubutton" type="submit" value="Take a Test">
            <input type="hidden" name="action" value="testSelectView">
          </form>
        </section>
        <hr>
        <section>
          <?php 
            if (isset($_SESSION['loggedin'])) { ?>
              <form action="accounts/" method="post">
                <input class="menubutton" type="submit" value="Logout">
                <input type="hidden" name="action" value="logout">
              </form>
          <?php 
            } else { ?>
                <form action="accounts/" method="post">
                  <input class="menubutton" type="submit" value="Login">
                  <input type="hidden" name="action" value="loginView">
              </form>
          <?php
            } ?>  
        </section>
      </main>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>
  </body>
</html>
