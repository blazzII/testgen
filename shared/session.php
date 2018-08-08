<?php 
if(!empty($_SESSION) && isset($_SESSION['loggedin'])) {
    if($_SESSION['loggedin'] != TRUE && $_SESSION['timeout'] > time()) {
        session_unset(); 
        session_destroy();
        $message = "<div class=\"msg warn\">Your session has timed out. Please log in again.</div>";
        include $_SERVER['DOCUMENT_ROOT'] . '/views/login.php';
    }
}
?>