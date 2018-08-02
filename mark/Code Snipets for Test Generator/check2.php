<?php
session_start();

$link = mysql_connect("localhost", "mark_chmieleski", "password","ride_questions");
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
} 

if (isset ($_POST['Login'])) {
	//Get the values
	$username = $_POST['username'];
	$password = $_POST['password'];
	//validate the values
	$sql="SELECT * FROM users WHERE username='$username' and password='$password'";
	$result=mysql_query($sql);
	// Mysql_num_row is counting table row
	$count=mysql_num_rows($result);
	if($count==1){
		$_SESSION['username'] = $username;
		header("Location: testGen.php");	
	}
	else {
		echo "Wrong Username or Password";
	}
	
	//login and set session
}
?>