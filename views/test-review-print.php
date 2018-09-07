<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include '../shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <main>
        <h2>Test Review</h2>
        <?php echo $markup; ?>
        <hr>
        <div class="formitem">
          <input class="button" type="button" onclick="window.print()" value="Print">
        </div>   
        <div class="formitem">
          <input class="cancel" type="button" onclick="location.href='../accounts?action=accountView'" value="&#10008; Close">
        </div>
      </main>
      <?php include '../shared/footer.php'; ?>
    </div>
  </body>
</html>
