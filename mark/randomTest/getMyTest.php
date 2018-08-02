<?php
session_start();
if(!session_is_registered("email")){
header("location:login.php");
}
?>


<?php include 'includes/header.php' ?>
<?php include 'includes/connect.php'?>
<?php $testcode = ($_POST['testcode']); 
$_SESSION["testcode"]= $testcode;
$questnum = 0;
?>

<form action="updateTest.php" method="post">
<?php
if (isset($_POST['testcode'])) {

$query= "SELECT testsubmit.id, testsubmit.testid, testsubmit.questionid, questions.question, testsubmit.date FROM testsubmit  INNER JOIN questions ON testsubmit.questionid=questions.questionid WHERE testsubmit.testid='" .$testcode."'"; 
}

$result = mysql_query($query, $link)
		or die('You messed something up there are no results given' . mysql_error()); 
		
		while($row2 = mysql_fetch_array($result)) {
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

?>
	<input type="hidden" name="questnum" value="<?php echo $questnum ?>">
	<div id="submit">
        <input type="submit" name="submit" value="Submit Test">
        </div>
</form>
