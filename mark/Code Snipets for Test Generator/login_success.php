<?php
session_start();
if(!session_is_registered("email")){
header("location:login.php");
}
?>


<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Login Success</title>
</head>

<body>
<h2>You are now logged in!</h2>
</body>
</html>