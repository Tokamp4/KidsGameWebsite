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
            <input id="button" type="submit" value="Sign up">
            <br></br>
            <a href="login.php">Click to Login</a><br><br>
        </form>
    </div>

    <?php
    session_start();
        include("connection.php");
        include("functions.php");
        
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $user_name = $_POST['user_name'];
            $password = $_POST['password'];

            if(!empty($user_name) && !empty($password) && !is_numeric($user_name)){
                $user_id = random_num(100)
                $query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')"; 

                mysqli_query($con, $query);

                header("Location: login.php");
                die;
            }
            else{
                echo "Unvalid user name or password. Please try again!"
            }

        }
    ?>

</body>
</html>

