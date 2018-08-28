<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/header.php'; ?>   
      <main>
        <h2>Password Retrieval</h2>
        <hr>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/messagecheck.php'; ?>

        <form action="/testgen/accounts/" method="post">    
          
          <div class="formitem">
            <input type="email" placeholder="Registered Email" name="accountEmail" id="accountEmail" required <?php if(isset($accountEmail)){echo "value='$accountEmail'";}  ?>>
          </div>           
          <div class="formitem">
            <input type="hidden" name="action" value="retrievePassword">
            <input class="submit" type="submit" value="Retrieve Password">
          </div>
          <div class="formitem">
              <input class="cancel" type="button" onclick="location.href='./?action=login'" value="Cancel">
            </div>
        </form>

      </main>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>

  </body>
</html>
<?php unset($_SESSION['message']); ?>