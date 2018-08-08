<?php 
  /* Test Model - handling test content db  ************************/

    function addNewTest($testID, $accID){
        $db = testgenConnect();
        $sql = 'INSERT INTO test (testID, accID)
                  VALUES (:testID, :accID)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':testID', $testID, PDO::PARAM_STR);
        $stmt->bindValue(':accID', $accID, PDO::PARAM_STR);
        $stmt->execute();

        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }
    
