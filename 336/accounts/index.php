<?php 

/*
------------------------------------------------
ACCOUNTS CONTROLLER FILE
------------------------------------------------
*/
// Create or access a Session
session_start();
// Get the database connection file
require_once '../library/connections.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the misc. functions
require_once '../library/functions.php';
// Get the array of categories
$categories = getCategories();

//var_dump($categories);
//exit;

// get the navList
$navList = buildNavList($categories);

// get post/get action value
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    }

switch ($action) {
    case 'loginPage':
        $pageTitle = 'Login';
        include '../view/login.php';
        break;
    case 'registerPage':
        $pageTitle = 'Register';
        include '../view/register.php';
        break;
    case 'registerSubmit':
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $clientPasswordRepeated = filter_input(INPUT_POST, 'clientPasswordRepeated', FILTER_SANITIZE_STRING);
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);
        $pageTitle = 'Register';
        // Check passwords are the same
        if($clientPassword != $clientPasswordRepeated) {
            $message = '<div class="displayErrMessage">Passwords do not match.  Please try again.</div>';
            include '../view/register.php';
            exit; 
        }

        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
            $message = '<div class="displayErrMessage">Please provide information for all empty form fields.</div>';
            include '../view/register.php';
            exit; 
        }

        $existingEmail = checkExistingEmail($clientEmail);

        // Check for existing email address in the table
        if($existingEmail){
         $message = '<div class="displayErrMessage">That email address already exists. Do you want to login instead?</div>';
         include '../view/login.php';
         exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $regResult = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check and report the result
        if($regResult === 1){
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            //$message = "<div class=\"displayMessage\">Thanks for registering, $clientFirstname. Please use your email and password to login.</div>";
            $_SESSION['message'] = "<div class=\"displayMessage\">Thanks for registering $clientFirstname. Please use your email and password to login.</div>";
            //include '../view/login.php';
            header('Location: /accounts/?action=loginPage');
            exit;
        } else {
            $message = "<div class=\"displayErrMessage\">Sorry, $clientFirstname, but the registration failed. Please try again.</div>";
            include '../view/register.php';
            exit;
        }
        break;

    case 'submitLogin':
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);
        $rememberMe = filter_input(INPUT_POST, 'remember', FILTER_SANITIZE_STRING);
        $pageTitle = 'Login';
        // Check for missing data
        if(empty($clientEmail) || empty($checkPassword)){
            $message = '<div class="displayErrMessage">Please provide information for all empty form fields.</div>';
            include '../view/login.php';
            exit; 
        }


        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClientByEmail($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if(!$hashCheck) {
            if(!empty($_SESSION)) {
                $_SESSION['message'] = '<div class="displayErrMessage">Invalid Password.  Please check your password and try again.</div>';
            } else {
                $message = '<div class="displayErrMessage">Invalid Password.  Please check your password and try again.</div>';
            }
            include '../view/login.php';
            exit;
        }
        // A valid user exists, log them in

        //reset the cookie firstname variable
        setcookie('firstname', $clientData['clientFirstname'], strtotime('+1 year'), '/');

        $_SESSION['loggedin'] = TRUE;
        //Create a session time out
        $session_timeout = 10;
        if($rememberMe == 1) {
            $session_timeout = 24*60*60;
        }
        $_SESSION['timeout'] = time() + $session_timeout;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin view
        include '../view/admin.php';
        exit;
    case 'logout':
        // remove all session variables
        session_unset(); 
        // Logging out, destroy the session.
        session_destroy();
        $message = "<div class=\"displayErrMessage\">You Have Been Logged Out.</div>";
        $pageTitle = 'Logout';
        include '../view/login.php';
        exit;
    case 'myAccount':
        $pageTitle = 'My Account';
        include '../view/admin.php';
        exit;
    case 'updateAccount':
        $pageTitle = 'Account Update';
        include '../view/updateAccount.php';
        break;
    case 'updateProfileSubmit';
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientEmail = checkEmail($clientEmail);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $pageTitle = 'Account Update';

        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) ){
            $message = '<div class="displayErrMessage">Please provide information for all empty form fields.</div>';
            include '../view/updateAccount.php';
            exit; 
        }

        $existingEmail = checkExistingEmail($clientEmail);

        // Check for existing email address in the table
        if($existingEmail && $clientEmail != $_SESSION['clientData']['clientEmail']){
         $message = '<div class="displayErrMessage">That email address already exists. Please choose another email address.</div>';
         include '../view/updateAccount.php';
         exit;
        }

        // Send the data to the model
        $updateResult = updateClientProfile($clientFirstname, $clientLastname, $clientEmail, $clientId);

        // Check and report the result
        if($updateResult === 1){
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $clientData = getClientById($clientId);
            $_SESSION['clientData'] = $clientData;
            $_SESSION['message'] = "<div class=\"displayMessage\">Profile update successful.</div>";
            $pageTitle = 'My Account';
            header('Location: /accounts/?action=myAccount');
            exit;
        } else {
            $message = "<div class=\"displayErrMessage\">Sorry, the profile update failed. Please try again.</div>";
            include '../view/updateAccount.php';
            exit;
        }
        break;
    case 'updatePwSubmit';
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $clientPasswordRepeated = filter_input(INPUT_POST, 'clientPasswordRepeated', FILTER_SANITIZE_STRING);
        $checkPassword = checkPassword($clientPassword);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $pageTitle = 'Account Update';
        // Check passwords are the same
        if($clientPassword != $clientPasswordRepeated) {
            $message = '<div class="displayErrMessage">Passwords do not match.  Please try again.</div>';
            include '../view/updateAccount.php';
            exit; 
        }

        // Check for missing data
        if(empty($checkPassword)){
            $message = '<div class="displayErrMessage">Please provide information for all empty form fields.</div>';
            include '../view/updateAccount.php';
            exit; 
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $updateResult = updateClientPw($hashedPassword, $clientId);

        // Check and report the result
        if($updateResult === 1){
            $_SESSION['message'] = "<div class=\"displayMessage\">Password change successful.</div>";
            $pageTitle = 'My Account';
            header('Location: /accounts/?action=myAccount');
            exit;
        } else {
            $message = "<div class=\"displayErrMessage\">Sorry, password change failed. Please try again.</div>";
            include '../view/updateAccount.php';
            exit;
        }
        break;
    default:
}