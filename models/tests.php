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
      $sql = 'SELECT q.qQuestion, tq.testquestionID, c.catName, q.qActive FROM test as t
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

    // get test details for all tests written by an evaluator or administrator  
    function getAllTestsByaccID($accID) {
      $db = testgenConnect();
      $sql = 'SELECT t.testID, COUNT(tq.testquestionID) AS qTotal, t.testDateCreated FROM test as t
                LEFT JOIN testquestion AS tq ON t.testID = tq.testID
                WHERE t.accID = :accID
                GROUP BY t.testID
                ORDER BY t.testDateCreated DESC';
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':accID', $accID, PDO::PARAM_INT);
      $stmt->execute();

      $tests = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
      return $tests;  
    }

    function getTestsTakenCount($accID) {
      $db = testgenConnect();
      $sql = 'SELECT t.testID, tq.accID FROM test AS t
                INNER JOIN testquestion AS tq ON tq.testID = t.testID
                WHERE tq.accID = :accID';
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':accID', $accID, PDO::PARAM_INT);
      $stmt->execute();

      $recordcount = $stmt->rowcount();
      $stmt->closeCursor();
      return $recordcount;  
    }
    
