<?php session_start(); 
if(!session_is_registered("email")){
header("location:login.php");
}
?>
<?php include 'header.php'?>
<div id= "main_content">
	<p>Choose your topic and the number of questions</p>		
 	<form action="questionGen.php" method="post">       
        <select name="topic_1" id="topic_1">
        	<option name="part_61" value="part_61">Part 61</option>
            <option name="part_91" value="part_91">Part 91</option>            
            <option name="gom" value="gom">GOM</option>                  
            <option name="airspace" value="airspace">Airspace</option>
        </select>
        <select name="number_1">
        	<option name="one">1</option>
            <option name="two">2</option>
            <option name="three">3</option>
            <option name="four">4</option>
            <option name="five">5</option>
        </select></br>
         <select name="topic_2" id="topic_2">
        	<option name="part_61" value="part_61">Part 61</option>
            <option name="part_91" value="part_91">Part 91</option>            
            <option name="gom" value="gom">GOM</option>                  
            <option name="airspace" value="airspace">Airspace</option>
        </select>
        <select name="number_2">
        	<option name="one">1</option>
            <option name="two">2</option>
            <option name="three">3</option>
            <option name"four">4</option>
            <option name="five">5</option>
        </select></br>
         
        	<input type="submit" value="Generate Test">
 	</form>        
</div><!--main_content div -->
<?php include 'footer.php' ?>