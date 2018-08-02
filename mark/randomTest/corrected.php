<?php
session_start();
if(!session_is_registered("email")){
header("location:login.php");
}
?>
<?php include 'includes/header.php' ?>
<?php include 'includes/connect.php'?>

<?php
// The purpose of the below code is to get the question id
$result_id = mysql_query('SELECT id FROM testsubmit')
		or die('You did not get the id' . mysql_error());
while($row_id = mysql_fetch_assoc($result_id)) {
	 htmlspecialchars($row_id['id'])." ";
}

//end of code to get the question id	
$corrected = $_POST['chk'];

if($_POST["submit"]="submit")
	{
		for ($i=0; $i<sizeof($corrected); $i++) {
			$query = "UPDATE testsubmit SET corrected = 1 WHERE id = ".$corrected[$i];
			
			$result = mysql_query($query, $link)
		or die('Error updating the database: ' . mysql_error());
		}
	mysql_close($link);
	echo 'The test has been corrected';
	
			
		
		
	}
?>
<div id="submit1">
    <a class="test2a" href="taskSelect.php">Return to Select Task.</a>
    <a class="test2a" href="logout.php">Logout</a>
    </div>
