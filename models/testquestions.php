<?php 
  /* Test Question Submissions) Model ************************/

 function addNewTestQuestion($testID, $questionID) {
  $db = testgenConnect();
  $sql = 'INSERT INTO testquestion (testID, questionID)
            VALUES (:testID, :questionID)';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':testID', $testID, PDO::PARAM_STR);
  $stmt->bindValue(':questionID', $questionID, PDO::PARAM_INT);
  $stmt->execute();

  $rowsChanged = $stmt->rowCount();
  $stmt->closeCursor();
  return $rowsChanged;
 }