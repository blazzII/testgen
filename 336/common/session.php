<?php 
if(!empty($_SESSION) && isset($_SESSION['loggedin'])) {
    if($_SESSION['loggedin'] == TRUE && $_SESSION['timeout'] < time()) {
        //$_SESSION['loggedin'] = FALSE;
        // remove all session variables
        session_unset(); 
        // Logging out, destroy the session.
        session_destroy();
        $message = "<div class=\"displayErrMessage\">Your session has timed out. Please log in again.</div>";
        include $_SERVER['DOCUMENT_ROOT'] . '/view/login.php';
    }
}
?>