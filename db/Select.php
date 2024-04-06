<?php
include 'database.php';

// Select and display players
echo "<h2>Players</h2>";
$sqlPlayers = "SELECT * FROM player";
$resultPlayers = $conn->query($sqlPlayers);

if ($resultPlayers->num_rows > 0) {
    while($row = $resultPlayers->fetch_assoc()) {
        echo "ID: " . $row["id"]. " - Name: " . $row["fName"]. " " . $row["lName"]. " - Username: " . $row["userName"] . "<br>";
    }
} else {
    echo "No players found.<br>";
}

// Select and display password hash for a specific registrationOrder
echo "<h2>Password Hashes</h2>";
$registrationOrder = 1; // Example registration order
$stmtAuthenticator = $conn->prepare("SELECT passCode FROM authenticator WHERE registrationOrder = ?");
$stmtAuthenticator->bind_param("i", $registrationOrder);
$stmtAuthenticator->execute();
$resultAuthenticator = $stmtAuthenticator->get_result();

if ($resultAuthenticator->num_rows > 0) {
    while($row = $resultAuthenticator->fetch_assoc()) {
        echo "Password Hash for Registration Order $registrationOrder: " . $row["passCode"] . "<br>";
    }
} else {
    echo "No password hash found for the specified registration order.<br>";
}

// Select and display scores
echo "<h2>Scores</h2>";
$sqlScores = "SELECT scoreTime, result, livesUsed, registrationOrder FROM score ORDER BY scoreTime DESC";
$resultScores = $conn->query($sqlScores);

if ($resultScores->num_rows > 0) {
    while($row = $resultScores->fetch_assoc()) {
        echo "Game Ended: " . $row["scoreTime"]. " - Result: " . $row["result"]. " - Lives Used: " . $row["livesUsed"] . " - Registration Order: " . $row["registrationOrder"] . "<br>";
    }
} else {
    echo "No game scores found.<br>";
}

// Select and display history
echo "<h2>Game History</h2>";
$sqlHistory = "SELECT * FROM history";
$resultHistory = $conn->query($sqlHistory);

if ($resultHistory->num_rows > 0) {
    while($row = $resultHistory->fetch_assoc()) {
        echo "Game Time: " . $row["scoreTime"]. " - Player ID: " . $row["id"]. " - Name: " . $row["fName"] . " " . $row["lName"] . " - Result: " . $row["result"]. " - Lives Used: " . $row["livesUsed"] . "<br>";
    }
} else {
    echo "No history records found.<br>";
}

$conn->close();
?>

