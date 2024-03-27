<?php
    $dbhost = "localhost"
    $dbuser = "root"
    $dbpass = ""
    $dbname = "database-entry"

    if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname )){
        die("Unable to connect!");
    }
