<?php
    session_start();
    if (!empty($_SESSION['loggedin']) && isset($_SESSION['loggedin'])) {
        $path = $_SESSION['loggedin'];
    } else {
        $path = FALSE;
    }
    switch ($path) {
      case TRUE:
        header ('Location: /testgen/accounts/?action=accountView');
        break;
      case FALSE:
        header ('Location: /testgen/accounts/?action=loginView');
        break;
      default:
        header ('Location: /testgen/accounts/?action=loginView');
        break;
  }