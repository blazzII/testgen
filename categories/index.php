<?php 
/* Categories Control **************************************************/

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
    case 'viewAllCategories':
        $categories = getAllCategories();

        $markup = '<table>';
        $markup .= '<tr><th>ID</th><th>Category Name</th><th># of Questions</th>';
        foreach ($categories as $category) {
            $numofquestions = getQuestionCountByCategory($category['catID']);
            $markup .= '<tr>
                         <td>' . $category['catID'] . '</td>
                         <td>' . $category['catName'] . '</td>
                         <td>' . $numofquestions . '</td>
                       </tr>';
        }
        $markup .= '</tbody></table>';
        $pageTitle = 'Manage Categories';
        include '../views/category-list.php';
        break;

    case 'viewAddNewCategory':   
        $pageTitle = 'Add New Category';
        include '../views/category-create.php';
        break;

    case 'addCategory':   
        $pageTitle = 'Category Added';
        include '../views/.php';
        break;
    
    default:
      echo "Model Error: Categories";
      break;
}