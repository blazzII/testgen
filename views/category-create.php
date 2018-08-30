<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include '../shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include '../shared/header.php'; ?>   
      <main>
        <h2>Add New Category</h2>
          <hr>
          <?php include '../shared/messagecheck.php'; ?>
          <form action="../categories/" method="post"> 
          <div class="formitem">
            <input type="text" placeholder="Category Name" name="catName" id="catName" required <?php if(isset($catName)){echo "value='$catName'";}  ?>>
          </div>           
          <hr>
          <div class="formitem">
            <input type="hidden" name="action" value="addCategory">
            <input class="submit" type="submit">
          </div>  
          <div class="formitem">
              <input class="cancel" type="button" onclick="location.href='../'" value="&#10008; Cancel">
            </div>
        </form>
      </main>
    
      <?php include '../shared/footer.php'; ?>
    </div>

  </body>
</html>
<?php unset($_SESSION['message']); ?>