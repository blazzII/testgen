<?php 
/* ∆ Accounts Control ********************************/

session_start();
require_once '../library/connections.php';  // DB Connection
require_once '../models/accounts.php';
require_once '../models/tests.php';
require_once '../library/functions.php';

// clear session message
$_SESSION['message'] = null;

// ACTION method sanitize and use POST or GET
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
    }

switch ($action) {
    
    case 'loginView':
        $pageTitle = 'Login';
        include '../views/account-login.php';
        break;

    case 'registrationView':
        $pageTitle = 'Register';
        include '../views/account-register.php';
        break;

    case 'registration':
        $accountFirstName = filter_input(INPUT_POST, 'accountFirstName', FILTER_SANITIZE_STRING);
        $accountLastName = filter_input(INPUT_POST, 'accountLastName', FILTER_SANITIZE_STRING);
        $accountEmail = filter_input(INPUT_POST, 'accountEmail', FILTER_SANITIZE_EMAIL);
        $accountPassword = filter_input(INPUT_POST, 'accountPassword', FILTER_SANITIZE_STRING);
        $accountPasswordRepeated = filter_input(INPUT_POST, 'accountPasswordRepeated', FILTER_SANITIZE_STRING);
        $accountEmail = checkEmail($accountEmail);
        $checkPassword = checkPassword($accountPassword);
        // Check passwords are the same
        if($accountPassword != $accountPasswordRepeated) {
            $message = '<div class="msg warn">Passwords do not match.  Please try again.</div>';
            include '../views/account-register.php';
            exit; 
        }

        // Check for missing data
        if(empty($accountFirstName) || empty($accountLastName) || empty($accountEmail) || empty($checkPassword)){
            $message = '<div class="msg warn">Please provide information for all empty form fields.</div>'. $accountFirstName .$accountLastName.$accountEmail.$accountPassword;
            include '../views/account-register.php';
            exit; 
        }

        // Check for existing email address
        $existingEmail = checkExistingEmail($accountEmail);
        if($existingEmail){
            $message = '<div class="msg warn">That email address already exists. Do you want to login instead?</div>';
            include '../views/account-login.php';
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($accountPassword, PASSWORD_DEFAULT);

        // Register the account using hashedPassword and given fields
        $accID = register($accountFirstName, $accountLastName, $accountEmail, $hashedPassword);
        // Check and report the result
        if ($accID > 0) {
            $_SESSION['message'] = '<div class="msg good">Thank you for registering ' . $accountFirstName . $accID . '.<br>Use your email and password to login.</div>';
            header('Location: /testgen/accounts/?action=loginView');
            exit;
        } else {
            $message = '<div class="msg warn">Sorry,' . $accountFirstName . ', but the registration failed. Please try again.</div>';
            include '../views/account-register.php';
            exit;
        }
        break;

    case 'login':
        $accountEmail = filter_input(INPUT_POST, 'accountEmail', FILTER_SANITIZE_EMAIL);
        $accountPassword = filter_input(INPUT_POST, 'accountPassword', FILTER_SANITIZE_STRING);
        $accountEmail = checkEmail($accountEmail);
        $checkPassword = checkPassword($accountPassword);
        $rememberMe = filter_input(INPUT_POST, 'remember', FILTER_SANITIZE_STRING);
        
        // Check for missing data
        if(empty($accountEmail) || empty($checkPassword)){
            $message = '<div class="msg warn">Please provide information for all empty form fields.</div>';
            include '../views/account-login.php';
            exit; 
        }
        $accountData = getAccountByEmail($accountEmail);
        $hashCheck = password_verify($accountPassword, $accountData['accPassword']);     
        //echo "HashCheck: " . password_hash($accountPassword, PASSWORD_DEFAULT) . " = " .  $accountData['accountPassword'];

        if (!$hashCheck) {
            $message = '<div class="msg warn">Invalid Password.  Please check your password and try again.</div>';
            include '../views/account-login.php';
            exit;
        }
        
        $_SESSION['loggedin'] = TRUE;
        $session_timeout = 10; 
        if($rememberMe == 1) {
            $session_timeout = 24*60*60; 
        }
        $_SESSION['timeout'] = time() + $session_timeout;
        array_pop($accountData); // remove the last item - the password
        $_SESSION['accountData'] = $accountData;
        $pageTitle = 'Account Menu';
        include '../views/account-menu.php';
        exit;

    case 'logout':
        session_unset(); 
        session_destroy();
        $message = '<div class="msg warn center">You have been logged out.</div>';
        $pageTitle = 'Logout';
        header ('Location: /testgen/');
        exit;

    case 'accountView':
        $testCount = getTestsTakenCount($_SESSION['accountData']['accID']);
        $pageTitle = 'My Air Test Gen Account';
        include '../views/account-menu.php';
        exit;

    case 'getAccountsView': // three options - 
        $accLevel = filter_input(INPUT_POST, 'accLevel', FILTER_SANITIZE_NUMBER_INT);
        // validate input
        if (empty($accLevel)) {
            $message = '<div class="msg warn center">An account level was not properly set.</div>';
            include '../views/account-menu.php';
        }

        $accounts = getAccountByLevel($accLevel);
        // determine level
              switch ($accLevel) {
                case 1:
                  $accLevelText = "Pilot";
                  break;
                case 2:
                  $accLevelText = "Evaluator";
                  break;
                case 3:
                  $accLevelText = "Administrator";
                  break;
                default:
                  $accLevelText = 'Undetermined Error.';
                  break;
              }
        $markup = '<table>';
        $markup .= '<tr><th>&check;</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Registration Date</th></tr>';
        foreach ($accounts as $account) {
            
            $questionurl = '../accounts?action=editAccountView&accID=' . $account["accID"];
            $markup .= '<tr><td><button onclick="location.href=\'' . $questionurl . '\'">Edit</button></td>
                        <td>' . $account['accFirstName'] . '</td>
                        <td>' . $account['accLastName'] . '</td>
                        <td>' . $account['accEmail'] . '</td>
                        <td>' . date('j F Y', strtotime($account['accDateRegistered'])) . '</td>
                        </td><tr>';
        }
        $markup .= '</table>';
        
        $pageTitle = 'Registered Accounts';
        include '../views/account-list.php';
        exit;

    case 'updateAccountView':
        $pageTitle = 'Account Settings';
        include '../views/account-settings.php';
        break;

    case 'updateAccount':
        // Filter and store the data
        $accountFirstName = filter_input(INPUT_POST, 'accountFirstname', FILTER_SANITIZE_STRING);
        $accountLastname = filter_input(INPUT_POST, 'accountLastname', FILTER_SANITIZE_STRING);
        $accountEmail = filter_input(INPUT_POST, 'accountEmail', FILTER_SANITIZE_EMAIL);
        $accountEmail = checkEmail($accountEmail);
        $accountID = filter_input(INPUT_POST, 'accountID', FILTER_SANITIZE_NUMBER_INT);
        $pageTitle = 'Account Update';

        // Check for missing data
        if(empty($accountFirstname) || empty($accountLastname) || empty($accountEmail) ){
            $message = '<div class="msg warn">Please provide information for all empty form fields.</div>';
            include '../views/updateAccount.php';
            exit; 
        }

        $existingEmail = checkExistingEmail($accountEmail);

        // Check for existing email address in the table
        if($existingEmail && $accountEmail != $_SESSION['accountData']['accountEmail']){
         $message = '<div class="msg warn">That email address already exists. Please choose another email address.</div>';
         include '../views/updateAccount.php';
         exit;
        }

        // Send the data to the model
        $updateResult = updateaccountProfile($accountFirstname, $accountLastname, $accountEmail, $accountId);

        // Check and report the result
        if($updateResult === 1){
            $accountData = getaccountById($accountId);
            array_pop($accountData); // remove the last item - the password
            $_SESSION['accountData'] = $accountData;
            $message = '<div class="msg good">Profile update successful.</div>';
            $pageTitle = 'My Account';
            header('Location: /accounts/?action=myAccount');
            exit;
        } else {
            $message = '<div class="msg warn">Sorry, the profile update failed. Please try again.</div>';
            include '../views/updateAccount.php';
            exit;
        }
        break;

    case 'updatePassword':
        $accountPassword = filter_input(INPUT_POST, 'accountPassword', FILTER_SANITIZE_STRING);
        $accountPasswordRepeated = filter_input(INPUT_POST, 'accountPasswordRepeated', FILTER_SANITIZE_STRING);
        $checkPassword = checkPassword($accountPassword);
        $accountID = filter_input(INPUT_POST, 'accountID', FILTER_SANITIZE_NUMBER_INT);
        $pageTitle = 'Account Update';

        if($accountPassword != $accountPasswordRepeated) {
            $message = '<div class="msg warn">Passwords do not match.  Please try again.</div>';
            include '../views/updateAccount.php';
            exit; 
        }

        if(empty($checkPassword)){
            $message = '<div class="msg warn">Please provide information for all empty form fields.</div>';
            include '../views/updateAccount.php';
            exit; 
        }

        $hashedPassword = password_hash($accountPassword, PASSWORD_DEFAULT);
        $updateResult = updateAccountPassword($hashedPassword, $accountId);

        if($updateResult === 1){
            $message = '<div class="msg good">Password change successful.</div>';
            $pageTitle = 'My Account';
            header('Location: /accounts/?action=myAccount');
            exit;
        } else {
            $message = '<div class="msg warn">Sorry, password change failed. Please try again.</div>';
            include '../views/updateAccount.php';
            exit;
        }
        break;
    default:
        if ($_SESSION['loggedin'] === TRUE) {
          $testCount = getTestsTakenCount($_SESSION['accountData']['accID']);
          $pageTitle = 'My Air Test Gen Account';
          include '../views/account-menu.php';
          exit;
        } else {
          header ('Location: /testgen/accounts/?action=login');
        }
}