<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Query the database</title>
</head>

<body>
<h2>This will query the database to randomly extract two questions from my database.</h2>
<p>Good luck with that</p>
<?php
$link = mysql_connect("localhost", "mark_chmieleski", "password","ride_questions");
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
} 
echo 'Connected successfully <br />';

   mysql_select_db('ride_questions'); 
   
   $query = "SELECT * FROM part_61 ORDER BY RAND() LIMIT 3";
   
   $result = mysql_query($query, $link)
		or die('You messed something up there are on results given' . mysql_error());
	
	
	
	while($row = mysql_fetch_array($result))
  {
  echo $row['questId'];
  echo " " . $row['question'];
  echo "<br>";
  }
  
  
mysql_close($link);

?>


</body>
</html>