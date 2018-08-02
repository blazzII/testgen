<?php
session_start();
if(!session_is_registered("email")){
header("location:login.php");
}
?>
<?php include 'includes/header.php' ?>
<?php include 'includes/connect.php'?>
<div id="wrapper">
<div id="container3">
<form action="testResults.php" method="post">
<fieldset class="populate">
	<legend>Test Information</legend>        
            <label for="fname">First Name:</label>
            <input type="text" name="fname">
            <label for="lname">Last Name:</label>
            <input type="text" name="lname">
            <label for="pcode">Pilot Code:</label>
            <input type="text" name="pcode" size="5">

<p class="fieldp">From the topics below, choose the number of questions you would like from each topic and then select Generate Test to produce a test.</p>      	
<!-- The code below selects the categories to choose from -->

    <?php $result= mysql_query('SELECT * FROM categories'); ?> 
    <?php while($row= mysql_fetch_assoc($result)) { ?> 
        <?php echo htmlspecialchars($row['name']) ?>:
        <select class="title2" name="<?php echo $row['catid'] ?>">
        	<option value="0">-</option>
        	<option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select><br>                        
    <?php } ?> 
    
    <div id="submit">
        <input class="test1" type="submit" value="Generate Test">
        </div>
        </fieldset>
</form>

<a href="logout.php">Logout</a>



</div><!-- main_content -->
<?php include 'includes/footer.php' ?>