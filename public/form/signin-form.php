<?php
include('../template/footer.php') 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body>
    <div class="menu-btn">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
    </div>
    <div class="menu">
        <div id="menu-wrap">
            <nav>
                <ul>
                    <li><a href="game-form.php">HOME</a></li>  
                    <li><a href="signin-form.php">LOGIN</a></li>
                    <li><a href="signup-form.php">REGISTER</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="container padding-top">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="flash-info">
                    <!-- Display any flash messages here -->
                </div>
                <div class="wrapper">
                    <form method="post" action="src/features//signinT.php" >
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="exampleInputEmail1" placeholder="Username" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" >
                        </div>
                        <button type="submit" class="btn btn-default" name="login">Submit</button>
                    </form>
                </div>
                <div class="display-error">
                    <!-- Display any error messages here -->
                    <?php if (isset($error_message)) { echo $error_message; } ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script src="../assets/js/menu.js"></script>
</body>
<footer>
    <?php //footernavigator();?>
</footer>
</html>
