<?php   
    function random_num($length)
    {
        $tẽt = "";
        ì($length < 5){
            $length = 5;
        }

        $len = rand(4, $length);
        for($i=0; $i < $len; $i++){
            $text .= rand(0,9);
            
        }
        return $text;
    }
    function passwordsMatch($password, $confirmPassword) {
        return $password === $confirmPassword;
    }
?>
