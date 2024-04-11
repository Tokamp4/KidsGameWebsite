<?php
session_start();

// Include the Database class
require_once '../../db/Database.php';
include '../../db/Insert.php';

// Create an instance of the Database class
$db = new Database();

// Initialize error message variable
$error_message = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $username = $_POST['username'];
    $password = $_POST['password'];


    // Validate input
    if (empty($username) || empty($password)) {
        $error_message = "All fields are required.";
    } elseif (strlen($password) < 8){
        $error_message = "The new password must have at least 8 characters!";
    } else {
        // Attempt to connect to the database management system (DBMS)
        if ($db->connectToDBMS()) {
            // Attempt to connect to the specific database
            if ($db->connectToDB('kidsGames')) {
                // Check if username already exists
                $checkQuery = "SELECT registrationOrder FROM player WHERE userName = '$username'";
                $result = $db->executeOneQuery($checkQuery);
               if($result){             
                    $password = $db->getConnection()->real_escape_string($password);
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $updateQuery = "UPDATE authenticator a SET password = '$hashedPassword' WHERE registrationOrder = '$result'";
                    if($db->executeOneQuery($updateQuery)){
                        //Update Successful
                        $_SESSION['success_message'] = "Password changed successfully! You can now login.";
                        header("Location: http://localhost/WebServerProject_Winter2024/public/form/pw-update-form.php");
                        exit();
                    }else{
                        $error_message = "Error updating password.";
                    }       
               }else{
                    $error_message = "This username does not exist!";
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
header("Location: http://localhost/WebServerProject_Winter2024/public/form/pw-update-form.php?error_message=" . urlencode($error_message));
exit();
?>
