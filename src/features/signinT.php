<?php
session_start();

// Include database connection
include ('../../db/Database.php');

// Function to authenticate user
function authenticateUser($username, $password, $conn) {
    $sql = "SELECT a.passCode, p.registrationOrder FROM authenticator a 
            JOIN player p ON a.registrationOrder = p.registrationOrder 
            WHERE p.userName=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['passCode'])) {
            $_SESSION['registrationOrder'] = $row['registrationOrder'];
            return true;
        }
    }
    return false;
}

// Function to logout
function logout() {
    session_unset();
    session_destroy();
    header("Location: index.php");
}

// Function to check session timeout
function checkTimeout() {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 900)) {  // 15 minutes
        logout();
    } else {
        $_SESSION['last_activity'] = time(); // Update last activity time
    }
}

// Check if user is already logged in
if (isset($_SESSION['registrationOrder'])) {
    checkTimeout();
    header("Location: game.php");
    exit(); // Ensure no further code execution
}

// Check if there's a login attempt
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Authenticate user
    if (authenticateUser($username, $password, $conn)) {
        // Authentication successful, start session and redirect to game page
        $_SESSION['username'] = $username;
        $_SESSION['last_activity'] = time(); // Set last activity time
        header("Location: game.php");
        exit(); // Ensure no further code execution
    } else {
        // Authentication failed, display error message
        $error_message = "Sorry, the username or password is incorrect!";
    }
}

// Include your HTML content for the signin form
?>
