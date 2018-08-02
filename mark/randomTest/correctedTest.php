<?php
session_start();
if(!session_is_registered("email")){
	header("location:login.php");		
}
?>

<?php include 'includes/connect.php'?>
<?php include 'includes/header.php'?>
<!-- Variables to retrieve a test that has been corrected -->
<?php
$testcode = ($_POST['testcode']);
$questnum1 = 1;
?>

<?php
// This will get what I need from the datatbase
if (isset($_POST['testcode'])) {
	$query = "SELECT testsubmit.id, testsubmit.testid, testsubmit.questionid, testsubmit.corrected, questions.question, testsubmit.answer, testsubmit.date FROM testsubmit  INNER JOIN questions ON testsubmit.questionid=questions.questionid WHERE testsubmit.testid='" .$testcode."'"; 
	
	$query2 = "SELECT answer, reference FROM questions";
	
}

$result = mysql_query($query, $link)
		or die('You messed something up there are no results given' . mysql_error());
		
$result2 = mysql_query($query2, $link)
		or die('You messed something up there are no results given' . mysql_error());
		
// This displays the questions, answers annd if wrong will display the correct answer and reference
		
	echo '<table style="width:400px">';
	echo '<tr><th align=\"center\">No.</th><th align=\"center\">Question</th><th align=\"center\">Answer</th>';
	
	while($row = mysql_fetch_array($result)) {
		
	echo "<tr><td>" . $questnum1 ++ . "</td><td>"  . $row['question'] . "</td><td>" . $row['answer'] . "</td></tr>";?>
<?php
	if ($row['corrected'] = 1) {
		echo "<tr><td>" . $
		
	}
	 
	}
	echo "</table>";


?>