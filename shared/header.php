<header>

    <div class="pageLogo">
        •||•  AIR TEST GEN  •||•
    </div>
    <div class="currentDate">
      <?php echo date ("D, d F Y") ?>
    </div>
    <div class="accountArea">
      <?php 
        if(!empty($_SESSION)) {
          if(isset($_SESSION['accountData']['accountFirstName'])) {
            echo "Welcome " . $_SESSION['accountData']['accountFirstName'];
          }
          if(isset($_SESSION['loggedin'])) {
            if($_SESSION['loggedin']) {
                echo '<a href="/testgen/accounts/?action=myAccount">My Account</a> <a href="/testgen/accounts/?action=logout">Log Out</a>';
            }
          } else {
            echo '<a href="/testgen/accounts/?action=loginView">Log In</a>';
          } 
        } else {
            echo '<a href="/testgen/accounts/?action=loginView">∆ Log In</a>';
        }
      ?>
  </div>
</header>