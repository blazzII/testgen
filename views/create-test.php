<?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/session.php'; ?>
<!doctype html>
<html class="no-js" lang="en-us">
  <head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/head.php'; ?>
  </head>
  <body>
    <div class="flex-container">
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/header.php'; ?>
      <main>
      <h1>Create a New Test</h1>
            <hr>
        <?php if (isset($message)) { echo $message;} ?>
        <form action="/testgen/tests/" method="post">
          <div class="formfields">

            <p>Choose your topic and the number of questions</p>		     
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
         <select name="topic_3">
        	<option>Part 61</option>
            <option>Part 91</option>            
            <option>GOM</option>                  
            <option>Airspace</option>
        </select>
        <select name="number_3">
        	<option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select></ br>
        
            <label for="placeholder"><strong>Placeholder:</strong></label>
            <input type="text" placeholder="placeholder" name="placeholder" id="placeholder" required <?php if(isset($placeholder)){echo "value='$placeholder'";}  ?>>

            <input type="submit" value="Create Test">
            <input type="hidden" name="action" value="createNewTest">
          </div>
        </form>
      </main>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/testgen/shared/footer.php'; ?>
    </div>
  </body>
</html>
