<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="public/assets/css/main.css">
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
                    <li><a href="index.php">HOME</a></li>  
                    <li><a href="signin-form.php">LOGIN</a></li>
                    <li><a href="signup-form.php">REGISTER</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="container padding-top">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 ">

                <div class="wraper">
                  <div class="er">
                  <?php
                //   if(isset($_SESSION['er'])) {
                //    echo $_SESSION['er'].'<br>';
                //     unset($_SESSION['er']);
                //     echo $_SESSION['dev_error'];
                //   }
                  
                  ?>
                  </div>

                    <form method="POST" action="src/features/signup.php">
                     <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name">
                        <?php
                        // if(isset($_SESSION['error_name'])){
                        //   echo '<div class="display-error">'.$_SESSION['error_name'].'</div>';
                        //   unset($_SESSION['error_name']);
                        // }

                        ?>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input  class="form-control" id="exampleInputEmail1" placeholder="Email" name="email">
                        <?php
                        // if(isset($_SESSION['email_error'])){
                        //   echo '<div class="display-error">'.$_SESSION['email_error'].'</div>';
                        //   unset($_SESSION['email_error']);
                        // }
                        ?>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" name="password">
                        <?php
                        // if(isset($_SESSION['password_error'])){
                        //   echo '<div class="display-error">'.$_SESSION['password_error'].'</div>';
                        //   unset($_SESSION['password_error']);
                        // }
                        ?>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Repeat Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="repeat_password">
                        <?php
                        // if(isset($_SESSION['password_error'])){
                        //   echo '<div class="display-error">'.$_SESSION['password_error'].'</div>';
                        //   unset($_SESSION['password_error']);
                        // }
                        ?>
                      </div>
                   
                      <br>
                      <input type="submit"  value="Submit" class="btn btn-default">
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
    <script src="public/assets/js/menu.js"></script>
</body>
</html>
