<?php 
/* ∆ Accounts Model ***********************************************/

function register($accountFirstname, $accountLastname, $accountEmail, $accountPassword) {
    $db = testgenConnect();
    $sql = 'INSERT INTO account (accFirstName, accLastName, accEmail, accPassword, accLevel)
        VALUES (:accountFirstname, :accountLastname, :accountEmail, :accountPassword, 1)';
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':accountFirstname', $accountFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':accountLastname', $accountLastname, PDO::PARAM_STR);
    $stmt->bindValue(':accountEmail', $accountEmail, PDO::PARAM_STR);
    $stmt->bindValue(':accountPassword', $accountPassword, PDO::PARAM_STR);
    
    $stmt->execute();
    $accID = $db->lastInsertId(); 
    $stmt->closeCursor();
    return $accID;
}

// Check for an existing email address
function checkExistingEmail($accountEmail) {
    $db = testgenConnect();
    $sql = 'SELECT accEmail FROM account WHERE accEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $accountEmail, PDO::PARAM_STR);
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();

    if (empty($matchEmail)) {
     return 0;
    } else {
     return 1;
    }
}

// Get account information based on an email address
function getAccountByEmail($accountEmail){
    $db = testgenConnect();
    $sql = 'SELECT * FROM account WHERE accEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $accountEmail, PDO::PARAM_STR);
    $stmt->execute();
    $accountData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $accountData;
} 

// Get account data based on accountId
function getAccountById($accountId){
    $db = testgenConnect();
    $sql = 'SELECT * FROM account WHERE accID = :accountID';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':accountID', $accountID, PDO::PARAM_INT);
    $stmt->execute();
    $accountData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $accountData;
   }

function updateAccountProfile($accountFirstname, $accountLastname, $accountEmail, $accountID){
    $db = testgenConnect();
    $sql = 'UPDATE account SET accFirstname = :accountFirstname, accLastname = :accountLastname, accEmail = :accountEmail WHERE accID = :accountId';
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':accountFirstname', $accountFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':accountLastname', $accountLastname, PDO::PARAM_STR);
    $stmt->bindValue(':accountEmail', $accountEmail, PDO::PARAM_STR);
    $stmt->bindValue(':accountID', $accountID, PDO::PARAM_INT);

    $stmt->execute();
    $rowsChanged = $stmt->rowCount(); // validation using rowCount (1 UPDATE)
    $stmt->closeCursor();
    return $rowsChanged;
   }

function updateAccountPassword($accountPassword, $accountId){
    $db = testgenConnect();
    $sql = 'UPDATE account SET accPassword = :accountPassword WHERE accID = :accountId';
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':accountPassword', $accountPassword, PDO::PARAM_STR);
    $stmt->bindValue(':accountId', $accountId, PDO::PARAM_INT);

    $stmt->execute();
    $rowsChanged = $stmt->rowCount();   // validation using rowCount (1 UPDATE)
    $stmt->closeCursor();
    return $rowsChanged;
   }