<?php
ob_start();
// Connects to database
include 'includes/connect.php';
// Variables from login page
$username = $_POST['email'];
$password = $_POST['password'];
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password); 
$sql="SELECT * FROM evaluator WHERE email ='$username' and password ='$password'";
$result=mysql_query($sql);
// Mysql_num_row is counting table row
$count = mysql_num_rows($result);
// If result matched $username and $password, table row must be 1 row
if($count==1){
// Register $username, $password and redirect to file "testGen.php"
session_register("email");
session_register("password"); 
header("location:taskSelect.php");
}
else {
echo "Wrong Username or Password";
}
$_SESSION['email'] = "$username";
ob_end_flush();
?>