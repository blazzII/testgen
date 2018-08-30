<header>
  <h1>293 &#10148; TEST GENERATOR</h1>
  <?php
    if(!empty($_SESSION) && isset($_SESSION['loggedin'])) {
      if ($_SESSION['loggedin'] == TRUE) { ?>
        <div id="account">
          <h3><?php echo substr($_SESSION['accountData']['accFirstName'], 0,1) . '. ' . $_SESSION['accountData']['accLastName']; ?></h3>
          <button onclick="location.href='../accounts/?action=accountView'">Menu</button>
          <br>
          <button onclick="location.href='../accounts/?action=logout'">Logout</button>
        </div>
    <?php
      } else { ?>
        <div id="account">
          <button onclick="location.href='./?action=loginView'">Login</button>
        </div>
    <?php     
      }
    }  
  ?>
</header>