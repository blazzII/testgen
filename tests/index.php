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

// clear session message
$_SESSION['message'] = null;

// action sanitize and use POST or GET
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

function getTestQuestions() {
    $questions = getTestBytestID($_SESSION['testID']);
        
    if (empty($_SESSION['testID']) || count($questions) < 1) {
      $message = '<div class="msg warn">Please provide a valid Test Code or the test that you entered does not have any questions assigned to it.<br> You provided: ' . $_SESSION['testID'] . '</div>';
      include '../views/test-select.php';
      exit; 
    }    

    $qNum = 1;
    $testQuestions = "";
    foreach ($questions as $question) {
      
      if (!empty(filter_input(INPUT_POST, 'ans'. $question['testquestionID'], FILTER_SANITIZE_STRING))) {
        $savedAnswer = filter_input(INPUT_POST, 'ans'. $question['testquestionID'], FILTER_SANITIZE_STRING);
      } else {
        $savedAnswer = "";
      }
      $testQuestions .= '<div class="formitemquestion">
                         <p><strong><span class="blue">Question # ' . $qNum . ' </span> &#10070; [' . $question['catName'] . ']</strong><br>
                         ' . $question['qQuestion'] . '</p>
                         <textarea name="ans' . $question['testquestionID'] . '" required cols="70" rows="5">' . trim($savedAnswer) . '</textarea>
                         </div><hr>';  
      $qNum++;
    }
    return $testQuestions;
}

switch ($action) {
    case 'createTestView':
        $pageTitle = 'Create a New Test';
        $formItems = buildFormItemCategories();
        include '../views/test-create.php';
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
            $result = addNewTest($testID, $_SESSION['accountData']['accID']);
            if ($result === 1) {
                // testquestion table
                foreach($testquestions as $questionID) {
                    $testquestion = addNewTestQuestion($testID, $questionID);
                }
                if($testquestion === 1) {
                    $_SESSION['message'] = '<div class="msg good">A new test was successfully created. The ID value is ' . $testID . '</div>';
                    header('location: ./?action=evaluatorTestQuestionsView&testID=' . $testID);
                    exit;
                } else {
                    $_SESSION['message'] = '<div class="msg warn">Something went wrong when creating a new test.<br>There may be no active questions in the selected category/categories.</div>';
                    header('location:./?action=createTestView');
                    exit;
                }
            }
        } else {
            $message = '<div class="msg warn">Something went wrong when creating a new test in that questions were not selected.</div>';
            include '../views/test-create.php';
            exit;
        }
        break;

    case 'testSelectView':   
        $pageTitle = 'Select Test';
        include '../views/test-select.php';
        break;

    
    case 'testView':   
        $testID = filter_input(INPUT_POST, 'testID', FILTER_SANITIZE_STRING);
        if ($testID == NULL) {
          $testID = filter_input(INPUT_GET, 'testID', FILTER_SANITIZE_STRING);
        }  
        if ($testID != NULL) {
          $_SESSION['testID'] = $testID;
        }

        $testQuestions = getTestQuestions();
        $pageTitle = 'Test ' . $_SESSION['testID'];
        include '../views/test-display.php';
        break;

    case 'evaluatorTestQuestionsView':
        $testID = filter_input(INPUT_POST, 'testID', FILTER_SANITIZE_STRING);
          if ($testID == NULL) {
            $testID = filter_input(INPUT_GET, 'testID', FILTER_SANITIZE_STRING);
        }  
        $questions = getTestBytestID($testID);
        
        $qNum = 1;
        $testQuestions = '<table>';
        $testQuestions .= '<tr><th>#</th><th>Question</th><th>Category</th><th>Active</th>';
        foreach ($questions as $question) {
            ($question['qActive'] === '1') ? $background = 'class="qactive left"' : $background = 'class="qnotactive left"';
            ($question['qActive'] === '1') ? $status = 'Active' : $status = 'No';
            
            $testQuestions .= '<tr>
                              <td>' . $qNum . '</td>
                              <td>' . $question['qQuestion'] . '</td>
                              <td>' . $question['catName'] . '</td>
                              <td  ' . $background . '>' . $status . '</td>
                              </tr>';
            $qNum++;
        }
        $testQuestions .= '</table>';
        $pageTitle = 'Test ' . $testID;
        include '../views/test-questions.php';
        break;

    case 'viewAllTestsByAccount':   
        /*if (!isset($_SESSION['accountData']['accID']) || $_SESSION['accountData']['accID'] == NULL) {
            $accID = filter_input(INPUT_POST, 'accID', FILTER_SANITIZE_NUMBER_INT);
            if ($accID == NULL) {
                $accID = filter_input(INPUT_GET, 'accID', FILTER_SANITIZE_STRING);
            }  
            $_SESSION['accD'] = $accID;
        } */   
        $results = getAllTestsByaccID($_SESSION['accountData']['accID']);
        
        if (count($results) < 1) {
          $message = '<div class="msg warn">There are no tests registered under your account.</div>';
          include '../views/account-menu.php';
          exit; 
        }    

        $testlistoutput = "<table><tr><th>&check;</th><th>Test ID</th><th>Date Created</th><th># of Questions</th></tr>";
        foreach ($results as $test) {

            $questionurl = './?action=evaluatorTestQuestionsView&testID=' . $test["testID"];

            $testlistoutput .= '<tr>
                                <td><button onclick="location.href=\'' . $questionurl . '\'">Open</button></td>
                                <td>' . $test['testID'] . '</td>
                                <td>' . date('j F Y', strtotime($test['testDateCreated'])) . '</td>
                                <td>' . $test['qTotal'] . '</td> 
                                </tr>';
        }
        $testlistoutput .= "</table>";
        $pageTitle = 'Test Created';
        include '../views/test-list.php';
        break;        
    
    case 'submitTest':
        // Check if the client is set with accID
        // If the client not set then create a new account with the DEFAULT password
        if (!$_SESSION['loggedin']) {
            $accountFirstName = filter_input(INPUT_POST, 'accountFirstName', FILTER_SANITIZE_STRING);
            $accountLastName = filter_input(INPUT_POST, 'accountLastName', FILTER_SANITIZE_STRING);
            $accountEmail = filter_input(INPUT_POST, 'accountEmail', FILTER_SANITIZE_EMAIL);
            $accountEmail = checkEmail($accountEmail);

            // Check for missing data and redirect if necessary
            if(empty($accountFirstName) || empty($accountLastName) || empty($accountEmail)) {
              $message = '<div class="msg warn">Please provide the contact information requested.</div>';
              $testQuestions = getTestQuestions();
              $pageTitle = 'Test ' . $_SESSION['testID'];
              include '../views/test-display.php';
              exit; 
            }
            // Hash the the default password ////////////////////////////////////////
            $hashedPassword = password_hash("testgen123!", PASSWORD_DEFAULT);
            // Register the client data
            $accID = register($accountFirstName, $accountLastName, $accountEmail, $hashedPassword);
            $_SESSION['accID'] = $accID;
        } else {
            $_SESSION['accID'] = $_SESSION['accountData']['accID'];
        }

        foreach($_POST as $testquestionID => $value) {
            if (strpos($testquestionID, 'ans') == 1) {
                if ($value != "" && !empty($value)) {
                    $testquestionID = substr($testquestionID,3);
                    $recordAdded = recordAnswers($testquestionID, $value, $_SESSION['accID']);  
                    if ($recordAdded != 1) {
                        $message = '<div class="msg warn">There was a problem writing your answers to the database.</div>';
                        $testQuestions = getTestQuestions();
                        $pageTitle = 'Test ' . $_SESSION['testID'];
                        include '../views/test-display.php';
                        exit;
                    }
                }
            }
        }
        $_SESSION['message'] = '<div class="msg good">Your answers were recorded.</div>';
        header('location:../accounts/');
        break;

    case 'emailTest':
        $pilotEmail = filter_input(INPUT_POST, 'pilotEmail', FILTER_SANITIZE_EMAIL);
        $pilotEmail = checkEmail($pilotEmail);
        $testID = filter_input(INPUT_POST, 'testID', FILTER_SANITIZE_STRING);

        if(empty($pilotEmail) || empty($testID)){
            $message = '<div class="msg warn">Please provide a valid email address.</div>';
            include '../views/test-questions.php';  // error not sending test info?
            exit; 
        } 

        // Set Up Email
        $subject = 'TestGen TestID';
        $header = 'From';
        $message = 'Please got to http://www.testgen.com and use the following test identification code: ' . $testID;
        $sentmail = mail($pilotEmail,$subject,$message,$header);
        if ($sentmail) {
            $message = '<div class="msg good">The test identification code of ' . $testID . ' was sent to the email address provided.';
            include '../views/test-list.php';
        } else {
            $message = '<div class="msg warn">There was an error while sending the e-mail';
            include '../views/test-questions.php';
        }
        break;
    
    default:
        echo 'Test model error .. check action path';
        break;
}