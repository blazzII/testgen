<?php 
/* ∆ Accounts Model ***********************************************/

function register($accountFirstName, $accountLastName, $accountEmail, $accountPassword) {
    $db = testgenConnect();
    $sql = 'INSERT INTO account (accFirstName, accLastName, accEmail, accPassword, accLevel)
        VALUES (:accountFirstName, :accountLastName, :accountEmail, :accountPassword, 1)';
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':accountFirstName', $accountFirstName, PDO::PARAM_STR);
    $stmt->bindValue(':accountLastName', $accountLastName, PDO::PARAM_STR);
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

// Get account information based on account id
function getAccount($accID){
    $db = testgenConnect();
    $sql = 'SELECT * FROM account WHERE accID = :accID';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':accID', $accID, PDO::PARAM_INT);
    $stmt->execute();
    $accountData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $accountData;
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

// Get account by Level
function getAccountByLevel($accLevel) {
    $db = testgenConnect();
    $sql = 'SELECT * FROM account WHERE accLevel = :accLevel ORDER BY accLastName ASC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':accLevel', $accLevel, PDO::PARAM_INT);
    $stmt->execute();
    $accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $accounts;    
}

// Get account data based on accountId
function getAccountByID($accID){
    $db = testgenConnect();
    $sql = 'SELECT * FROM account WHERE accID = :accID';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':accID', $accID, PDO::PARAM_INT);
    $stmt->execute();
    $accountData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $accountData;
   }

// Update Account using account ID
function updateAccount($accID, $accFirstName, $accLastName, $accEmail, $accLevel) {
    $db = testgenConnect();
    $sql = 'UPDATE account SET accFirstName = :accFirstName, accLastName = :accLastName, accEmail = :accEmail, accLevel = :accLevel WHERE accID = :accID';
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':accID', $accID, PDO::PARAM_INT);
    $stmt->bindValue(':accFirstName', $accFirstName, PDO::PARAM_STR);
    $stmt->bindValue(':accLastName', $accLastName, PDO::PARAM_STR);
    $stmt->bindValue(':accEmail', $accEmail, PDO::PARAM_STR);
    $stmt->bindValue(':accLevel', $accLevel, PDO::PARAM_INT);

    $stmt->execute();
    $accountUpdated = $stmt->rowCount();
    $stmt->closeCursor();
    return $accountUpdated;
   }

// Update Account Password
function updateAccountPassword($accountPassword, $accountId){
    $db = testgenConnect();
    $sql = 'UPDATE account SET accPassword = :accountPassword WHERE accID = :accountId';
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':accountPassword', $accountPassword, PDO::PARAM_STR);
    $stmt->bindValue(':accountId', $accountId, PDO::PARAM_INT);

    $stmt->execute();
    $passwordupdated = $stmt->rowCount();
    $stmt->closeCursor();
    return $passwordupdated;
   }

// Delete Account using Account ID - Admin level only
function deleteAccount($accID) {
    $db = testgenConnect();
    $sql = 'DELETE FROM account WHERE accID = :accID';
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':accID', $accID, PDO::PARAM_INT);

    $stmt->execute();
    $accountdeleted = $stmt->rowCount();
    $stmt->closeCursor();
    return $accountdeleted;
}
