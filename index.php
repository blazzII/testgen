<?php
  session_start();
  
  if (!empty($_SESSION['loggedin']) && isset($_SESSION['loggedin'])) {
    $path = $_SESSION['loggedin'];
  } else {
    $_SESSION['loggedin'] = FALSE;
  }
  switch ($_SESSION['loggedin']) {
    case TRUE:
      header ('Location: ./accounts/?action=accountView');
      break;
    case FALSE:
      header ('Location: ./accounts/?action=home');
      break;
    default:
      header ('Location: ./accounts/?action=home');
      break;
  }