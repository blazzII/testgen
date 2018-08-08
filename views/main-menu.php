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
        <h2>Main Menu</h2>
        <?php 
          if (isset($_SESSION['message'])) echo $_SESSION['message'];
          if (isset($message)) echo $message;    
        ?>
        
        <?php
          if (isset($_SESSION['accountData'])) 
            if ($_SESSION['accountData']['accLevel'] > 2) { 
        ?>
            <section>
              <form action="accounts/" method="post">
                <input class="menubutton" type="submit" value="Administer Accounts">
                <input type="hidden" name="action" value="accountAdminView">
              </form>
            </section>
        <?php
           }      
        ?>
        <section>
          <form action="tests/" method="post">
            <input class="menubutton" type="submit" value="Create New Test">
            <input type="hidden" name="action" value="createTestView">
          </form>
        </section>
        <section>
          <form action="tests/" method="post">
            <input class="menubutton" type="submit" value="Take a Test">
            <input type="hidden" name="action" value="takeTestLoginView">
          </form>
        </section>
      </main>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>
  </body>
</html>
