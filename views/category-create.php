<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/header.php'; ?>   
      <main>
        <h2>Add New Category</h2>
          <hr>
          <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/messagecheck.php'; ?>
          <form action="/testgen/categories/" method="post"> 
          <div class="formitem">
            <input type="text" placeholder="Category Name" name="catName" id="catName" required <?php if(isset($catName)){echo "value='$catName'";}  ?>>
          </div>           
          <hr>
          <div class="formitem">
            <input type="hidden" name="action" value="addCategory">
            <input class="submit" type="submit">
          </div>  
          <div class="formitem">
              <input class="cancel" type="button" onclick="location.href='/testgen/'" value="&#10008; Cancel">
            </div>
        </form>
      </main>
    
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>

  </body>
</html>
<?php unset($_SESSION['message']); ?>