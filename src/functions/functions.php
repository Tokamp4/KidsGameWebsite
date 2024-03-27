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
    function isPasswordStrong($password) {
        if (strlen($password) < 6) {
            return "Password must be at least 6 characters long.";
        }
        if (!preg_match('@[A-Z]@', $password)) {
            return "Password must include at least one uppercase letter.";
        }
        if (!preg_match('@[^\w]@', $password)) {
            return "Password must contain at least one special character.";
        }
        return "";
    }
?>
