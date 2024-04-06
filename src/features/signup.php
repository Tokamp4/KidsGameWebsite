<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    session_start();
    
    require_once "../functions/connection-functions.php";
    require_once "../functions/functions.php";

    $response = ['success' => false, 'message' => ''];

    $userName = $_POST['user_name'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    $fName = $_POST['first_name'] ?? '';
    $lName = $_POST['last_name'] ?? '';

    if (empty($userName) || empty($password) || empty($fName) || empty($lName)) {
        $response['message'] = 'Please fill in all fields.';
    } elseif ($password !== $confirmPassword) {
        $response['message'] = 'Passwords do not match.';
    } elseif ($passwordMessage = isPasswordStrong($password)) {
        $response['message'] = $passwordMessage;
    } else {
        $response = ['success' => true, 'message' => 'Registration successful!'];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("form").submit(function(event) {
                event.preventDefault();
                var formData = {
                    'user_name': $('input[name=user_name]').val(),
                    'password': $('input[name=password]').val(),
                    'confirm_password': $('input[name=confirm_password]').val(),
                    'first_name': $('input[name=first_name]').val(),
                    'last_name': $('input[name=last_name]').val()
                };

                $.ajax({
                    type: "POST",
                    url: "signup.php", // URL is this file itself
                    data: formData,
                    dataType: "json", 
                })
                .done(functioSn(data) {
                    $('#responseMessage').html(data.message);
                    if(data.success) {
                        $('form').trigger("reset");
                    }
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    $('#responseMessage').html("AJAX request failed: " + textStatus + ", " + errorThrown);
                });
            });
        });
    </script>
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
            <br><br>
            <a href="login.php">Click to Login</a><br><br>
        </form>
        <div id="responseMessage" style="margin-top: 20px;"></div>
    </div>
</body>
</html>




