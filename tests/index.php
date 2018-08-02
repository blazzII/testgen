<?php 
/* ∆ Tests Control ********************************/

session_start();
require_once 'library/connections.php';  // DB Connection
require_once 'model/tests.php';
require_once 'library/functions.php';

// ACTION method sanitize and use POST or GET
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    }

switch ($action) {
    
    case 'createNewTestView':
        $pageTitle = 'Create a New Test';
        include '../views/create-test.php';
        break;

    case 'createNewTest':
        
    // set with session - login
    // $testgenEvaluatorID = filter_input(INPUT_POST, 'testgenEvaluatorID', FILTER_SANITIZE_STRING);
    // pilots do not need to register
    // $testgenPilotID = filter_input(INPUT_POST, 'testgenPilotID', FILTER_SANITIZE_STRING);

        // Check for missing form data
        if(empty($testgenEvaluatorID) || empty($testgenPilotID)) {
            $message = '<div class="displayErrMessage">Please provide information for all empty form fields.</div>';
            include '../views/create-new-test.php';
            exit; 
        }

        // Send the data to the model
        $regResult = regaccount($accountFirstname, $accountLastname, $accountEmail, $hashedPassword);

        // Check and report the result
        if($regResult === 1){
            setcookie('firstname', $accountFirstname, strtotime('+1 year'), '/');
            //$message = "<div class=\"displayMessage\">Thanks for registering, $accountFirstname. Please use your email and password to login.</div>";
            $_SESSION['message'] = "<div class=\"displayMessage\">Thanks for registering $accountFirstname. Please use your email and password to login.</div>";
            //include '../view/login.php';
            header('Location: /accounts/?action=loginPage');
            exit;
        } else {
            $message = "<div class=\"displayErrMessage\">Sorry, $accountFirstname, but the registration failed. Please try again.</div>";
            include '../views/register.php';
            exit;
        }
        break;

    
    default:
}