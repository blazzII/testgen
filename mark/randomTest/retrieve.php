<?php
session_start();
if(!session_is_registered("email")){
header("location:login.php");
}
?>


<?php include 'includes/header.php' ?>
<?php include 'includes/connect.php'?>
<!-- Variables to search for selected test -->
<?php
$testcode = ($_POST['testcode']);
$pilotcode = ($_POST['pilotcode']);
$testid = ($_GET['id']);
?>
<form action="corrected.php" method="post">
<?php 

if (isset($_POST['testcode'])) {

$query= "SELECT testsubmit.id, testsubmit.testid, testsubmit.questionid, questions.question, testsubmit.answer, testsubmit.date FROM testsubmit  INNER JOIN questions ON testsubmit.questionid=questions.questionid WHERE testsubmit.testid='" .$testcode."'"; 

$query2 = "SELECT pilotid, evalid FROM testgen WHERE testid='" .$testcode."'";
}

elseif (isset($_POST['pilotcode'])) {
	$query= "SELECT testsubmit.questionid, questions.question, testsubmit.answer, testgen.pilotid, testgen.testid, testsubmit.date FROM testsubmit INNER JOIN questions ON testsubmit.questionid=questions.questionid 
INNER JOIN testgen ON testsubmit.testid=testgen.testid 
WHERE testgen.pilotid='" .$pilotcode."'"; 

	$query2 = "SELECT testid FROM testgen WHERE pilotid='" .$pilotcode."'";

	
}


else {
	
	$query= "SELECT testsubmit.testid, testsubmit.questionid, questions.question, testsubmit.answer, testsubmit.date FROM testsubmit  INNER JOIN questions ON testsubmit.questionid=questions.questionid WHERE testsubmit.testid='" .$testid. "'"; 
	
	$query2 = "SELECT pilotid, evalid FROM testgen WHERE testid='" .$testid."'"; 
	
}


$result = mysql_query($query, $link)
		or die('You messed something up there are no results given' . mysql_error());

$result2 = mysql_query($query2, $link)
		or die('You messed something up there are no results given2' . mysql_error());
				
		$row1 = mysql_fetch_array($result);
		$row2 = mysql_fetch_array($result2);
		if (isset($_POST['testcode'])) {
			echo "Test ID: $testcode" . "<br />";			
		}
		else {
		echo "Test ID:" . $row1['testid'] ."<br />";
		}
		echo "Test Taken on: " . $row1['date'] . "<br />";
		echo "Taken by:" . $row2['pilotid'] . $pilotcode . "<br />";
	   $questnum1 = 1;	
	
	echo '<table style="width:400px">';
	echo '<tr><th align=\"center\">No.</th><th align=\"center\">Question</th><th align=\"center\">Answer</th><th align=\"ceter\">Incorrect</th></tr>';
	
	while($row = mysql_fetch_array($result)) {
		
	echo "<tr><td>" . $questnum1 ++ . "</td><td>"  . $row['question'] . "</td><td>" . $row['answer'] . "</td><td><input type='checkbox' name='chk[]' value=".$row['id'].">Incorrect</input></td></tr>";?>
<?php	
	 
	}
	echo "</table>";
?> 

<input type="submit" name="submit" value="Corrected">
</form>


<div id="submit1">
    <a class="test2a" href="taskSelect.php">Return to Select Task.</a>
    <a class="test2a" href="logout.php">Logout</a>
    </div>
