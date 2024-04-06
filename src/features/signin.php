
<?php
session_start();







//Connection
include 'database.php';

// Authenticate user
function authenticateUser($username, $password, $conn) {
    $sql = "SELECT a.passCode, p.registrationOrder FROM authenticator a 
            JOIN player p ON a.registrationOrder = p.registrationOrder 
            WHERE p.userName='$username'";
    $result = $conn->query($sql);

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

// Function to handle timeout
function checkTimeout() {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 900)) {  //15 minutes
        logout();
    } else {
        $_SESSION['last_activity'] = time(); // Update last activity time
    }
}

// Check if user is already logged in
if (isset($_SESSION['registrationOrder'])) {
    checkTimeout();
    header("Location: game.php");
}

// Login form submission
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (authenticateUser($username, $password, $conn)) {
        // Authentication successful, start session and go to game page
        $_SESSION['username'] = $username;
        $_SESSION['last_activity'] = time(); // Set last activity time
        header("Location: game.php");
    } else {
        // Authentication failed
        $error_message = "Sorry, the username or password is incorrect!";
    }
}

// Process logout request
if (isset($_GET['logout'])) {
    logout();
}
