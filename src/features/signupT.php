<?php
session_start();

// Include the Database class
require_once '../../db/Database.php';

// Create an instance of the Database class
$db = new Database();

// Initialize error message variable
$error_message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['confirmPassword'];

    // Validate input (You can add more validation if required)
    if (empty($firstName) || empty($lastName) || empty($username) || empty($password) || empty($repeatPassword)) {
        $error_message = "All fields are required.";
    } elseif ($password !== $repeatPassword) {
        $error_message = "Passwords do not match.";
    } else {
        // Attempt to connect to the database management system (DBMS)
        if ($db->connectToDBMS()) {
            // Attempt to connect to the specific database
            if ($db->connectToDB('kidsGames')) {
                // Check if username already exists
                $checkQuery = "SELECT COUNT(*) AS count FROM player WHERE userName = '$username'";
                $result = $db->executeOneQuery($checkQuery);

                if ($result && is_array($result)) {
                    $count = $result['count'];
                } else {
                    $count = 0;
                }

                if ($count > 0) {
                    $error_message = "Username already exists. Please choose a different username.";
                } else {
                    // Escape user input to prevent SQL injection
                    $firstName = $db->getConnection()->real_escape_string($firstName);
                    $lastName = $db->getConnection()->real_escape_string($lastName);
                    $username = $db->getConnection()->real_escape_string($username);
                    // Hash the password for security
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    // Insert user data into the database
                    $insertQuery = "INSERT INTO player (fName, lName, userName, registrationTime) VALUES ('$firstName', '$lastName', '$username', NOW())";

                    // Execute the query
                    if ($db->executeOneQuery($insertQuery)) {
                        // Registration successful
                        $_SESSION['success_message'] = "Registration successful. You can now login.";
                        header("Location: ../../signin-form.php");
                        exit();
                    } else {
                        $error_message = "Error inserting user.";
                    }
                }
            } else {
                $error_message = "Error connecting to database: " . $db->getLastErrorMessage();
            }
        } else {
            $error_message = "Error connecting to database management system.";
        }
    }
}

// Close database connection
$db->__destruct();

// Redirect to signup form with error message, if any
header("Location: http://localhost/WebServerProject_Winter2024/public/form/signup-form.php?error_message=" . urlencode($error_message));
exit();
