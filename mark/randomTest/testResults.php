<?php
session_start();
if(!session_is_registered("email")){
	header("location:login.php");		
}
?>




<form action="submitedTest.php" method="post">

<?php include 'includes/header.php'?>		
<?php include 'includes/connect.php'?>

<div id="main_content">
<!-- The below code randomly generates the 7 alphanumberic test number -->
<?php include 'includes/functions.php';
	echo "Test Number: $testid"; "<br>";

$_SESSION["testid"]= $testid;
	
?>
</br>
<?php
$f_name = ($_POST['fname']);
$l_name = ($_POST['lname']);
$p_code = ($_POST['pcode']);

echo "<p>Welome $f_name $l_name, Below are your test questions. Please type your answers in the box provided. </p>"; 
"<br>";
?>
</br>
<?php

$query="SELECT * FROM categories";
$result = mysql_query($query, $link)
		or die('You messed something up there are no results given' . mysql_error()); 
$questnum = 0;
	
while($row = mysql_fetch_array($result))
  {
 $numquest = $_POST[$row['catid']];
 $query2 ="SELECT * FROM questions WHERE catid = ".$row['catid']." ORDER BY RAND() LIMIT ".$numquest."";
 $result2 = mysql_query($query2, $link) 
		or die('You messed something up again? there are no results given' . mysql_error());
		
while($row2 = mysql_fetch_array($result2)) {
	 $questnum ++;
	 ?>
     <div class="shade">
     <?php
	 echo $questnum . ".";
	 echo " "  ;		
	 //echo $row2['id'];
	 echo " " . $row2['question'];
	 echo "<br>"; ?> 
     <input type="hidden" name="<?php echo 'question' . $questnum ?>" value="<?php echo $row2['questionId']?>">
	 <textarea name="<?php echo 'answer' . $questnum ?>" rows="3" cols="100" placeholder="Type your answer here."></textarea>
      </div>
	  <?php
	  echo "<br>";
  } 
  }

?>
<input type="hidden" name="pcode" value="<?php echo $p_code ?>"> 
<input type="hidden" name="questnum" value="<?php echo $questnum ?>">
<div id="submit">
        <input type="submit" name="submit" value="Submit Test">
        </div>
</form>

</div><!-- main_content -->

<?php include 'includes/footer.php' ?>