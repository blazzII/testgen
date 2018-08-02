<?php 
  /* Test Model - handling test content db interactions ************************/

    // Add a new question to the database
    function addQuestion($qCategory,$qQuestion,$qAnswer,$qReference){
        $db = testgenConnect();
        $sql = 'INSERT INTO question (questionCategoryID, question, answer, reference)
            VALUES (:categoryID, :question, :answer, :reference)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':categoryID', $categoryID, PDO::PARAM_STR);
        $stmt->bindValue(':question', $question, PDO::PARAM_STR);
        $stmt->bindValue(':answer', $answer, PDO::PARAM_STR);
        $stmt->bindValue(':reference', $reference, PDO::PARAM_STR);
        $stmt->execute();

        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    // Add new test category (rare)
    function addCategory($categoryName) {
        $db = testgenConnect();
        $sql = 'INSERT INTO categories (categoryName) VALUES (:categoryName)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
        $stmt->execute();

        $rowsChanged = $stmt->rowCount();
        $stmt->closeCursor();
        return $rowsChanged;
    }

    function getQuestionDetails() {
        $db = testgenConnect();
        $sql = 'SELECT invName, invId FROM inventory ORDER BY invName ASC';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $products;
    }

    // Get product information by invId
    function getProductInfo($invId){
        $db = testgenConnect();
        $sql = 'SELECT * FROM inventory WHERE invId = :invId';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        $stmt->execute();
        $prodInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $prodInfo;
    }

    //update a product
    function updateProduct($invName,$invDescription,$invImage,$invThumbnail,$invPrice,$invStock,$invSize,$invWeight,$invLocation,$categoryId,$invVendor,$invStyle, $invId) {
        // Create a connection object using the acme connection function
        $db = testgenConnect();
        // The SQL statement
        $sql = 'UPDATE inventory SET invName = :invName, invDescription = :invDescription, invImage = :invImage, invThumbnail = :invThumbnail, invPrice = :invPrice, 
            invStock = :invStock, invSize = :invSize, invWeight = :invWeight, invLocation = :invLocation, categoryId = :categoryId, 
            invVendor = :invVendor, invStyle = :invStyle WHERE invId = :invId';
        // Create the prepared statement using the acme connection
        $stmt = $db->prepare($sql);
        // The next four lines replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
        $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
        $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
        $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
        $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
        $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
        $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
        $stmt->bindValue(':invSize', $invSize, PDO::PARAM_STR);
        $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_STR);
        $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
        $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_STR);
        $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
        $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        // Insert the data
        $stmt->execute();
        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
    }

    //delete a product
    function deleteProduct($invId) {
        // Create a connection object using the acme connection function
        $db = testgenConnect();
        // The SQL statement
        $sql = 'DELETE FROM inventory WHERE invId = :invId';
        // Create the prepared statement using the acme connection
        $stmt = $db->prepare($sql);
        // The next four lines replace the placeholders in the SQL
        // statement with the actual values in the variables
        // and tells the database the type of data it is
        $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
        // Insert the data
        $stmt->execute();
        // Ask how many rows changed as a result of our insert
        $rowsChanged = $stmt->rowCount();
        // Close the database interaction
        $stmt->closeCursor();
        // Return the indication of success (rows changed)
        return $rowsChanged;
    }

    //return all product info based on the supplied category name argument
    function getProductsByCategory($type){
        $db = testgenConnect();
        $sql = 'SELECT * FROM inventory WHERE categoryId IN (SELECT categoryId FROM categories WHERE categoryName = :catType)';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':catType', $type, PDO::PARAM_STR);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $products;
    }