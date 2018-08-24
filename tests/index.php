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
$_SESSION['message'] = NULL;

// action sanitize and use POST or GET
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
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
            if (strlen($index) < 3 ) {
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

    
    // create the test form based on a valid testID supplied
    case 'testView':   
        $testID = filter_input(INPUT_POST, 'testID', FILTER_SANITIZE_STRING);
        if ($testID == NULL) {
          $testID = filter_input(INPUT_GET, 'testID', FILTER_SANITIZE_STRING);
        }  
        if ($testID == NULL) {
            $message = '<div class="msg warn">Please submit a valid test ID value.</div>';
            include '../views/test-select.php';
            exit; 
        }    
        $questions = getTestBytestID($testID);    
        if (count($questions) < 1) {
            $message = '<div class="msg warn">The test that you entered does not have any questions assigned to it!</div>'.$testID;
            include '../views/test-select.php';
        exit; 
        }    
        $_SESSION['testID'] = $testID;
        $qNum = 1;  // displayed question number
        $testQuestions = "";  // initialize markup
        foreach ($questions as $question) {
            if (!empty(filter_input(INPUT_POST, 'ans'. $question['testquestionID'], FILTER_SANITIZE_STRING))) {
                $savedAnswer = filter_input(INPUT_POST, 'ans'. $question['testquestionID'], FILTER_SANITIZE_STRING);
            } else {
                $savedAnswer = "";
            }
            $testQuestions .= '<div class="formitemquestion">
                               <p><strong><span class="blue">Question # ' . $qNum . ' </span></strong>
                               &nbsp;&#10070;
                               <small>' . $question['catName'] . '</small><br>'
                               . $question['qQuestion'] . '</p>
                               <textarea name="ans' . $question['testquestionID'] . '" required cols="70" rows="5">' . trim($savedAnswer) . '</textarea>
                               </div><hr>';  
            $qNum++;
        }
        $pageTitle = 'Test ' . $testID;
        include '../views/test-display.php';
        break;

    // get all questions
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

    
    
    case 'submitTest':
        // Check if the client is set with accID
        // If the client not set then create a new account with the DEFAULT password
        if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
            $accountFirstName = filter_input(INPUT_POST, 'accountFirstName', FILTER_SANITIZE_STRING);
            $accountLastName = filter_input(INPUT_POST, 'accountLastName', FILTER_SANITIZE_STRING);
            $accountEmail = filter_input(INPUT_POST, 'accountEmail', FILTER_SANITIZE_EMAIL);
            $accountEmail = checkEmail($accountEmail);

            // Check for missing data and redirect if necessary
            if(empty($accountFirstName) || empty($accountLastName) || empty($accountEmail)) {
              $_SESSION['message'] = '<div class="msg warn">Please provide the contact information requested.</div>';
              $testID = filter_input(INPUT_POST, 'testID', FILTER_SANITIZE_NUMBER_INT);
              header ('location: ./?action=testView&testID='.$testID);
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

        $writeFlag = FALSE;
        foreach($_POST as $testquestionID => $value) {
            if (strpos($testquestionID, 'ans') === 0) {
                if ($value != "" && !empty($value)) {
                    $testquestionID = substr($testquestionID,3);
                    $recordAdded = recordAnswers($testquestionID, $value, $_SESSION['accID']);  
                    if ($recordAdded != 1) {
                        $_SESSION['message'] = '<div class="msg warn">There was a problem writing your answers to the database.</div>';
                        header ('location: ./?action=testView&testID='.$testID);
                        exit;
                    } else {
                        $writeFlag = TRUE;
                    }
                }
            }
        }
        if ($writeFlag) {
            $_SESSION['message'] = '<div class="msg good">Your answers were recorded.</div>';
        } else {
            $_SESSION['message'] = '<div class="msg warn">Your answers were not recorded.</div>';
        }
        header('location: ../accounts?action=accountView');
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
        $message = 'Please go to http://www.293testgenerator.com and use the following test identification code: ' . $testID;
        $sentmail = mail($pilotEmail,$subject,$message,$header);
        if ($sentmail) {
            $message = '<div class="msg good">The test identification code of ' . $testID . ' was sent to the email address provided.';
            include '../views/test-list.php';
        } else {
            $message = '<div class="msg warn">There was an error while sending the e-mail';
            include '../views/test-questions.php';
        }
        break;
    
    case 'testReviewView':  
        $tests = getAllTestsByPilot($_SESSION['accountData']['accID']);
        
        if (count($tests) < 1) {
          $_SESSION['message'] = '<div class="msg warn">There are no tests registered under your account.</div>';
          header ('location:../accounts/?action=accountView');
          exit; 
        }    

        $testlistoutput = "<table><tr><th>Test ID</th><th>Date Submitted</th><th>Evaluator</th><th>&#10004;</th></tr>";
        foreach ($tests as $test) {
            $testurl = './?action=testReviewDetails&testID=' . $test["testID"];
            $testlistoutput .= '<tr>
                                <td>' . $test['testID'] . '</td>
                                <td>' . date('j M Y', strtotime($test['testquestionDateSubmitted'])) . '</td>
                                <td>' . $test['accLastName'] . '</td> 
                                <td><button onclick="location.href=\'' . $testurl . '\'">View Details</button></td>
                                </tr>';
        }
        $testlistoutput .= "</table>";
        $pageTitle = 'Review Tests Taken';
        include '../views/test-taken-list.php';
        break;         

    case 'testReviewDetails':   
        $testID = filter_input(INPUT_POST, 'testID', FILTER_SANITIZE_STRING);
        if ($testID == NULL) {
            $testID = filter_input(INPUT_GET, 'testID', FILTER_SANITIZE_STRING);
        }  
        $answers = getTestTakenDetails($testID);
        $qNum = 1;
        $testdetails = '<table><tr><th>Test ID: ' . $testID . '</th></tr>';
        foreach ($answers as $answer) {
            $testdetails .= '<tr><td class="left">
                            ' . $qNum . '. <strong>' . $answer['qQuestion'] . '
                             </strong>
                             <small> &nbsp;[' . $answer['catName'] . ']</small><br>
                             <span class="answer green">' . $answer['testquestionAnswer'] . '</span>
                             </td></tr>';
            $qNum++;
        }
        $testdetails .= '</table>';
        $pageTitle = 'Test Review';
        include '../views/test-taken-detail.php';
        break;     
            
    case 'manageTestsView':
        // get all tests that have submissions
        $tests = getAllTestsByEvaluator($_SESSION['accountData']['accID']);
        $markup = '<table><tr><th>Test ID</th><th>Date Created</th><th>Questions</th><th>Test Submission</th><th>&#10004;</th></tr>';
        foreach ($tests as $test) {
            $testurl = './?action=testEvaluation&testID=' . $test["testID"];
            $markup .= '<tr>
                            <td>' . $test['testID'] . '</td>
                            <td>' . date('j M Y', strtotime($test['testDateCreated'])) . '</td>
                            <td>' . $test['totalQuestions'] . '</td> 
                            <td>' . $test['accLastName'] . ': ' . date('j M Y', strtotime($test['testquestionDateSubmitted'])) . '</td> 
                            <td><button onclick="location.href=\'' . $testurl . '\'">View</button></td>
                            </tr>';
        }
        $markup .= "</table>";
        // get all tests created
        include '../views/test-list-evaluator.php';
        break;
        
    case 'testEvaluation':   
        $testID = filter_input(INPUT_POST, 'testID', FILTER_SANITIZE_STRING);
        if ($testID == NULL) {
            $testID = filter_input(INPUT_GET, 'testID', FILTER_SANITIZE_STRING);
        }
        $answers = getTestTakenDetails($testID);
        $qNum = 1;
        $markup = '<table>
                   <tr><th>Test ID: ' . $testID . '</th></tr>';
        foreach ($answers as $answer) {
            $markup .= '<tr><td class="left">
                       <hr>' . $qNum . '. <strong>' . $answer['qQuestion'] . '</strong>
                       <small> &nbsp;[' . $answer['catName'] . ']</small><hr>
                       <span class="answer">' . $answer['testquestionAnswer'] . '</span>
                       <p class="info padding">' . $answer['qAnswerKey'] . '</p>
                       </td></tr>
                       <tr><td class="middle">Evalutor Notes:
                         <textarea class="left" name="eval'. $answer['qID'] . '" cols="70" rows="5"></textarea>  
                       </td></tr>';
                $qNum++;
            }
            $markup .= '</table>
                        ';  
            $pageTitle = 'Evaluator Test Review';
            include '../views/test-review.php';
            break;
        
        default:
            header ('location:./');
            break;
}