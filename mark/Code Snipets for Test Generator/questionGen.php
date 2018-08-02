<?php include 'header.php' ?>


<h1>Here are your test questions</h1>
<h3>Good Luck!</h3>
<?php
//variables
$topic_1 = $_POST['topic_1'];
$topic_2 = $_POST['topic_2'];
$numberQuest = $_POST['number_1'];
$numberQuest2 = $_POST['number_2'];


// Connects to database
$link = mysql_connect("localhost", "mark_chmieleski", "password","ride_questions");
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
} 



   mysql_select_db('ride_questions'); 

	$query = "SELECT * FROM ".$topic_1." ORDER BY RAND() LIMIT ".$numberQuest."";
	$querys = "SELECT * FROM ".$topic_2." ORDER BY RAND() LIMIT ".$numberQuest2."";
	
	$result = mysql_query($query, $link)
		or die('You messed something up there are no results given' . mysql_error()); 
	$results = mysql_query($querys, $link)
		or die('You messed something no. 2 up there are no results given' . mysql_error()); 
		
	while($row = mysql_fetch_array($result))
  {
  echo $row['questId'];
  echo " " . $row['question'];
  echo "<br>";
  } 
  
  	while($row = mysql_fetch_array($results))
  {
  echo $row['questId'];
  echo " " . $row['question'];
  echo "<br>";
  }

	mysql_close($link);

?>

<?php include 'footer.php' ?>