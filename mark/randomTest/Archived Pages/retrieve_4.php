<?php
session_start();
if(!session_is_registered("email")){
header("location:login.php");
}
?>


<?php include 'includes/header.php' ?>
<?php
// conntects to the database
$link = mysql_connect("localhost", "markchmieleski", "password","test_generator");
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
} 

mysql_select_db('test_generator');

?>
<!-- Variables to seach for selected test -->
<?php
$testid = ($_GET['id']);

?>

<?php 


$query= "SELECT testsubmit.testid, testsubmit.questionid, questions.question, testsubmit.answer, testsubmit.date FROM testsubmit  INNER JOIN questions ON testsubmit.questionid=questions.questionid WHERE testsubmit.testid='" .$testid. "'";  

$query2 = "SELECT pilotid, evalid FROM testgen WHERE testid='" .$testid."'";
 
	


$result = mysql_query($query, $link)
		or die('You messed something up there are no results given' . mysql_error());

$result2 = mysql_query($query2, $link)
		or die('You messed something up there are no results given' . mysql_error());

				
		$row1 = mysql_fetch_array($result);
		$row2 = mysql_fetch_array($result2);
		echo "Test ID: $testid" . "<br />";
		echo "Test Taken on:" . $row1['date'] . "<br />";
		echo "Taken by:" . $row2['pilotid'] . "<br />";
	$questnum1 = 1;	
	
	echo '<table style="width:400px">';
	echo "<tr><th align=\"center\">No.</th><th align=\"center\">Question</th><th align=\"center\">Answer</th></tr>";
	
	while($row = mysql_fetch_array($result)) {
		
	echo "<tr><td>" . $questnum1 ++ . "</td><td>"  . $row['question'] . "</td><td>" . $row['answer'] . "</td></tr>";
	
	 
	}
	echo "</table>";
?> 
