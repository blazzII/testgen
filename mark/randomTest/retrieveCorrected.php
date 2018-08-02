<?php
session_start();
if(!session_is_registered("email")){
	header("location:login.php");		
}
?>

<?php include 'includes/connect.php'?>
<?php include 'includes/header.php'?>

<form action="correctedTest.php" method="post">

<?php $result= mysql_query('SELECT testid FROM testgen'); ?> 
    	 
         <label>Test Code:</label>         
        <select name="testcode">
        <option value=""></option>
        <?php while($row= mysql_fetch_array($result)) { ?>  
        	<option value="<?php echo $row['testid'] ?>"><?php echo $row['testid'] ?></option>                            
    <?php } ?> 
    </select>  
<input type="submit" name="submit" value="Select">

</form>