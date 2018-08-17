<?php 
/* Questions Control **************************************************/

session_start();
require_once '../library/connections.php'; 
require_once '../models/categories.php';
require_once '../models/questions.php';
require_once '../library/functions.php';

//header('Location: /questions/?action=___');
$_SESSION['message'] = null;
// action sanitize and use POST or GET
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {
    case 'viewAllQuestions':
        $options = buildCatList();
        $questions = getAllQuestions();
        $markup = '<table>';
        foreach ($questions as $question) {
            
            ($question['qActive'] === '1') ? $background = 'class="qactive left"' : $background = 'class="qnotactive left"';
            ($question['qActive'] === '1') ? $status = 'Active' : $status = 'Not Active';
            $questionurl = '../questions?action=viewQuestion&qID=' . $question["qID"];

            $markup .= '<tr><td><button onclick="location.href=\'' . $questionurl . '\'">Edit</button></td>';
            $markup .= '<td ' . $background . '>';
            $markup .= 'Question Category: ' . $question['catName'] . '</strong> | ' . $status . '<br>';
            $markup .= '<strong>' . $question['qQuestion'] . '</strong>';
            $markup .= '</td><tr>';
        }
        $markup .= '</tbody></table>';
        $pageTitle = 'Manage Questions';
        include '../views/question-list.php';
        break;

    case 'viewQuestionsByCategory':
        $options = buildCatList();
        $catID = filter_input(INPUT_POST, 'catID', FILTER_SANITIZE_STRING);

        if ($catID == NULL) {
            $catID = filter_input(INPUT_GET, 'catID', FILTER_SANITIZE_STRING);
        }  //header('Location: /testgen/questions/?action=viewAllQuestions');
    
        $questions = getQuestionsByCategory($catID);

        $markup = '<table>';
        foreach ($questions as $question) {
            
            ($question['qActive'] === '1') ? $background = 'class="qactive left"' : $background = 'class="qnotactive left"';
            ($question['qActive'] === '1') ? $status = 'Active' : $status = 'Not Active';
            $questionurl = '../questions?action=viewQuestion&qID=' . $question["qID"];

            $markup .= '<tr><td><button onclick="location.href=\'' . $questionurl . '\'">Edit</button></td>';
            $markup .= '<td ' . $background . '>';
            $markup .= 'Question Category: ' . $question['catName'] . '</strong> | ' . $status . '<br>';
            $markup .= '<strong>' . $question['qQuestion'] . '</strong>';
            $markup .= '</td><tr>';
        }
        $markup .= '</tbody></table>';
        $pageTitle = 'Manage Questions';
        include '../views/question-list.php';
        break;

    case 'viewQuestion':   
        $qID = filter_input(INPUT_POST, 'qID', FILTER_SANITIZE_STRING);
        if ($qID == NULL) {
            $qID = filter_input(INPUT_GET, 'qID', FILTER_SANITIZE_STRING);
        }

        $question = getQuestionByID($qID);

        ($question['qActive'] === '1') ? $background = 'class="qactive left"' : $background = 'class="qnotactive left"';
        ($question['qActive'] === '1') ? $status = 'Active' : $status = 'Not Active';

        $markup = '<table>
                    <tr><th>Category</th><td class="left">' . $question['catName'] . '</td></tr>
                    <tr><th>Question</th><td class="left">' . $question['qQuestion'] . '</td></tr>
                    <tr><th>Answer Key</th><td class="left">' . $question['qAnswerKey'] . '</td></tr>
                    <tr><th>Reference</th><td class="left">' . $question['qReference'] . '</td></tr>
                    <tr><th>Active?</th><td ' . $background . '>' . $status . '</td></tr>
                    <tr><th>Use Count</th><td class="left">' . $question['usetotal'] . '</td></tr>
                    <tr><th>&#10144;</th><td class="left"><a href="./?action=viewEditQuestion&qID=' . $qID . '">Edit Question</a></td></tr>
                    </table>';
        $pageTitle = 'View Question';

        include '../views/question-display.php';
        break;

    case 'viewAddNewQuestion':   
        $pageTitle = 'Add New Question';
        include '../views/question-add.php';
        break;

    case 'addQuestion':   
        $pageTitle = '';
        include '../views/.php';
        break;

    case 'viewEditQuestion':   
        $qID = filter_input(INPUT_POST, 'qID', FILTER_SANITIZE_STRING);
        if ($qID == NULL) {
            $qID = filter_input(INPUT_GET, 'qID', FILTER_SANITIZE_STRING);
        } 
        $question = getQuestionByID($qID);
        $qQuestion = $question['qQuestion'];
        $qAnswerKey = $question['qAnswerKey'];
        $qReference = $question['qReference'];
        $qActive = $question['qActive'];

        $pageTitle = 'Edit Question';
        include '../views/question-update.php';
        break;
    
    
    
    case 'editQuestion':
        // Filter and store the data
        $qID = filter_input(INPUT_POST, 'qID', FILTER_SANITIZE_NUMBER_INT);
        $qQuestion = filter_input(INPUT_POST, 'qQuestion', FILTER_SANITIZE_STRING);
        $qAnswerKey = filter_input(INPUT_POST, 'qAnswerKey', FILTER_SANITIZE_STRING);
        $qReference = filter_input(INPUT_POST, 'qReference', FILTER_SANITIZE_STRING);
        $qActive = filter_input(INPUT_POST, 'qActive', FILTER_SANITIZE_STRING);
        // Change on/off to 1/0 for Active status
        ($qActive === 'on') ? $qActive = 1 : $qActive = 0;
        
        
        // Check for missing data
        if(empty($qQuestion) || empty($qAnswerKey)) {
            $message = '<div class="msg warn">At minimum, there must be question text and answer key text.</div>';
            include '../views/question-update.php';
            exit; 
        }

        // Send the data to the model
        $updateResult = updateQuestion($qID, $qQuestion, $qAnswerKey, $qReference, $qActive);
        
        // check for success
        if($updateResult === 1) {
            $message = '<div class="msg good">The question was successfully updated.</div>';
            $pageTitle = 'Question View';
            header("Location: /testgen/questions/?action=viewQuestion&qID=$qID");
            exit;
        } else {
            $message = '<div class="msg warn">Sorry, the question failed to update.</div>';
            include '../views/question-update.php';
            exit;
        }
        break;

    default:
      echo "Model Error: Questions";
      break;
}