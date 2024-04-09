
<?php
// signup.php to handle all AJAX requests for field validation

$field = $_POST['field'] ?? '';
$value = $_POST['value'] ?? '';

function validateFirstName($fname) {
    return empty($fname) ? "First name is required. Please try again!" : "";
}

function validateLastName($lname) {
    return empty($lname) ? "Last name is required. Please try again!" : "";
}

function validateUsername($uname) {
    return empty($uname) ? "Username is required. Please try again!" : "";
}

function validatePassword($password) {
    if (empty($password)) {
        return "Password is required. Please try again!";
    }
    if (strlen($password) < 6) {
        return "Password must be at least 6 characters long. Please try again!";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        return "Password must include at least one uppercase letter. Please try again!";
    }
    if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
        return "Password must include at least one special character. Please try again!";
    }
    return "";
}

function validateConfirmPassword($password, $confirmPassword) {
    if ($password !== $confirmPassword) {
        return "Password doesn't match. Please try again!";
    }
    return "";
}

$response = "";
switch ($field) {
    case 'fname':
        $response = validateFirstName($value);
        break;
    case 'lname':
        $response = validateLastName($value);
        break;
    case 'uname':
        $response = validateUsername($value);
        break;
    case 'pcode1':
        $response = validatePassword($value);
        break;
    case 'pcode2':
        $confirmValue = $_POST['confirmValue'] ?? '';
        $response = validateConfirmPassword($value, $confirmValue);
        break;
    default:
        $response = "Invalid request";
}

echo $response;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        form label {
            display: block;
            color: #606770;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        form input[type='text'],
        form input[type='password'] {
            width: 100%;
            padding: 14px;
            border: 1px solid #dddfe2;
            margin-bottom: 10px;
            border-radius: 6px;
            font-size: 17px;
        }

        form input[type='text']:focus,
        form input[type='password']:focus {
            border-color: #1877f2;
            outline: none;
        }

        form button {
            width: 100%;
            padding: 14px;
            background-color: #1877f2;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }

        form button:hover {
            background-color: #165cbb;
        }

        #fnameError,
        #lnameError,
        #unameError,
        #pcode1Error,
        #pcode2Error {
            color: #f02849;
            font-size: 13px;
            height: 20px;
        }

        @media (max-width: 360px) {
            form {
                width: 90%;
            }
        }
    </style>
    
</head>
<body>

<form id="signupForm" method="post" novalidate>
    <label for="fname">First Name:</label>
    <input type="text" id="fname" name="fname" required>
    <div id="fnameError"></div>

    <label for="lname">Last Name:</label>
    <input type="text" id="lname" name="lname" required>
    <div id="lnameError"></div>

    <label for="uname">Username:</label>
    <input type="text" id="uname" name="uname" required>
    <div id="unameError"></div>

    <label for="pcode1">Password:</label>
    <input type="password" id="pcode1" name="pcode1" required>
    <div id="pcode1Error"></div>

    <label for="pcode2">Confirm Password:</label>
    <input type="password" id="pcode2" name="pcode2" required>
    <div id="pcode2Error"></div>

    <button type="submit">Sign Up</button>
</form>

<script src="js/jquery-3.6.4.js"></script>
<script src="js/fname-ajax.js"></script>
<script src="js/lname-ajax.js"></script>
<script src="js/uname-ajax.js"></script>
<script src="js/pcode1-ajax.js"></script>
<script src="js/pcode2-ajax.js"></script>

</body>
</html>


