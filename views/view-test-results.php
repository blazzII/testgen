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
        <?php if (isset($message)) { echo $message;} ?>
        <form action="/testgen/tests/" method="post">
          <div class="formfields">
            <h1>Create a New Test</h1>
            <hr>

            <label for="placeholder"><strong>Placeholder:</strong></label>
            <input type="text" placeholder="placeholder" name="placeholder" id="placeholder" required <?php if(isset($placeholder)){echo "value='$placeholder'";}  ?>>

            <?php
               echo $questions;
            ?>

            <input type="submit" value="Create Test">
            <input type="hidden" name="action" value="createNewTest">
          </div>
        </form>
      </main>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>
  </body>
</html>