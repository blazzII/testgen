<?php 
/* Tests Control **************************************************/

session_start();
require_once '../library/connections.php'; 
require_once '../models/categories.php';
require_once '../models/questions.php';
require_once '../library/functions.php';

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
        include '../views/questions-view-all.php';
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
        include '../views/questions-view-all.php';
        break;

    case 'viewQuestion':   
        $qID = filter_input(INPUT_POST, 'qID', FILTER_SANITIZE_STRING);
        if ($qID == NULL) {
            $qID = filter_input(INPUT_GET, 'qID', FILTER_SANITIZE_STRING);
        }

        $question = getQuestionByID($qID);

        ($question['qActive'] === 1) ? $background = 'class="qactive left"' : $background = 'class="qnotactive left"';
        ($question['qActive'] === 1) ? $status = 'Active' : $status = 'Not Active';

        $markup = '<table><thead>';
        $markup .= '<tr><th>Category</th><td>' . $question['catName'] . '</td></tr>';
        $markup .= '<tr><th>Question</th><td class="left">' . $question['qQuestion'] . '</td></tr>';
        $markup .= '<tr><th>Active?</th><td ' . $background . '>' . $status . '</td></tr>';
        $markup .= '<tr><th>Answer Key</th><td class="left">' . $question['qAnswerKey'] . '</td></tr>';
        $markup .= '<tr><th>Reference</th><td class="left">' . $question['qReference'] . '</td></tr>';
        $markup .= '<tr><th>Use Count</th><td></td></tr>';
        $markup .= '<tr><th>Edit</th><td class="left"><a href="../questions/?action=viewEditQuestion&qID=' . $qID . '">Update Question</a></td></tr>';
        $markup .= '</tbody></table>';
        $pageTitle = 'View Question';
        include '../views/question.php';
        break;

    case 'viewAddNewQuestion':   

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
        include '../views/edit-question.php';
        break;
    
    
    
    case 'editQuestion':
        

        break;
    
    default:
      echo "Model Error: Questions";
      break;
}