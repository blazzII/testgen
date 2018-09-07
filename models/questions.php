<?php 
  /* Test Model - handling test content db interactions ************************/

    // Add a new question to the database
    function addQuestion($catID,$qQuestion,$qAnswer,$qReference,$qActive){
        $db = testgenConnect();
        $sql = 'INSERT INTO question (catID, qQuestion, qAnswerKey, qReference, qActive)
            VALUES (:catID, :question, :answer, :reference, :active)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':catID', $catID, PDO::PARAM_STR);
        $stmt->bindValue(':question', $qQuestion, PDO::PARAM_STR);
        $stmt->bindValue(':answer', $qAnswer, PDO::PARAM_STR);
        $stmt->bindValue(':reference', $qReference, PDO::PARAM_STR);
        $stmt->bindValue(':active', $qActive, PDO::PARAM_INT);
        $stmt->execute();

        $qID = $db->lastInsertId();
        $stmt->closeCursor();
        return $qID;
    }

    function getQuestionByID($qID) {
        $db = testgenConnect();
        $sql = 'SELECT qID, qQuestion, c.catID, c.catName, qAnswerKey, qReference, qActive, COUNT(tq.questionID) as usetotal FROM question as q INNER JOIN category as c ON c.catID = q.catID INNER JOIN testquestion as tq ON tq.questionID = q.qID WHERE qID = :qID';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':qID', $qID, PDO::PARAM_INT);
        $stmt->execute();

        $question = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $question;
    }

    function updateQuestion($questionID,$qQuestion,$qAnswerKey,$qReference,$qActive) {
        $db = testgenConnect();
        $sql = 'UPDATE question SET qQuestion = :qQuestion, qAnswerKey = :qAnswerKey, qReference = :qReference, qActive = :qActive WHERE qID = :questionID';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':qQuestion', $qQuestion, PDO::PARAM_STR);
        $stmt->bindValue(':qAnswerKey', $qAnswerKey, PDO::PARAM_STR);
        $stmt->bindValue(':qReference', $qReference, PDO::PARAM_STR);
        $stmt->bindValue(':qActive', $qActive, PDO::PARAM_INT);       
        $stmt->bindValue(':questionID', $questionID, PDO::PARAM_INT);
        $stmt->execute();
        
        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    // do we really need this ... active field is needed versus delete.
    function toggleQuestionActiveState($qID) {
        $db = testgenConnect();
        $sql = 'SELECT qActive FROM question WHERE qID = :qID';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':qID', $qID, PDO::PARAM_INT);
        $stmt->execute();

        $qState = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $qState;
    }

    function getAllQuestions() {
        $db = testgenConnect();
        $sql = 'SELECT c.catName, q.qQuestion, q.qID, q.qActive FROM question AS q INNER JOIN category AS c ON q.catID = c.catID';
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $questions;
    }

    function getQuestionsByCategory($catID){
        $db = testgenConnect();
        //$sql = 'SELECT * FROM question WHERE catID IN (SELECT catID FROM category WHERE catName = :catName)';
        $sql = 'SELECT c.catName, q.qQuestion, q.qID, q.qActive FROM question AS q INNER JOIN category AS c ON q.catID = c.catID WHERE q.catID = :catID';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':catID', $catID, PDO::PARAM_STR);
        $stmt->execute();

        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $questions;
    }

    function getQuestionCountByCategory($catID) {
        $db = testgenConnect();
        $sql = 'SELECT q.qID FROM question AS q WHERE catID = :catID';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':catID', $catID, PDO::PARAM_INT);
        $stmt->execute();
        
        $count = $stmt->rowCount();
        $stmt->closeCursor();
        return $count;
    }

    function getQuestionUseCountByCategory($catID) {
        $db = testgenConnect();
        $sql = 'SELECT tq.testquestionID FROM testquestion AS tq INNER JOIN question AS q ON tq.questionID = q.qID WHERE q.catID = :catID';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':catID', $catID, PDO::PARAM_INT);
        $stmt->execute();
        
        $count = $stmt->rowCount();
        $stmt->closeCursor();
        return $count;
    }

    function getRandomQuestions($catID, $numOfQuestions) {
        $numOfQuestions = intval($numOfQuestions);
        $db = testgenConnect();
        $sql = 'SELECT qID FROM question WHERE catID = :catID AND qActive = 1 ORDER BY RAND() LIMIT :numOfQuestions';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':catID', $catID, PDO::PARAM_INT);
        $stmt->bindValue(':numOfQuestions', $numOfQuestions, PDO::PARAM_INT);
        $stmt->execute();

        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $questions;
    }