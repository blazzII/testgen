<?php
session_start();
if(!session_is_registered("email")){
header("location:login.php");
}
?>


<?php include 'includes/header.php' ?>
<?php include 'includes/connect.php'?>
<?php



$result_test = mysql_query('SELECT testid FROM testsubmit')
		or die('You did not get the testid' . mysql_error());
while($row_id = mysql_fetch_assoc($result_test)) {
	 htmlspecialchars($row_test['testid'])." ";
}



$questnum = 0;
$questnum ++; 
$answer = $_POST['answer' .$questnum ];	



if($_POST["submit"]="submit")
	{
		for ($i=1; $i <= $_POST['questnum']; $i++) {
			$query = "UPDATE testsubmit SET answer =  '".$_POST['answer' .  $i]."' WHERE testid = 'f554748' AND 
			questionid = '94' ";
			
			$result = mysql_query($query, $link)
		or die('Error updating the database: ' . mysql_error()); 
		print_r($row2);
		}
	mysql_close($link);
	} 
	echo "Your test has been submitted."; 
	

?>
