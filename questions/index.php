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

            $markup .= '<tr>
                        <td><button onclick="location.href=\'' . $questionurl . '\'">View</button></td>
                        <td ' . $background . '><strong>' . $question['qQuestion'] . '</strong><br><small>Category: ' . $question['catName'] . ' → ' . $status . '</small></td>
                        </tr>';
        }
        $markup .= '</tbody></table>';
        $pageTitle = 'Manage Questions';
        include '../views/question-list.php';
        break;

    case 'viewQuestionsByCategory':
        $firstFlag = TRUE;
        $options = buildCatList();
        if (isset($_POST['submit'])) {    
            $catID = filter_input(INPUT_POST, 'catID', FILTER_SANITIZE_STRING);
            if ($catID == NULL) {
                $catID = filter_input(INPUT_GET, 'catID', FILTER_SANITIZE_STRING);
            }

            $questions = getQuestionsByCategory($catID);
            if (count($questions) == 0 ) {
                $message = '<div class="msg warn">There were no questions found in this category.</div>';
                $markup = '';
                $pageTitle = 'Manage Questions';
                include '../views/question-list.php';
                break;
            }
            $markup = '<table><tr><th colspan="2">Category: '. $questions[0]['catName'] .'</th></tr>';
            foreach ($questions as $question) {
                ($question['qActive'] === '1') ? $background = 'class="qactive left"' : $background = 'class="qnotactive left"';
                ($question['qActive'] === '1') ? $status = 'Active' : $status = 'Not Active';
                $questionurl = '../questions?action=viewQuestion&qID=' . $question["qID"];

                $markup .= '<tr>
                        <td><button onclick="location.href=\'' . $questionurl . '\'">View</button></td>
                        <td ' . $background . '><strong>' . $question['qQuestion'] . '</strong><br><small>' . $status . ': ' . $question['catName'] . '</small></td>
                        </tr>';
            }
            $markup .= '</table>';
            $firstFlag = FALSE;
        } else {
            $markup = '<div class="msg good">Select a question category.</div>';
        }
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
        // build category select control
        $categoryList = '<select name="catID" required>
                           <option value ="" disabled selected>Select Category ...</option>';
        $categoryList .= buildCatList();
        $categoryList .= '</select>';
        include '../views/question-create.php';
        break;

    case 'addQuestion':   
        $catID = filter_input(INPUT_POST, 'catID', FILTER_SANITIZE_NUMBER_INT);    
        $qQuestion = filter_input(INPUT_POST, 'qQuestion', FILTER_SANITIZE_STRING);
        $qAnswerKey = filter_input(INPUT_POST, 'qAnswerKey', FILTER_SANITIZE_STRING);
        $qReference = filter_input(INPUT_POST, 'qReference', FILTER_SANITIZE_STRING);
        $qActive = filter_input(INPUT_POST, 'qActive', FILTER_SANITIZE_STRING);

        if(empty($catID) || empty($qQuestion) || empty($qAnswerKey)){
            $message = '<div class="msg warn">Please provide information for all empty form fields.</div>';
            include '../views/question-create.php';
            exit; 
        }

        ($qActive == "on")?$qActive='1':$qActive='0';
             
        $qID = addQuestion($catID, $qQuestion, $qAnswerKey, $qReference, $qActive);
        
        // check for success
        if(isset($qID) && !empty($qID)) {
            $_SESSION['message'] = '<div class="msg good">The question was successfully added.</div>';
            header("Location: ./?action=viewQuestion&qID=$qID");
            exit;
        } else {
            $message = '<div class="msg warn">Sorry, the question failed to be added.</div>';
            include '../views/question-create.php';
            exit;
        }  
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
        $catID = $question['catID'];

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
            header("Location: ./?action=viewQuestion&qID=$qID");
            exit;
        } else {
            $message = '<div class="msg warn">Sorry, the question failed to update.</div>';
            include '../views/question-update.php';
            exit;
        }
        break;
    
    case 'questionSummary':
        $questionTotal = 0;
        $questionTotalUse = 0;
        $categories = getAllCategories();
        $markup = '<table>';
        $markup .= '<tr><th>Category Name</th><th># Questions</th><th>Use in Tests</th>';
        foreach ($categories as $category) {
            $numofquestions = getQuestionCountByCategory($category['catID']);
            $questionusecount = getQuestionUseCountByCategory($category['catID']);
            $questionTotal += $numofquestions;
            $questionTotalUse += $questionusecount;
            $markup .= '<tr>
                         <td>' . $category['catName'] . '</td>
                         <td>' . $numofquestions . '</td>
                         <td>' . $questionusecount . '</td>
                       </tr>';
        }

        $markup .= '</tbody>
                    <tfoot>
                     <tr>
                      <th>Totals</th>
                      <th>' . $questionTotal . '</th>
                      <th>' . $questionTotalUse . '</th>
                     </tr>
                    </tfoot>
                   </table>';
        $pageTitle = 'Question Use Summary';
        include '../views/question-summary.php';
        exit;

    default:
      $_SESSION['message'] = '<div class="msg warn">There was an error in the application navigation through questions.</div>';
      header ('location: ../accounts/?action=accountView');
      break;
}