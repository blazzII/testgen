<?php 
  /* Category Model - handling category db content ************************/

  function getAllCategories() {
    $db = testgenConnect();
    $sql = 'SELECT catID, catName FROM category ORDER BY catName ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $categories;
  }
  
  
  function addCategory($catName) {
    $db = testgenConnect();
    $sql = 'INSERT INTO category (catName) VALUES (:catName)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':catName', $catName, PDO::PARAM_STR);
    $stmt->execute();

    $categoryadded = $stmt->rowCount();
    $stmt->closeCursor();
    return $categoryadded;
  }