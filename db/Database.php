<?php

// Database configuration
$host = 'localhost'; 
$username = 'root';
$password = ''; 
$database = 'kidsGames'; 

// Create connection
$conn = new mysqli($host, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $database CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully or already exists<br>"; 
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

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
    )CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci",

    "CREATE TABLE IF NOT EXISTS authenticator(   
        passCode VARCHAR(255) NOT NULL,
        registrationOrder INTEGER, 
        FOREIGN KEY (registrationOrder) REFERENCES player(registrationOrder)
    )CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci",

    "CREATE TABLE IF NOT EXISTS score( 
        scoreTime DATETIME NOT NULL, 
        result ENUM('win', 'gameover', 'incomplete'),
        livesUsed INTEGER NOT NULL,
        registrationOrder INTEGER, 
        FOREIGN KEY (registrationOrder) REFERENCES player(registrationOrder)
    )CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci",

    "CREATE VIEW IF NOT EXISTS history AS
    SELECT s.scoreTime, p.id, p.fName, p.lName, s.result, s.livesUsed 
    FROM player p, score s
    WHERE p.registrationOrder = s.registrationOrder"
];

// Execute each SQL statement to create tables and views
foreach ($tablesAndViewsSql as $sql) {
    if ($conn->query($sql) === TRUE) {
        echo "Table or view created successfully<br>";
    } else {
        echo "Error creating table or view: " . $conn->error . "<br>";
    }
}

// Insert dummy data
$dummyDataSql = [
    "INSERT INTO player(fName, lName, userName, registrationTime) VALUES('Patrick','Saint-Louis', 'sonic12345', now()), ('Marie','Jourdain', 'asterix2023', now()), ('Jonathan','David', 'pokemon527', now())",
    "INSERT INTO authenticator(passCode, registrationOrder) VALUES('$2y$10$AMyb4cbGSWSvEcQxt91ZVu5r5OV7/3mMZl7tn8wnZrJ1ddidYfVYW', 1), ('$2y$10$Lpd3JsgFW9.x2ft6Qo9h..xmtm82lmSuv/vaQKs9xPJ4rhKlMJAF.', 2), ('$2y$10$FRAyAIK6.TYEEmbOHF4JfeiBCdWFHcqRTILM7nF/7CPjE3dNEWj3W', 3)",
    "INSERT INTO score(scoreTime, result , livesUsed, registrationOrder) VALUES(now(), 'win', 4, 1), (now(), 'gameover', 6, 2), (now(), 'incomplete', 5, 3)"
];

foreach ($dummyDataSql as $sql) {
    if ($conn->query($sql) === TRUE) {
        echo "Dummy data inserted successfully<br>";
    } else {
        echo "Error inserting dummy data: " . $conn->error . "<br>";
    }
}

// Close connection
$conn->close();

?>