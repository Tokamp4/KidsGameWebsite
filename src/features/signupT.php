<?php
session_start();

// Include database connection
include '../../db/Database.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeat_password'];

    // Validate input (You can add more validation if required)
    if (empty($name) || empty($email) || empty($password) || empty($repeatPassword)) {
        $error_message = "All fields are required.";
    } elseif ($password !== $repeatPassword) {
        $error_message = "Passwords do not match.";
    } else {
        // Escape user input to prevent SQL injection
        $name = $conn->real_escape_string($name);
        $email = $conn->real_escape_string($email);
        // Hash the password for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert user data into the database
        $insertQuery = "INSERT INTO player (fName, userName, registrationTime) VALUES ('$name', '$email', NOW())";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="public/assets/css/main.css">
</head>
<body>
    
    <div class="container padding-top">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 ">
                <div class="wraper">
                    <div class="er">
                        <?php if(isset($error_message)) { echo $error_message; } ?>
                    </div>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Repeat Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="repeat_password" required>
                        </div>
                        <br>
                        <input type="submit"  value="Submit" class="btn btn-default">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
