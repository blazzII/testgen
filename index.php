<?php
    session_start();
    if (!empty($_SESSION['loggedin']) && isset($_SESSION['loggedin'])) {
        $selectvar = $_SESSION['loggedin'];
        echo $_SESSION['loggedin'];
    } else {
        $selectvar = FALSE;
    }
    switch ($selectvar) {
      case TRUE:
          header('Location:views/account-menu.php');
          break;
      case FALSE:
          include 'views/login.php';
          break;
      default:
          //include 'views/login.php';
          break;
  }