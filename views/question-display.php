<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/header.php'; ?>
      <main>
        <form action="/testgen/questions/?action=viewAllQuestions" method="post">
            <h2>Question: id.<?php echo $qID ?></h2>
            <hr>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/messagecheck.php'; ?>
            <?php echo $markup; ?>
            <div class="formitem">
              <input type="submit" value="Return">
            </div>
        </form>
        <form action="/testgen/questions/" method="post">
            <div class="formitem">
              <input type="submit" value="Add Question">
              <input type="hidden" name="action" value="viewAddNewQuestion">
            </div>
          </form>
      </main>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>
  </body>
</html>
