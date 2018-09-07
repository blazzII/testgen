<header>
  <h1>293 &#10148; TEST GENERATOR</h1>
    <div id="account">
    <?php
      //if(!empty($_SESSION) && isset($_SESSION['loggedin'])) {
        if ($_SESSION['loggedin'] == TRUE) { ?>
            <h3><?php echo substr($_SESSION['accountData']['accFirstName'], 0,1) . '. ' . $_SESSION['accountData']['accLastName']; ?></h3>
            <button onclick="location.href='../accounts?action=accountView'">Menu</button>
            <br>
            <button onclick="location.href='../accounts?action=logout'">Logout</button>
    <?php
        } 
        else { ?>
          <button onclick="location.href='../accounts?action=loginView'">Login</button>
    <?php     
        }
      //}  
    ?>
  </div>
</header>