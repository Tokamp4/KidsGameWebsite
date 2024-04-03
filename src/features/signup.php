<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .text{
            height: 40px;
            border-radius: 5px;
            padding: 4px 10px;
            border: solid thin #aaa;
            display: block;
            margin-bottom: 20px;
            width: calc(100% - 20px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }
        .text:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0,123,255,0.2);
        }
        #button{
            padding: 10px;
            width: calc(100% - 20px);
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        #button:hover {
            background-color: #0056b3;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        #box{
            background-color: white;
            margin: 50px auto;
            width: 300px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }
        a:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        form {
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="box">
        <form method="post">
            <div style="font-size: 20px; margin: 10px; color: black;">Sign up</div>
            <input class="text" type="text" name="user_name" placeholder="Username">
            <input class="text" type="password" name="password" placeholder="Password">
            <input class="text" type="password" name="confirm_password" placeholder="Confirm Password">
            <input class="text" type="text" name="first_name" placeholder="First Name">
            <input class="text" type="text" name="last_name" placeholder="Last Name">
            <input id="button" type="submit" value="Sign up">
            <br></br>
            <a href="login.php">Click to Login</a><br><br>
        </form>
    </div>

    <?php
        session_start();
        require "connection.php";
        require "functions.php";

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $fName = $_POST['first_name']; 
            $lName = $_POST['last_name']; 
            $userName = $_POST['user_name'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
        
            $passwordStrengthMessage = isPasswordStrong($password);
        
            if (!empty($userName) && !empty($password) && !empty($fName) && !empty($lName) && passwordsMatch($password, $confirm_password)) {
                if ($passwordStrengthMessage === "") {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                } else {
                    echo $passwordStrengthMessage;
                }
            } else {
                if (!passwordsMatch($password, $confirm_password)) {
                    echo "Passwords do not match. Please try again!";
                } else {
                    echo "Unvalid insert. Please try again!";
                }
            }
        }
    ?>

</body>
</html>

