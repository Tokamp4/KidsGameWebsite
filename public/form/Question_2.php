<!-- PHP -->
<?php
session_start();

// Initialize the game with 6 lives if necessary.
if (!isset($_SESSION['lives'])) {
  $_SESSION['lives'] = 6;
}

// Function to randomize the letters.
function shuffleLetters() {
  $letters = range('Z', 'A'); // Changed to shuffle in descending order
  shuffle($letters);
  return array_slice($letters, 0, 6);
}

// Function to check if the player's letters are correct and in descending order.
function checkAnswer($userLetters, $shuffledLetters) {
    foreach ($userLetters as $userLetter) {
    if (!in_array(strtoupper($userLetter), $shuffledLetters)) {
      return false;
    }
  }
  
  $sortedLetters = $userLetters;
  rsort($sortedLetters); // Changed to check descending order
  return $userLetters === $sortedLetters;
}

// Check if the form was submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the letters from the player.
  $userLetters = $_POST['letters'];

  // Get the shuffled letters.
  $shuffledLetters = $_SESSION['shuffledLetters'];

  // Check if the letters are correct and in descending order.
  if (checkAnswer($userLetters, $shuffledLetters)) {
    $message = "Correct – Your letters have been correctly ordered in descending order.";
    
    // Next question button.
    $nextQuestionButton = '<button onclick="location.href=\'Question_3.php\'">Next Question</button>';

  } else {
    $message = "Incorrect – Your letters were not correctly arranged in descending order or you entered a letter that was not shown.";
    // Deduct the player's lives if makes mistake.
    $_SESSION['lives']--;
    // Verify if the player still has lives.
    if ($_SESSION['lives'] <= 0) {
      // Game Over and redefine the lives to 6.
      $message .= " Game Over!";
      $tryAgainButton = '<button onclick="location.href=\'Question_1.php\'">Try Again</button>';
      $_SESSION['lives'] = 6;
    }
  }
}

// Shuffle the letters and store them in the session.
$_SESSION['shuffledLetters'] = shuffleLetters();
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Level 2: Order the letters in descending order</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/index.css">
</head>
<body>
<h1>Level 2</h1>
<h2>Order the letters in descending order</h2>

<?php if (!isset($tryAgainButton) && !isset($nextQuestionButton)) : ?>
<h4>Shuffled Letters:
<?php
// Display the shuffled letters.
foreach ($_SESSION['shuffledLetters'] as $letter) {
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

<!-- Display the "Next Question" and "Try Again" buttons in each situation. -->
<?php if (isset($nextQuestionButton)) echo $nextQuestionButton; ?>
<?php if (isset($tryAgainButton)) echo $tryAgainButton; ?>

<br><br> 

<!-- Display the form only during the game. -->
<?php if (!isset($tryAgainButton) && !isset($nextQuestionButton)) : ?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <?php
  // Display input fields.
  for ($i = 0; $i < 6; $i++) {
    echo '<label for="letter' . ($i + 1) . '">Letter ' . ($i + 1) . ':</label>';
    echo '<input type="text" id="letter' . ($i + 1) . '" name="letters[]" maxlength="1" required><br><br>';
  }
  ?>
  <button type="submit">Submit</button>
</form>
<?php endif; ?>

</body>
</html>
