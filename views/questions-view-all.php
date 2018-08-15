<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/header.php'; ?>
      <main>
        <h2>Manage Questions</h2>
        <hr>
        <div class="submenu">
          
          <form action="/testgen/questions/" method="post">
            <div class="formitem">
              <input type="submit" value="Add New Question">
              <input type="hidden" namce="action" value="viewAddNewQuestion">
            </div>  
          </form>
          
          <form action="/testgen/questions/" method="post">
            <div class="formitem">
              <select name="catID" required>
                <option disabled selected>Choose a category ...</option>
                <?php echo $options ?>
              </select>  
              <input type="submit" value="Filter">
              <input type="hidden" name="action" value="viewQuestionsByCategory">
            </div>
          </form>  
</div>  
        <hr>
        <?php if (isset($message)) { echo $message;} ?>
        <?php echo $markup; ?>
        <div class="formitem">
          <input class="smaller" type="button" onclick="location.href='/testgen/accounts'" value="Close">
        </div>
        </form>
      </main>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>
  </body>
</html>
