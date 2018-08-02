<?php 
/* ∆ Accounts Control ********************************/

session_start();
require_once '../library/connections.php';  // DB Connection
require_once '../models/accounts.php';
require_once '../library/functions.php';

// ACTION method sanitize and use POST or GET
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    }

switch ($action) {
    
    case 'loginView':
        $pageTitle = 'Login';
        include '../views/login.php';
        break;

    case 'registrationView':
        $pageTitle = 'Register';
        include '../views/register.php';
        break;

    case 'registration':
        $accountFirstname = filter_input(INPUT_POST, 'accountFirstname', FILTER_SANITIZE_STRING);
        $accountLastname = filter_input(INPUT_POST, 'accountLastname', FILTER_SANITIZE_STRING);
        $accountEmail = filter_input(INPUT_POST, 'accountEmail', FILTER_SANITIZE_EMAIL);
        $accountPassword = filter_input(INPUT_POST, 'accountPassword', FILTER_SANITIZE_STRING);
        $accountPasswordRepeated = filter_input(INPUT_POST, 'accountPasswordRepeated', FILTER_SANITIZE_STRING);
        $accountEmail = checkEmail($accountEmail);
        $checkPassword = checkPassword($accountPassword);
        $pageTitle = 'Register';
        // Check passwords are the same
        if($accountPassword != $accountPasswordRepeated) {
            $message = '<div class="displayErrMessage">Passwords do not match.  Please try again.</div>';
            include '../views/register.php';
            exit; 
        }

        // Check for missing data
        if(empty($accountFirstname) || empty($accountLastname) || empty($accountEmail) || empty($checkPassword)){
            $message = '<div class="displayErrMessage">Please provide information for all empty form fields.</div>';
            include '../views/register.php';
            exit; 
        }

        $existingEmail = checkExistingEmail($accountEmail);

        // Check for existing email address in the table
        if($existingEmail){
         $message = '<div class="displayErrMessage">That email address already exists. Do you want to login instead?</div>';
         include '../views/login.php';
         exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($accountPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $regResult = register($accountFirstname, $accountLastname, $accountEmail, $hashedPassword);

        // Check and report the result
        if ($regResult === 1) {
            $_SESSION['message'] = "<div class=\"displayMessage\">Thanks for registering $accountFirstname. Please use your email and password to login.</div>";
            //include '../view/login.php';
            header('Location: /testgen/accounts/?action=loginView');
            exit;
        } else {
            $message = "<div class=\"displayErrMessage\">Sorry, $accountFirstname, but the registration failed. Please try again.</div>";
            include '../views/register.php';
            exit;
        }
        break;

    case 'login':
        $accountEmail = filter_input(INPUT_POST, 'accountEmail', FILTER_SANITIZE_EMAIL);
        $accountPassword = filter_input(INPUT_POST, 'accountPassword', FILTER_SANITIZE_STRING);
        $accountEmail = checkEmail($accountEmail);
        $checkPassword = checkPassword($accountPassword);
        $rememberMe = filter_input(INPUT_POST, 'remember', FILTER_SANITIZE_STRING);
        $pageTitle = 'Login';
        
        // Check for missing data
        if(empty($accountEmail) || empty($checkPassword)){
            $message = '<div class="msgDisplay">Please provide information for all empty form fields.</div>';
            include '../views/login.php';
            exit; 
        }
        $accountData = getAccountByEmail($accountEmail);
        $hashCheck = password_verify($accountPassword, $accountData['accountPassword']);     
        echo "HashCheck: " . password_hash($accountPassword, PASSWORD_DEFAULT) . " = " .  $accountData['accountPassword'];

        if(!$hashCheck) {
            if(!empty($_SESSION)) {
                $_SESSION['message'] = '<div class="msgDisplay">Invalid Password!  Please check your password and try again.</div>';
            } else {
                $message = '<div class="msgDisplay">Invalid Password.  Please check your password and try again.</div>';
            }
            include '../views/login.php';
            exit;
        }

        $_SESSION['loggedin'] = TRUE;
        $session_timeout = 10;  // ALTER THIS ACCORDINGLY
        if($rememberMe == 1) {
            $session_timeout = 24*60*60;  // ESPECIALLY HERE
        }
        $_SESSION['timeout'] = time() + $session_timeout;
        array_pop($accountData); // remove the last item - the password
        $_SESSION['accountData'] = $accountData;
    
        include '../views/mainmenu.php';
        exit;

    case 'logout':
        session_unset(); 
        session_destroy();
        $message = "<div class=\"displayErrMessage\">You Have Been Logged Out.</div>";
        $pageTitle = 'Logout';
        include '../views/login.php';
        exit;

    case 'myAccount':
        $pageTitle = 'My Account';
        include '../views/admin.php';
        exit;

    case 'updateAccount':
        $pageTitle = 'Account Update';
        include '../views/updateAccount.php';
        break;

    case 'updateProfileSubmit';
        // Filter and store the data
        $accountFirstName = filter_input(INPUT_POST, 'accountFirstname', FILTER_SANITIZE_STRING);
        $accountLastname = filter_input(INPUT_POST, 'accountLastname', FILTER_SANITIZE_STRING);
        $accountEmail = filter_input(INPUT_POST, 'accountEmail', FILTER_SANITIZE_EMAIL);
        $accountEmail = checkEmail($accountEmail);
        $accountID = filter_input(INPUT_POST, 'accountID', FILTER_SANITIZE_NUMBER_INT);
        $pageTitle = 'Account Update';

        // Check for missing data
        if(empty($accountFirstname) || empty($accountLastname) || empty($accountEmail) ){
            $message = '<div class="displayErrMessage">Please provide information for all empty form fields.</div>';
            include '../views/updateAccount.php';
            exit; 
        }

        $existingEmail = checkExistingEmail($accountEmail);

        // Check for existing email address in the table
        if($existingEmail && $accountEmail != $_SESSION['accountData']['accountEmail']){
         $message = '<div class="displayErrMessage">That email address already exists. Please choose another email address.</div>';
         include '../views/updateAccount.php';
         exit;
        }

        // Send the data to the model
        $updateResult = updateaccountProfile($accountFirstname, $accountLastname, $accountEmail, $accountId);

        // Check and report the result
        if($updateResult === 1){
            setcookie('firstname', $accountFirstname, strtotime('+1 year'), '/');
            $accountData = getaccountById($accountId);
            $_SESSION['accountData'] = $accountData;
            $_SESSION['message'] = "<div class=\"displayMessage\">Profile update successful.</div>";
            $pageTitle = 'My Account';
            header('Location: /accounts/?action=myAccount');
            exit;
        } else {
            $message = "<div class=\"displayErrMessage\">Sorry, the profile update failed. Please try again.</div>";
            include '../views/updateAccount.php';
            exit;
        }
        break;

    case 'updatePasswordSubmit';
        $accountPassword = filter_input(INPUT_POST, 'accountPassword', FILTER_SANITIZE_STRING);
        $accountPasswordRepeated = filter_input(INPUT_POST, 'accountPasswordRepeated', FILTER_SANITIZE_STRING);
        $checkPassword = checkPassword($accountPassword);
        $accountID = filter_input(INPUT_POST, 'accountID', FILTER_SANITIZE_NUMBER_INT);
        $pageTitle = 'Account Update';

        if($accountPassword != $accountPasswordRepeated) {
            $message = '<div class="displayErrMessage">Passwords do not match.  Please try again.</div>';
            include '../views/updateAccount.php';
            exit; 
        }

        if(empty($checkPassword)){
            $message = '<div class="displayErrMessage">Please provide information for all empty form fields.</div>';
            include '../views/updateAccount.php';
            exit; 
        }

        $hashedPassword = password_hash($accountPassword, PASSWORD_DEFAULT);
        $updateResult = updateaccountPw($hashedPassword, $accountId);

        if($updateResult === 1){
            $_SESSION['message'] = "<div class=\"displayMessage\">Password change successful.</div>";
            $pageTitle = 'My Account';
            header('Location: /accounts/?action=myAccount');
            exit;
        } else {
            $message = "<div class=\"displayErrMessage\">Sorry, password change failed. Please try again.</div>";
            include '../views/updateAccount.php';
            exit;
        }
        break;
    default:
}