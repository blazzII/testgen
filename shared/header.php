<header>
  <h1>AIR TEST GEN</h1>
  <?php
    if(!empty($_SESSION) && isset($_SESSION['loggedin'])) {
      if ($_SESSION['loggedin'] == TRUE) { ?>
        <div id="account">
          <h3><?php echo substr($_SESSION['accountData']['accFirstName'], 0,1) . '. ' . $_SESSION['accountData']['accLastName']; ?></h3>
          <button onclick="location.href='/testgen/accounts/?action=accountView'">Menu</button>
          <br>
          <button onclick="location.href='/testgen/accounts/?action=logout'">Logout</button>
        </div>
    <?php
      }
    }  
  ?>
</header>