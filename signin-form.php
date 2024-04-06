<!DOCTYPE html>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>
        Quiz 
    </title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="public/assets/css/main.css">
   
</head>
<body>
 

  <div class="menu-btn" >
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
        <div class="flash-info">
          <!-- <?php
        //   if(isset($_SESSION['registerSuccess'])) {
            // echo $_SESSION['registerSuccess'];
        //   }
         ?> -->
        </div>

        <div class="wraper">
          <form method="post" action="check_login.php">
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
          </form>
        </div>
        <div class="display-error">
            <!-- <?php
            // if(isset($_SESSION['loginFailed'])) {
            //   echo $_SESSION['loginFailed'];
            //   unset($_SESSION['loginFailed']);
            // }
             ?> -->
        </div>
      </div>
    </div>
  </div>

<script
  src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="crossorigin="anonymous">
</script>
 <script src="public/assets/js/menu.js"></script>
 
</html>
<?php

// else{
//   header("Location:index.php");
//   exit();

// }