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
            <h2>Edit Question</h2>
            <hr>
            <div class="formitem">
              <label for="qQuestion"><strong>Question Text</strong></label><br>
              <textarea name="qQuestion" id="qQuestion" required cols="70" rows="2"><?php if(isset($qQuestion)) {echo $qQuestion;} ?></textarea>
            </div>
            <div class="formitem">
              <label for="qAnswerKey"><strong>Answer Key Text</strong></label><br>
              <textarea name="qAnswerKey" id="qAnswerKey" required cols="70" rows="2"><?php if(isset($qAnswerKey)) {echo $qAnswerKey;} ?></textarea>
            </div>
            <div class="formitem">
              <label for="qReference"><strong>Reference:</strong></label>
              <input type="text" name="qReference" id="qReference" <?php if(isset($qReference)) {echo 'value="'.$qReference.'"';} ?>>
            </div>
            <div class="formitem">
              <label for="qActive"><strong>Active Question?:</strong></label>
              <input type="checkbox" name="qActive" id="qActive" <?php if(isset($qActive) && $qActive == 1) { echo 'checked'; } ?>
            </div>
            
            <hr>
            <div class="formitem">
              <input type="submit" value="Update Question">
              <input type="hidden" name="action" value="editQuestion">
            </div>
            <div class="formitem">
              <input class="smaller" type="button" onclick="location.href='/testgen/questions?action=viewAllQuestions'" value="Cancel">
            </div>
        </form>
      </main>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>
  </body>
</html>
