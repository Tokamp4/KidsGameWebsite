<?php
include 'database.php';

// Update a player's username
$oldUserName = 'sonic12345';
$newUserName = 'sonic2024';
$stmt = $conn->prepare("UPDATE player SET userName = ? WHERE userName = ?");
$stmt->bind_param("ss", $newUserName, $oldUserName);
$stmt->execute();
echo "Player username updated successfully.<br>";

// Update a password in the authenticator table
// Assume we know the registrationOrder of the user we want to update
$registrationOrder = 1;
$newHashedPassword = password_hash('newPassword123', PASSWORD_DEFAULT);
$stmt = $conn->prepare("UPDATE authenticator SET passCode = ? WHERE registrationOrder = ?");
$stmt->bind_param("si", $newHashedPassword, $registrationOrder);
$stmt->execute();
echo "Authenticator password updated successfully.<br>";

// Update a game result in the score table
// Assume we want to update a specific game result by registrationOrder and scoreTime
$registrationOrderForScoreUpdate = 1;
$oldResult = 'incomplete';
$newResult = 'win';
$newLivesUsed = 3;
$stmt = $conn->prepare("UPDATE score SET result = ?, livesUsed = ? WHERE registrationOrder = ? AND result = ?");
$stmt->bind_param("siis", $newResult, $newLivesUsed, $registrationOrderForScoreUpdate, $oldResult);
$stmt->execute();
echo "Score updated successfully.<br>";

$conn->close();
?>
