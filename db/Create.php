<?php

include 'database.php';

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $database CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
$conn->query($sql);

// Select the database
$conn->select_db($database);

// SQL to create tables and view
$tablesAndViewsSql = [
    "CREATE TABLE IF NOT EXISTS player( 
        fName VARCHAR(50) NOT NULL, 
        lName VARCHAR(50) NOT NULL, 
        userName VARCHAR(20) NOT NULL UNIQUE,
        registrationTime DATETIME NOT NULL,
        id VARCHAR(200) GENERATED ALWAYS AS (CONCAT(UPPER(LEFT(fName,2)),UPPER(LEFT(lName,2)),UPPER(LEFT(userName,3)),CAST(registrationTime AS SIGNED))),
        registrationOrder INTEGER AUTO_INCREMENT,
        PRIMARY KEY (registrationOrder)
    ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci",

    "CREATE TABLE IF NOT EXISTS authenticator(   
        passCode VARCHAR(255) NOT NULL,
        registrationOrder INTEGER, 
        FOREIGN KEY (registrationOrder) REFERENCES player(registrationOrder)
    ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci",

    "CREATE TABLE IF NOT EXISTS score( 
        scoreTime DATETIME NOT NULL, 
        result ENUM('win', 'gameover', 'incomplete'),
        livesUsed INTEGER NOT NULL,
        registrationOrder INTEGER, 
        FOREIGN KEY (registrationOrder) REFERENCES player(registrationOrder)
    ) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci",

    "CREATE VIEW IF NOT EXISTS history AS
    SELECT s.scoreTime, p.id, p.fName, p.lName, s.result, s.livesUsed 
    FROM player p, score s
    WHERE p.registrationOrder = s.registrationOrder"
];

// Execute each SQL statement to create tables and views
foreach ($tablesAndViewsSql as $sql) {
    $conn->query($sql);
}

$conn->close();
?>
