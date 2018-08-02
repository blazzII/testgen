<?php include $_SERVER['DOCUMENT_ROOT'] . '/common/session.php'; ?>
<?php 
if(!empty($_SESSION)) {
    if(!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel']==1) {
        header('Location: /');
        exit;
    }
} else {
    header('Location: /');
    exit;    
}
?><!DOCTYPE html>
<html class="no-js" lang="">
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/head.php'; ?>
    </head>
    <body>
        <div class="flex-container">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/header.php'; ?>
            
            <div class="main_child">
                <main>
<?php 
    if (isset($message)) {
    echo $message;
    }
?>
                    <form action="/products/index.php" method="post" id="addCatForm">
                        <div class="container">
                            <h1>Add Category</h1>
                            <p>Please fill in this form to create a new category. All fields are required.</p>
                            <hr>

                            <label for="categoryName"><b>Category Name:</b></label>
                            <input type="text" placeholder="Enter Category Name" name="categoryName" id="categoryName" required <?php if(isset($categoryName)){echo "value='$categoryName'";}  ?>>

                            <div class="clearfix">
                            <button type="submit" class="signupbtn" form="addCatForm" value="Submit">Submit</button>
                            <!-- Add the action name - value pair -->
                            <input type="hidden" name="action" value="submitNewCategory">
                            </div>
                        </div>
                    </form>
                </main>
            </div>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/common/footer.php'; ?>
        </div>
    </body>
</html>
