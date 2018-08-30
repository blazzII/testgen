<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include '../shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include '../shared/header.php'; ?>
      <main>
        <form action="../questions/" method="post">
            <h2>Edit Question</h2>
            <hr>
            <?php include '../shared/messagecheck.php'; ?>
            <div class="formitem">
              <label for="qQuestion"><strong>Question Text</strong></label><br>
              <textarea name="qQuestion" id="qQuestion" required cols="70" rows="5"><?php if(isset($qQuestion)) {echo $qQuestion;} ?></textarea>
            </div>
            <div class="formitem">
              <label for="qAnswerKey"><strong>Answer Key Text</strong></label><br>
              <textarea name="qAnswerKey" id="qAnswerKey" required cols="70" rows="5"><?php if(isset($qAnswerKey)) {echo $qAnswerKey;} ?></textarea>
            </div>
            <div class="formitem">
              <label for="qReference"><strong>Reference</strong></label><br>
              <input type="text" name="qReference" id="qReference" <?php if(isset($qReference)) {echo 'value="'.$qReference.'"';} ?>>
            </div>
            <div class="formitem">
              <label for="qActive"><strong>Question Is ACTIVE?</strong></label>
              <input type="checkbox" name="qActive" id="qActive" <?php if(isset($qActive) && $qActive == 1) { echo 'checked'; } ?>>
            </div>
            
            <hr>
            <div class="formitem">
              <input type="hidden" name="action" value="editQuestion">
              <input type="hidden" name="qID" value="<?php echo $qID ?>">
              <input class="submit" type="submit" value="Update Question">
            </div>
            <div class="formitem">
              <input class="cancel" type="button" onclick="location.href='../questions?action=viewQuestionsByCategory?catID=<?php echo $catID ?>'" value="&#10008; Cancel">
            </div>
        </form>
      </main>
      <?php include '../shared/footer.php'; ?>
    </div>
  </body>
</html>
