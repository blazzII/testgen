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
        <form action="/testgen/questions/?action=viewAllQuestions" method="post">
            <h2>Question: id.<?php echo $qID ?></h2>
            <hr>
            <?php echo $markup; ?>
            <div class="formitem">
              <input type="submit" value="Return">
            </div>
        </form>
      </main>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>
  </body>
</html>
