<?php
session_start();
if(!session_is_registered("email")){
header("location:login.php");
}

 
?>

<?php
// conntects to the database
$link = mysql_connect("localhost", "markchmieleski", "password","test_generator");
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
} 
mysql_select_db('test_generator');
?>
<?php
//sql statement to get evalid from evaluator
$query1 = "SELECT pcode FROM evaluator WHERE email='".$_SESSION['email']."'";
	$result1 = mysql_query($query1, $link);
	$row = mysql_fetch_array($result1);
	
//sql statment to insert into database:
$query = "INSERT INTO testgen (testid, evalid, pilotid) " . 
				"VALUES ('" . $_SESSION['testid'] . "','". $row['pcode']."', '". $_POST['pcode'] . "')";
					
	$result = mysql_query($query, $link)
		or die('Error updating the database: ' . mysql_error());
		for ($i = 1; $i <=$_POST['questnum']; $i++) {
					
			$query2 = "INSERT INTO testsubmit (testid, questionid, answer) " . 
				"VALUES ('" . $_SESSION['testid'] . "', '". $_POST['question' . $i] . "', '" . $_POST['answer' .  $i] . "' )";
				
				$result2 = mysql_query($query2, $link)
			or die('Error on database testsubmit: ' . mysql_error());
				
		}
		
	mysql_close($link);	

?>

<fieldset>
<h3>Thank you for submitting your test</h3>
<?php echo "Your test id number is ". $_SESSION['testid'] . " Please record this for your records to retrieve your test later. " ?>

<?php 
session_destroy();
$_SESSION = array();
?>
</fieldset>
