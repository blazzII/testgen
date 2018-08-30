<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include '../shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include '../shared/header.php'; ?>
      <main>
        <form action="../questions/?action=viewAllQuestions" method="post">
          <h2>Question: id.<?php echo $qID ?></h2>
          <hr>
          <?php include '../shared/messagecheck.php'; ?>
          <?php echo $markup; ?>
          <div class="formitem">
            <input class="submit" type="submit" value="Return">
          </div>
        </form>
      </main>
      <?php include '../shared/footer.php'; ?>
    </div>
  </body>
</html>
