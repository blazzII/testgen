<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>question.php</title>
</head>

<body>
<?php
$table_name = $_POST['table'];
$question = $_POST['question'];
$answer = $_POST['answer'];

// Connects to database
$link = mysql_connect("localhost", "mark_chmieleski", "password","ride_questions");
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
} 
echo 'Connected successfully <br />';


   mysql_select_db('ride_questions'); 
//This is where I am going to write my function.
//table_select($table_name);
			
	
	$query = "INSERT INTO ".$table_name." (question, answer) " . 
				"VALUES ('$question', '$answer')";
	
	$result = mysql_query($query, $link)
		or die('Error updating the database: ' . mysql_error());
		
	mysql_close($link);

echo 'Thanks for submitting the question!';
?>
</body>
</html>