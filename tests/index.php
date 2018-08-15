<?php 
/* Tests Control **************************************************/

session_start();
require_once '../library/connections.php'; 
require_once '../models/tests.php';
require_once '../models/categories.php';
require_once '../models/questions.php';
require_once '../models/testquestions.php';
require_once '../models/accounts.php';
require_once '../library/functions.php';

// action sanitize and use POST or GET
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

function getTestQuestions() {
    $questions = getTestBytestID($_SESSION['testID']);
        
    if (empty($_SESSION['testID']) || count($questions) < 1) {
      $message = '<div class="msg warn">Please provide a valid Test Code. You provided: ' . $_SESSION['testID'] . '</div>';
      include '../views/select-test.php';
      exit; 
    }    

    $qNum = 1;
    $testQuestions = "";
    foreach ($questions as $question) {
        $testQuestions .= '<div class="formitemquestion">
        <label for="a' . $question['testquestionID'] . '"><strong><span class="blue">Question # ' . $qNum . ' 
        </span><br>Category: ' . $question['catName'] . '</strong>
        <br>' . $question['qQuestion'] . '
        </label>
        <textarea name="a' . $question['testquestionID'] . '" required cols="80" rows="5"></textarea>
        </div><hr>';  
        $qNum++;
    }
    return $testQuestions;
}

switch ($action) {
    case 'createTestView':
        $pageTitle = 'Test Generator • Create a New Test';
        $formItems = buildFormItemCategories();
        include '../views/create-test.php';
        break;

    case 'createTest':   
        $createTest = 0;
        $testquestions = array();

        foreach($_POST as $index => $value) {
            if (strlen($index) < 2 ) {
                //echo 'Index: ' . $index . '   Value: ' . $value . '<br>';
                if ($value > 0) {
                    $questions = getRandomQuestions($index, $value);
                    foreach ($questions as $question) {   
                        array_push($testquestions, $question['qID']);
                    }
                    $createTest = 1;         
                }
            }
        }

        if ($createTest === 1) {
            $testID = buildRandomTestID(); 
            $result = addNewTest($testID, $_SESSION['accID']);
            if ($result === 1) {
                // testquestion table
                foreach($testquestions as $questionID) {
                    $testquestion = addNewTestQuestion($testID, $questionID);
                }
                if($testquestion === 1) {
                    $message = '<div class="msg good">A new test was successfully created. The ID value is ' . $testID . '</div>';
                    header('Location: /testgen/accounts/?action=viewAccount');
                    exit;
                } else {
                    $message = '<div class="msg warn">Something went wrong when creating a new test.</div>';
                    include '../views/create-test.php';
                    exit;
                }
            }
        }
        break;

    case 'testSelectView':   
        $pageTitle = 'Select Test';
        include '../views/select-test.php';
        break;

    
    case 'testView':   
        if (!isset($_SESSION['testID']) || empty($_SESSION['testID'])) {
            $testID = filter_input(INPUT_POST, 'testID', FILTER_SANITIZE_STRING);
            $_SESSION['testID'] = $testID;
        } 
        $testQuestions = getTestQuestions();
        $pageTitle = 'Test ' . $_SESSION['testID'];
        include '../views/test.php';
        break;


    case 'viewAllTestsByAccount':   
        $accID = filter_input(INPUT_POST, 'accID', FILTER_SANITIZE_NUMBER_INT);
        $results = getAllTestsByaccID($accID);
        
        if (empty($accID) || count($results) < 1) {
          $message = '<div class="msg warn">There are no tests registered under your account.</div>';
          include '../views/account-menu.php';
          exit; 
        }    

        $testlistoutput = "<table><tr><th>ID</th><th>#Q</th><th>Date</th><th>Count</th></tr>";
        foreach ($results as $test) {
            $testlistoutput .= '<tr>
                                <td>' . $test['testID'] . '</td>
                                <td>' . $test['qTotal'] . '</td> 
                                <td>' . date('j F Y', strtotime($test['testDateCreated'])) . '</td>
                                <td>' . $test['submissionCount'] . '</td>
                                </tr>';
        }
        $testlistoutput .= "</table>";
        $pageTitle = 'Tests Created by ' . $accID;
        include '../views/tests-view-all.php';
        break;        
    
    case 'submitTest':
        // Check if the client is set with accID
        // If the client not set then create a new account with the DEFAULT password
        if (!isset($_SESSION['accID'])) {
            $accountFirstName = filter_input(INPUT_POST, 'accountFirstName', FILTER_SANITIZE_STRING);
            $accountLastName = filter_input(INPUT_POST, 'accountLastName', FILTER_SANITIZE_STRING);
            $accountEmail = filter_input(INPUT_POST, 'accountEmail', FILTER_SANITIZE_EMAIL);
            $accountEmail = checkEmail($accountEmail);

            // Check for missing data and redirect if necessary
            if(empty($accountFirstName) || empty($accountLastName) || empty($accountEmail)) {
              $message = '<div class="msg warn">Please provide the contact information requested.</div>';
              $testQuestions = getTestQuestions();
              $pageTitle = 'Test ' . $_SESSION['testID'];
              include '../views/test.php';
              exit; 
            }
            // Hash the the default password ////////////////////////////////////////
            $hashedPassword = password_hash("testgen123!", PASSWORD_DEFAULT);
            // Register the client data
            $accID = register($accountFirstName, $accountLastName, $accountEmail, $hashedPassword);
            echo $accID;
            $_SESSION['accID'] = $accID; // Note the difference in this session versus ['clientData'][]
        }

        foreach($_POST as $testquestionID => $value) {
            if (strpos($testquestionID, 'a') === 0) {
                if ($value != "" && !empty($value)) {
                    $recordedAdded = recordAnswers($testquestionID, $value, $_SESSION['accID']);  
                    if ($recordedAdded != 1) {
                        $message = '<div class="msg warn">There was a problem writing your answers to the database.</div>';
                        $testQuestions = getTestQuestions();
                        $pageTitle = 'Test ' . $_SESSION['testID'];
                        include '../views/test.php';
                        exit;
                    }
                }
            }
        }

        break;
    
    default:
      echo "Test model error .. check action path";
      break;
}