<?php 
/* ∆ Accounts Model ***********************************************/

function register($accountFirstname, $accountLastname, $accountEmail, $accountPassword) {
    $db = testgenConnect();
    $sql = 'INSERT INTO account (accountFirstName, accountLastName, accountEmail, accountPassword, accountLevel)
        VALUES (:accountFirstname, :accountLastname, :accountEmail, :accountPassword, 1)';
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':accountFirstname', $accountFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':accountLastname', $accountLastname, PDO::PARAM_STR);
    $stmt->bindValue(':accountEmail', $accountEmail, PDO::PARAM_STR);
    $stmt->bindValue(':accountPassword', $accountPassword, PDO::PARAM_STR);
    
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();  // validation check (1 INSERT INTO)
    $stmt->closeCursor();
    return $rowsChanged;
   }

// Check for an existing email address
function checkExistingEmail($accountEmail) {
    $db = testgenConnect();
    $sql = 'SELECT accountEmail FROM account WHERE accountEmail = :email';
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
    $sql = 'SELECT accountID, accountFirstName, accountLastName, accountEmail, accountLevel, accountPassword 
            FROM account
            WHERE accountEmail = :email';
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
    $sql = 'SELECT accountID, accountFirstName, accountLastName, accountEmail, accountLevel, accountPassword 
            FROM account
            WHERE accountID = :accountID';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':accountID', $accountID, PDO::PARAM_INT);
    $stmt->execute();
    $accountData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $accountData;
   }

function updateAccountProfile($accountFirstname, $accountLastname, $accountEmail, $accountID){
    $db = testgenConnect();
    $sql = 'UPDATE account SET accountFirstname = :accountFirstname, accountLastname = :accountLastname, accountEmail = :accountEmail WHERE accountId = :accountId';
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
    $sql = 'UPDATE account SET accountPassword = :accountPassword WHERE accountId = :accountId';
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':accountPassword', $accountPassword, PDO::PARAM_STR);
    $stmt->bindValue(':accountId', $accountId, PDO::PARAM_INT);

    $stmt->execute();
    $rowsChanged = $stmt->rowCount();   // validation using rowCount (1 UPDATE)
    $stmt->closeCursor();
    return $rowsChanged;
   }