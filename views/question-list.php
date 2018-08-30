<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include '../shared/head.php';?>
  </head>
  <body>
    <div class="flex-container">
      <?php include '../shared/header.php';?>
      <main>
        <h2>Questions</h2>
        <hr>

        <form action="../questions/" method="post">
          <div>
            <select name="catID" required>
              <option disabled selected>Select a category ...</option>
              <?php echo $options; ?>
            </select>
            <input type="hidden" name="action" value="viewQuestionsByCategory">
            <input class="button" type="submit" name="submit" value="&#10096; Filter">
            
            <input class="button highlight" type="button" value="Add Question" onclick="location.href='./?action=viewAddNewQuestion'">
            <input class="smaller cancel" style="float: right;" type="button" onclick="location.href='../accounts/?action=accountView'" value="&#10008;">
          </div>
        </form>

        <hr>
          <?php include '../shared/messagecheck.php';?>

          <?php echo $markup; ?>
          
          <?php if (!$firstFlag) { ?>
          <div class="formitem">
            <input class="smaller cancel" type="button" onclick="location.href='../accounts/?action=accountView'" value="&#10008; Close">
          </div>
          <?php } ?>
      </main>
      <?php include '../shared/footer.php';?>
    </div>
  </body>
</html>
