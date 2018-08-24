<?php 
/* ∆ Accounts Control ********************************/

session_start();
require_once '../library/connections.php';  // DB Connection
require_once '../models/accounts.php';
require_once '../models/tests.php';
require_once '../library/functions.php';



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
            $_SESSION['message'] = '<div class="msg good">Thank you for registering ' . $accountFirstName . '.<br>Use your email and password to login.</div>';
            header('Location: ./?action=loginView');
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
        array_pop($accountData); // remove the last item - the password
        $_SESSION['accountData'] = $accountData;
        $pageTitle = 'Account Menu';
        header ('location: ./?action=accountView');
        exit;

    case 'logout':
        session_unset(); 
        session_destroy();
        $message = '<div class="msg warn center">You have been logged out.</div>';
        $pageTitle = 'Logout';
        header ('Location: /testgen/');
        exit;

    case 'accountView':
        $accLevelText = getAccountLevelText($_SESSION['accountData']['accLevel']);
        $testCount = getTestsTakenCount($_SESSION['accountData']['accID']);
        $tests = getAllTestsCreated($_SESSION['accountData']['accID']);
        $testWCount = count($tests);
        $pageTitle = 'My Account View';
        include '../views/account-menu.php';
        exit;

    case 'getAccountsView': // A list of account - based on account level 
        $accLevel = filter_input(INPUT_POST, 'accLevel', FILTER_SANITIZE_NUMBER_INT);
        if ($accLevel == NULL) {
            $accLevel = filter_input(INPUT_GET, 'accLevel', FILTER_SANITIZE_NUMBER_INT);
        }

        // validate input
        if (empty($accLevel)) {
            $_SESSION['message'] = '<div class="msg warn center">An account level was not properly set.</div>';
            header('location:./?action=accountView');
            exit;
        }

        $accounts = getAccountByLevel($accLevel);
        $accLevelText = getAccountLevelText($accLevel);
        $_SESSION['listnav'] = 1; // this is for navigation purposes if using the update account view

        $markup = '<table>';
        if ($_SESSION['accountData']['accLevel'] == 3) {
            $markup .= '<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Registration Date</th><th>&#10004;</th><th>&#10008;</th></tr>';
        } else {
            $markup .= '<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Registration Date</th><th>&check;</th></tr>';
        }
        foreach ($accounts as $account) {
            
            $editaccounturl = '../accounts?action=updateAccountView&accID=' . $account["accID"];
            $deleteaccounturl = '../accounts?action=deleteAccountView&accID=' . $account["accID"];
            $markup .= '<tr>
                        <td>' . $account['accFirstName'] . '</td>
                        <td>' . $account['accLastName'] . '</td>
                        <td>' . $account['accEmail'] . '</td>
                        <td>' . date('j M Y', strtotime($account['accDateRegistered'])) . '</td>
                        <td><button onclick="location.href=\'' . $editaccounturl . '\'">Edit</button></td>'; 
                        if ($_SESSION['accountData']['accLevel'] == 3) {
                            $markup .= '<td><button onclick="location.href=\'' . $deleteaccounturl . '\'">Delete</button></td>'; 
                        }
            $markup .= '</tr>';
        }
        $markup .= '</table>';
        
        $pageTitle = 'Registered ' . $accLevelText . ' Accounts';
        include '../views/account-list.php';
        exit;

    case 'updateAccountView':
        $accID = filter_input(INPUT_POST, 'accID', FILTER_SANITIZE_NUMBER_INT);
        if (empty($accID) || $accID == null) {
            header ('location: ./?action=accountView');
            exit;
        }
        $account = getAccountByID($accID);
        $accLevelText = getAccountLevelText($_SESSION['accountData']['accLevel']);
        $_SESSION['navAccLevel'] = $account['accLevel'];
        $pageTitle = 'Update Account Settings';
        include '../views/account-settings.php';
        break;

    case 'updateAccount':
        // Filter and store the data
        $accID = filter_input(INPUT_POST, 'accID', FILTER_SANITIZE_NUMBER_INT);
        $accFirstName = filter_input(INPUT_POST, 'accFirstName', FILTER_SANITIZE_STRING);
        $accLastName = filter_input(INPUT_POST, 'accLastName', FILTER_SANITIZE_STRING);
        $accEmail = filter_input(INPUT_POST, 'accEmail', FILTER_SANITIZE_EMAIL);
        $accLevel = filter_input(INPUT_POST, 'accLevel', FILTER_SANITIZE_NUMBER_INT);

        // Check for missing data
        if(empty($accFirstName) || empty($accLastName) || empty($accEmail) || empty($accLevel)){
            $message = '<div class="msg warn">Please provide information for all empty form fields.</div>';
            include '../views/account-settings.php';
            exit; 
        }

        // Send the data to the model
        $updateResult = updateAccount($accID, $accFirstName, $accLastName, $accEmail, $accLevel);

        // Check and report the result
        if ($updateResult === 1) {
            $_SESSION['message'] = '<div class="msg good">The account was successfully updated.</div>';
            if ($_SESSION['listnav'] === 1) {
                header('Location: ./?action=getAccountsView&accLevel=' . $_SESSION['navAccLevel']);
            } else {
                header('Location: ./?action=accountView');    
            }
            $_SESSION['listnav'] = 0;
            exit;
        } else {
            $_SESSION['message'] = '<div class="msg warn">Sorry, the account update failed. Please try again.</div>';
            header('Location: ./?action=updateAccountView&accID='.$accID);
            exit;
        }
        break;

    case 'deleteAccountView':
        $accID = filter_input(INPUT_GET, 'accID', FILTER_SANITIZE_NUMBER_INT);
        $account = getAccountById($accID); 
        $testCount = getTestsTakenCount($accID);
        $accLevelText = getAccountLevelText($account['accLevel']);
        $pageTitle = 'Delete Account View';
        include '../views/account-delete.php';
        break;
    
    case 'deleteAccount':
        $accID = filter_input(INPUT_POST, 'accID', FILTER_SANITIZE_NUMBER_INT);
        $accLevel = filter_input(INPUT_POST, 'accLevel', FILTER_SANITIZE_NUMBER_INT);

        $recorddeleted = deleteAccount($accID);
        if ($recorddeleted === 1) {
            $_SESSION['message'] = '<div class="msg good">The account was deleted.</div>';
        } else {
            $_SESSION['message'] = '<div class="msg warn">There was a problem accessing the account. The account may not have been deleted.</div>';
        }
        header ('Location: ./?action=getAccountsView&accLevel=' . $accLevel);
        break;

    case 'updatePassword':
        $accountPassword = filter_input(INPUT_POST, 'accountPassword', FILTER_SANITIZE_STRING);
        $accountPasswordRepeated = filter_input(INPUT_POST, 'accountPasswordRepeated', FILTER_SANITIZE_STRING);
        $checkPassword = checkPassword($accountPassword);
        $accountID = filter_input(INPUT_POST, 'accountID', FILTER_SANITIZE_NUMBER_INT);
        $pageTitle = 'Account Update';

        if($accountPassword != $accountPasswordRepeated) {
            $message = '<div class="msg warn">Passwords do not match.  Please try again.</div>';
            include '../views/account-settings.php';
            exit; 
        }

        if(empty($checkPassword)){
            $message = '<div class="msg warn">Please provide information for all empty form fields.</div>';
            include '../views/account-settings.php';
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

    case 'retrievePasswordView':
        $pageTitle = 'Forgot Password';
        include '../views/account-password.php';
        break;

    case 'retrievePassword':
        $accountEmail = filter_input(INPUT_POST, 'accountEmail', FILTER_SANITIZE_EMAIL);
        $accountEmail = checkEmail($accountEmail);
        $emailFound = checkExistingEmail($accountEmail);
        if(empty($accountEmail) || $emailFound == 0) {
            $message = '<div class="msg warn">Please enter a valid, registered email address.</div>';
            include '../views/account-login.php';
            exit;
        }
        sendEmail($accountEmail);
        $message = '<div class="msg good">Your password was sent to your email address.</div>';
        include '../views/account-login.php';
        break;

    default:
        if ($_SESSION['loggedin'] === TRUE) {
          $testCount = getTestsTakenCount($_SESSION['accountData']['accID']);
          $tests = getAllTestsByaccID($_SESSION['accountData']['accID']);
          $testWCount = count($tests);
          $pageTitle = 'My Air Test Gen Account';
          include '../views/account-menu.php';
          exit;
        } else {
            header ('Location: ./?action=login');
        }
}