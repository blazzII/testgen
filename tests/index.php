<?php 
/* ∆ Tests Control ********************************/

session_start();
require_once '../library/connections.php'; 
require_once '../models/tests.php';
require_once '../models/categories.php';
require_once '../models/questions.php';
require_once '../models/testquestions.php';
require_once '../library/functions.php';

// ACTION method sanitize and use POST or GET
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {
    
    case 'createTestView':
        $pageTitle = 'Test Generator • Create a New Test';
        $formItems = buildFormItemCategories();
        include '../views/create-test.php';
        break;

    //testing case
    case 'createTest':   
        $createTest = 0;
        $questions = "";
        foreach($_POST as $index => $value) {
            if (strlen($index) < 2 ) {
                echo 'Index: ' . $index . '   Value: ' . $value . '<br>';
                if ($value > 0) {
                    $questions = getRandomQuestions($index, $value);
                    $createTest = 1;         
                }
            }
        }
        
        if ($createTest === 1) {
            $testID = buildRandomTestID();
            $_SESSION['accID'] = 'test'; // TEMP VARIABLE FOR TESTING ONLY
            $result = addNewTest($testID, $_SESSION['accID']);
            if ($result === 1) {
                // LOOP - add records to testQuestion includes questionID, testID
                foreach($questions as $questionID) {
                    $testquestion = addNewTestQuestion($testID, implode($questionID));
                }
                // show success to user ... send to summary page account-menu.php
                if($testquestion === 1) {
                    // create question records to testdetail
                    $message = '<div class="msg good">Success</div>';
                    header('Location: /testgen/');
                    exit;
                } else {
                    $message = '<div class="msg warn">Something went wrong when creating a new test.</div>';
                    include '../views/main-menu.php';
                    exit;
                }
            }
        }
        break;
    
    
    default:
      echo "Test model error .. check action path";
      break;
}