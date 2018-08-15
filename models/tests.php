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

    function getTestBytestID($testID) {
      $db = testgenConnect();
      $sql = 'SELECT q.qQuestion, tq.testquestionID, c.catName FROM test as t
               INNER JOIN testQuestion as tq ON tq.testID = t.testID
               INNER JOIN question as q ON q.qID = tq.questionID
               INNER JOIN category as c ON c.catID = q.catID
               WHERE t.testID = :testID';

      $stmt = $db->prepare($sql);
      $stmt->bindValue(':testID', $testID, PDO::PARAM_STR);
      $stmt->execute();

      $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
      return $questions;  
    }

    function getAllTestsByaccID($accID) {
      $db = testgenConnect();
      $accID = "test";
      $sql = 'SELECT t.testID, COUNT(*) as qTotal, t.testDateCreated, COUNT(*) as submissionCount FROM test as t
               INNER JOIN testQuestion as tq ON tq.testID = t.testID
               WHERE t.accID = :accID';

      $stmt = $db->prepare($sql);
      $stmt->bindValue(':accID', $accID, PDO::PARAM_INT);
      $stmt->execute();

      $tests = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
      return $tests;  
    }
    
