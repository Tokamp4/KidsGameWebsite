<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Form</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="index.php">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" name="login" value="Login">
        <a href="register.php" class="button">Register</a>
        <a href="forgot_password.php" class="button">Forgot your password? Change it.</a>
    </form>
</body>
</html>
