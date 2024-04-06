<?php
include 'database.php';

// Dummy data for the player table
$playerData = [
    ['Patrick', 'Saint-Louis', 'sonic12345', 'NOW()'],
    ['Marie', 'Jourdain', 'asterix2023', 'NOW()'],
    ['Jonathan', 'David', 'pokemon527', 'NOW()']
];

// Insert data into the player table
foreach ($playerData as $data) {
    $stmt = $conn->prepare("INSERT INTO player (fName, lName, userName, registrationTime) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $data[0], $data[1], $data[2]);
    $stmt->execute();
}

// Assuming password_hash() was used to hash these passwords beforehand
$authenticatorData = [
    ['$2y$10$AMyb4cbGSWSvEcQxt91ZVu5r5OV7/3mMZl7tn8wnZrJ1ddidYfVYW', 1],
    ['$2y$10$Lpd3JsgFW9.x2ft6Qo9h..xmtm82lmSuv/vaQKs9xPJ4rhKlMJAF.', 2],
    ['$2y$10$FRAyAIK6.TYEEmbOHF4JfeiBCdWFHcqRTILM7nF/7CPjE3dNEWj3W', 3]
];

// Insert data into the authenticator table
foreach ($authenticatorData as $data) {
    $stmt = $conn->prepare("INSERT INTO authenticator (passCode, registrationOrder) VALUES (?, ?)");
    $stmt->bind_param("si", $data[0], $data[1]);
    $stmt->execute();
}

// Dummy data for the score table
$scoreData = [
    ['NOW()', 'win', 4, 1],
    ['NOW()', 'gameover', 6, 2],
    ['NOW()', 'incomplete', 5, 3]
];

// Insert data into the score table
foreach ($scoreData as $data) {
    $stmt = $conn->prepare("INSERT INTO score (scoreTime, result, livesUsed, registrationOrder) VALUES (NOW(), ?, ?, ?)");
    $stmt->bind_param("sii", $data[1], $data[2], $data[3]);
    $stmt->execute();
}

echo "Dummy data inserted successfully.";

$conn->close();
?>

