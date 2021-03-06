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
            <h2>Add a New Question</h2>
            <hr>
            <?php include '../shared/messagecheck.php'; ?>
            <div class="formitem">
              <label for="qQuestion"><strong>Question Category</strong></label><br>
              <?php echo $categoryList; ?>
            </div>
            <div class="formitem">
              <label for="qQuestion"><strong>Question Text</strong></label><br>
              <textarea name="qQuestion" id="qQuestion" required cols="70" rows="5"><?php if(isset($qQuestion)) {echo $qQuestion;} ?></textarea>
            </div>
            <div class="formitem">
              <label for="qAnswerKey"><strong>Answer Key Text</strong></label><br>
              <textarea name="qAnswerKey" id="qAnswerKey" required cols="70" rows="5"><?php if(isset($qAnswerKey)) {echo $qAnswerKey;} ?></textarea>
            </div>
            <div class="formitem">
              <label for="qReference"><strong>Reference</strong></label>
              <input type="text" name="qReference" id="qReference" <?php if(isset($qReference)) {echo 'value="'.$qReference.'"';} ?>>
            </div>
            <div class="formitem">
              <label for="qActive"><strong>Question Is ACTIVE</strong></label>
              <input type="checkbox" name="qActive" id="qActive" checked <?php //if(isset($qActive) && $qActive == 1) { echo 'checked'; } ?>>
            </div>
            
            <hr>
            <div class="formitem">
             
              <input type="hidden" name="action" value="addQuestion">
              <input class="submit" type="submit" value="Add Question">
            </div>
            <div class="formitem">
              <input class="cancel" type="button" onclick="location.href='./?action=viewAllQuestions'" value="Cancel">
            </div>
        </form>
      </main>
      <?php include '../shared/footer.php'; ?>
    </div>
  </body>
</html>
