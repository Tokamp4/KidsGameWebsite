<!-- PHP -->
<?php
// Initialize the game with 6 lives if necessary.
session_start();
if (!isset($_SESSION['lives'])) {
  $_SESSION['lives'] = 6;
}

// Function to randomize the letters.
function shuffleLetters() {
  $letters = range('A', 'Z');
  shuffle($letters);
  return array_slice($letters, 0, 6);
}

// Function to verify if user's letters are correct.
function checkAnswer($firstLetter, $lastLetter, $shuffledLetters) {
    $userLetters = [$firstLetter, $lastLetter];
    
    // Sort user's letters in ascending order.
    sort($shuffledLetters);
  
    foreach ($userLetters as $userLetter) {
      if (!in_array(strtoupper($userLetter), $shuffledLetters)) {
        return false;
      }
    }
  
    return $userLetters[0] == $shuffledLetters[0] && $userLetters[1] == $shuffledLetters[5];
  }
  

// Verification if the form was submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the first and last letters from the player.
  $firstLetter = $_POST['first_letter'];
  $lastLetter = $_POST['last_letter'];

  // Get the shuffled letters.
  $shuffledLetters = $_SESSION['shuffledLetters'];

  // Verify if the letters are correct.
  if (checkAnswer($firstLetter, $lastLetter, $shuffledLetters)) {
    $message = "Correct – You identified the first and last letters correctly.";

    // Next question button.
    $nextQuestionButton = '<button onclick="location.href=\'Question_6.php\'">Next Question</button>';
    
  } else {
    $message = "Incorrect – Please identify the first and last letters correctly.";
    // Deduct the player's lives if makes mistake.
    $_SESSION['lives']--;
    // Verify if the player still has lives.
    if ($_SESSION['lives'] <= 0) {
      // Game Over and redifine the the lives to 6.
      $message .= " Game Over!";
      $tryAgainButton = '<button onclick="location.href=\'Question_1.php\'">Try again</button>';
      $_SESSION['lives'] = 6;
    }
  }
}
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Level 5: Identify the first and last letter</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">   
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/index.css">
</head>
<body>
<h1>Level 5</h1>
<h2>Identify the first and last letter</h2>


<?php if (!isset($tryAgainButton) && !isset($nextQuestionButton)) : ?>
<h4>Shuffled Letters:
<?php

// Shuffle the letters and store them in the session.
$shuffledLetters = shuffleLetters();
$_SESSION['shuffledLetters'] = $shuffledLetters; 
// Display the shuffled letters.
foreach ($shuffledLetters as $letter) {
  echo "$letter ";
}
?>
</h4>
<?php endif; ?>

<!-- Display the lives during the game. -->
<?php if (!isset($tryAgainButton)) : ?>
  <p>(Lives: <?php echo $_SESSION['lives']; ?>)</p>
<?php endif; ?>


<!-- Display output message. -->
<?php if (isset($message)) : ?>
  <p><?php echo $message; ?></p>
<?php endif; ?>

<!-- Display the buttons "Next Question" and "Try Again" in each situation. -->
<?php if (isset($nextQuestionButton)) echo $nextQuestionButton; ?>
<?php if (isset($tryAgainButton)) echo $tryAgainButton; ?>

<br><br> 

<!-- Display the form only during the game. -->
<?php if (!isset($tryAgainButton) && !isset($nextQuestionButton)) : ?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <label for="first_letter">First Letter:</label>
  <input type="text" id="first_letter" name="first_letter" maxlength="1" required><br><br>
  
  <label for="last_letter">Last Letter:</label>
  <input type="text" id="last_letter" name="last_letter" maxlength="1" required><br><br>
  
  <button type="submit">Submit</button>
</form>
<?php endif; ?>

</body>
</html>
