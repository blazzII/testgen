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

  function recordAnswers($tqID, $tqAnswer, $accID) {
    $db = testgenConnect();
    $sql = 'UPDATE testquestion SET testquestionAnswer = :tqAnswer, testquestionDateSubmitted = NOW(), accID = :accID WHERE testquestionID = :tqID';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':tqID', $tqID, PDO::PARAM_INT);
    $stmt->bindValue(':tqAnswer', $tqAnswer, PDO::PARAM_STR);
    $stmt->bindValue(':accID', $accID, PDO::PARAM_STR);
    $stmt->execute();

    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
 }