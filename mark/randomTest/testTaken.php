<?php
session_start();
if(!session_is_registered("email")){
	header("location:login.php");		
}
?>

<?php include 'includes/connect.php'?>
<?php include 'includes/header.php'?>

<div id="container5">

<h2>Choose how you would like to look up an exam.</h2>
<form method="post" action="retrieve.php">

<?php $result= mysql_query('SELECT testid FROM testgen'); ?> 
    	 
         <label>Test Code:</label>         
        <select name="testcode">
        <option value=""></option>
        <?php while($row= mysql_fetch_array($result)) { ?>  
        	<option value="<?php echo $row['testid'] ?>"><?php echo $row['testid'] ?></option>                            
    <?php } ?> 
    </select>  
<input type="submit" name="submit" value="GO">

</form>

<form method="post" action="retrieve.php">

<?php $result1 = mysql_query('SELECT DISTINCT pilotid FROM testgen'); ?>
    	 
         <label>Pilot Code:</label>         
        <select name="pilotcode">
        <option value=""></option>
        <?php while($row2= mysql_fetch_array($result1)) { ?>  
        	<option value="<?php echo $row2['pilotid'] ?>"><?php echo $row2['pilotid'] ?></option>                            
    <?php } ?> 
    </select>  
<input type="submit" name="submit" value="GO">

</form>

<form method="post" action="retrieve_3.php">
<?php $result2 = mysql_query('SELECT DISTINCT evalid FROM testgen'); ?>
         <label>Evaluator:</label>         
        <select name="evalid">
        <option value=""></option>
        <?php while($row3= mysql_fetch_array($result2)) { ?>
        	<option value="<?php echo $row3['evalid'] ?>"><?php echo $row3['evalid'] ?></option>                            
    <?php } ?> 
    </select>  
<input type="submit" name="submit" value="GO">

</form>


 <div id="submit1">
    <a class="test2a" href="taskSelect.php">Return to Select Task.</a>
    <a class="test2a" href="logout.php">Logout</a>
    </div>
</div><!-- end div for container5 -->

<?php include 'includes/footer.php' ?>