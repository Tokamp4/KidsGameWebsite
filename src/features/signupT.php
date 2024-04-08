<?php
session_start();

// Include database connection
include '../../db/Database.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeat_password'];

    // Validate input (You can add more validation if required)
    if (empty($firstName) || empty($lastName) || empty($username) || empty($password) || empty($repeatPassword)) {
        $error_message = "All fields are required.";
    } elseif ($password !== $repeatPassword) {
        $error_message = "Passwords do not match.";
    } else {
        // Escape user input to prevent SQL injection
        $firstName = $conn->real_escape_string($firstName);
        $lastName = $conn->real_escape_string($lastName);
        $username = $conn->real_escape_string($username);
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        
        // Insert user data into the database
$insertQuery = "INSERT INTO player (fName, lName, userName, password, registrationTime) VALUES ('$firstName', '$lastName', '$username', '$hashedPassword', NOW())";

        if ($conn->query($insertQuery) === TRUE) {
            // Registration successful
            $_SESSION['success_message'] = "Registration successful. You can now login.";
            header("Location: ../../signin-form.php");
            exit();
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }
}

// Close database connection
$conn->close();
?>
