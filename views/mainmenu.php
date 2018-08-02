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
        <h1>Main Menu</h1>
        <?php 
          if (isset($_SESSION['message'])) echo $_SESSION['message'];
          if (isset($message)) echo $message;    
        ?>
        <?php if (isset($_SESSION['accountData'])) 
                if ($_SESSION['accountData']['accountLevel'] > 2) { 
        ?>
          <section>
            <h2>Application Administrator Menu</h2>
            <form action="tests/" method="post">
              <input type="button" value="Create New Test">
              <input type="hidden" name="action" value="createNewTest">
            </form>
          </section>
        <?php   } 
              
        ?>
        <section>
          <h2>Evaluator Menu</h2>
          <form action="tests/" method="post">
            <input type="button" value="Create New Test">
            <input type="hidden" name="action" value="createNewTest">
          </form>
        </section>
        <section>
          <h2>Pilot Menu</h2>
          <form action="tests/" method="post">
            <input type="button" value="Take a Test">
            <input type="hidden" name="action" value="takeTest">
          </form>
        </section>
      </main>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>
  </body>
</html>
