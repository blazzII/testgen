<?php 
  /* Test Model - handling test content db interactions ************************/

    // Add a new question to the database
    function addQuestion($catID,$qQuestion,$qAnswer,$qReference){
        $db = testgenConnect();
        $sql = 'INSERT INTO question (catID, qQuestion, qAnswerKey, qReference)
            VALUES (:catID, :question, :answer, :reference)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':catID', $catID, PDO::PARAM_STR);
        $stmt->bindValue(':question', $qQuestion, PDO::PARAM_STR);
        $stmt->bindValue(':answer', $qAnswer, PDO::PARAM_STR);
        $stmt->bindValue(':reference', $qReference, PDO::PARAM_STR);
        $stmt->execute();

        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    function getQuestionByID($qID) {
        $db = testgenConnect();
        $sql = 'SELECT qID, qQuestion, catName, qAnswerKey, qReference, qActive FROM question as q INNER JOIN category as cat ON cat.catID = q.catID WHERE qID = :qID';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':qID', $qID, PDO::PARAM_INT);
        $stmt->execute();

        $question = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $question;
    }

    function updateQuestion($qID,$qQuestion) {
        $db = testgenConnect();
        $sql = 'UPDATE inventory SET invName = :invName, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, 
            invStock = :invStock, invSize = :invSize, invWeight = :invWeight, invLocation = :invLocation, categoryId = :categoryId, 
            invVendor = :invVendor, invStyle = :invStyle WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
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

    function getRandomQuestions($catID, $numOfQuestions) {
        $db = testgenConnect();
        $sql = 'SELECT qID FROM question WHERE catID = :catID ORDER BY RAND() LIMIT :numOfQuestions';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':catID', $catID, PDO::PARAM_INT);
        $stmt->bindValue(':numOfQuestions', $numOfQuestions, PDO::PARAM_INT);
        $stmt->execute();

        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $questions;
    }