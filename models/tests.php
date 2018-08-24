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
    function getAllTestsByEvaluator($accID) {
      $db = testgenConnect();
      $sql = 'SELECT DISTINCT t.testID, COUNT(tq.testquestionID) AS totalQuestions, t.testDateCreated, tq.testquestionDateSubmitted, a.accLastName FROM test as t
                INNER JOIN testquestion AS tq ON t.testID = tq.testID
                INNER JOIN account AS a ON a.accID = tq.accID
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

    function getAllTestsCreated($accID) {
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

    // get the number of tests taken by a pilot account
    function getAllTestsByPilot($accID) {
      $db = testgenConnect();
      $sql = 'SELECT t.testID, a.accLastName, tq.testquestionDateSubmitted FROM test AS t
                INNER JOIN account AS a ON a.accID = t.accID
                INNER JOIN testquestion AS tq ON tq.testID = t.testID
                WHERE tq.accID = :accID
                GROUP BY tq.testID';
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':accID', $accID, PDO::PARAM_INT);
      $stmt->execute();

      $tests = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
      return $tests;  
    }

    // get the number of tests taken by a pilot account
    function getTestsTakenCount($accID) {
      $db = testgenConnect();
      $sql = 'SELECT t.testID, tq.accID FROM test AS t
                INNER JOIN testquestion AS tq ON tq.testID = t.testID
                WHERE tq.accID = :accID
                GROUP BY tq.testID';
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':accID', $accID, PDO::PARAM_INT);
      $stmt->execute();

      $recordcount = $stmt->rowcount();
      $stmt->closeCursor();
      return $recordcount;  
    }

    function getTestTakenDetails($testID) {
      $db = testgenConnect();
      $sql = 'SELECT tq.testquestionAnswer, q.qID, q.qQuestion, q.qAnswerKey, c.catName FROM testquestion AS tq
                INNER JOIN question AS q ON q.qID = tq.questionID
                INNER JOIN category AS c ON c.catID = q.catID
                WHERE tq.testID = :testID';
      $stmt = $db->prepare($sql);
      $stmt->bindValue(':testID', $testID, PDO::PARAM_INT);
      $stmt->execute();

      $answers = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $stmt->closeCursor();
      return $answers;        
    }
    
