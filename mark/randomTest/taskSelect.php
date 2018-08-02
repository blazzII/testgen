<?php
session_start();
if(!session_is_registered("email")){
header("location:login.php");
}
$_SESSION["email"];
?>

<?php include 'includes/header.php' ?>
<div id="container2">
<h2 class="h2task">Select a task below</h2>

<a href="populate.php"><button class="task3">Generate Test</button></a>
<a href="addQuestion.php">
   <button class="task3">Add Question</button>
</a>
<a href="testTaken.php">
  <button class="task3">View Test Taken</button>
</a>

<a href="logout.php">
	<button class="task3">Logout</button>
</a>
</div><!-- Main Content -->
<?php include 'includes/footer.php' ?>