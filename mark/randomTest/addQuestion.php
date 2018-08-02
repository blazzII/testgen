 <?php
session_start();
if(!session_is_registered("email")){
header("location:login.php");
} 
?>
<?php include 'includes/connect.php'?>
<?php
//Variables
$catid = $_POST['catid'];
$question = $_POST['question'];
$answer = $_POST['answer'];

?>

<?php include 'includes/header.php' ?>
<div id="container3">
<fieldset class="update">
	<legend>Update Database</legend>
        <form action="<?php echo $PHP_SELF;?>" method="post">
        
        <label for="catid">Select Topic</label>
        <select class="update2" id="catid" name="catid">
            <option name="0" value="">-</option>
            <option name="1" value="1">GOM</option>
            <option name="2" value="2">Part 61</option>
            <option name="3" value="3">Part 91</option>
            <option name="4" value="4">Part 135</option>
            <option name="5" value="5">NVG</option>
            <option name="6" value="6">Airspace</option>
            <option name="7" value="6">NTSB 830</option>        
            </select><br>
        <label class="update1" for="question">Quesiton:</label>
        <textarea class="update2"id="quesiton" name="question"></textarea>
        <br>
        <label class="update1" for="answer">Answer:</label>
        <textarea class="update2" id="answer" name="answer"></textarea>
        <br>
 			<input type="submit" name="submit" class="test2" value="Add" />
       
		</form>
</fieldset>
<?php 
if(isset($_POST['submit'])) {
	//sql statment to insert into database:
$query = "INSERT INTO questions (catid, question, answer) " . 
				"VALUES ('$catid','$question', '$answer')";
	
	$result = mysql_query($query, $link)
		or die('Error updating the database: ' . mysql_error());
		
	mysql_close($link);
	echo 'Thanks for submitting the question!';
}
	?>
    <br>
    <div id="submit1">
    <a class="test2a" href="taskSelect.php">Return to Select Task.</a>
    <a class="test2a" href="logout.php">Logout</a>
    </div>
</div><!-- container3 -->

<?php include 'includes/footer.php' ?>