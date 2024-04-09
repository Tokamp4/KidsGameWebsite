<!-- PHP -->
<?php
// Initialize the game with 6 lives if necessary.
session_start();
if (!isset($_SESSION['lives'])) {
  $_SESSION['lives'] = 6;
}

// Function to randomize the numbers.
function shuffleNumbers() {
  $numbers = range(0, 100); // Generate numbers from 0 to 100.
  shuffle($numbers);
  return array_slice($numbers, 0, 6); // Select 6 random numbers.
}

// Function to verify if user's numbers are correct and in order.
function checkAnswer($userNumbers, $shuffledNumbers) {
    rsort($shuffledNumbers); // Descending order.
    return $userNumbers === $shuffledNumbers;
}

// Verification if the form was submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the numbers from the player and convert to integers.
  $userNumbers = array_map('intval', $_POST['numbers']);

  // Get the shuffled numbers.
  $shuffledNumbers = $_SESSION['shuffledNumbers'];

  // Verify if the numbers are correct and in order.
  if (checkAnswer($userNumbers, $shuffledNumbers)) {
    $message = "Correct – Your numbers have been correctly ordered in descending order.";

    // Next question button.
    $nextQuestionButton = '<button onclick="location.href=\'Question_5.php\'">Next Question</button>';
    
  } else {
    $message = "Incorrect – Your numbers were not correctly arranged in descending order.";
    // Deduct the player's lives if makes mistake.
    $_SESSION['lives']--;
    // Verify if the player still has lives.
    if ($_SESSION['lives'] <= 0) {
      // Game Over and redefine the lives to 6.
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
<title>Level 4: Order the numbers in descending order</title>
<style>
/* This CSS is to hide the spinners. */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

</style>
</head>
<body>
<h1>Level 4</h1>
<h2>Order the numbers in descending order</h2>


<?php if (!isset($tryAgainButton) && !isset($nextQuestionButton)) : ?>
<h4>Shuffled Numbers:
<?php

// Shuffle the numbers and store them in the session.
$shuffledNumbers = shuffleNumbers();
$_SESSION['shuffledNumbers'] = $shuffledNumbers; 
// Display the shuffled numbers.
foreach ($shuffledNumbers as $number) {
  echo "$number ";
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
  <?php
  // Display input fields.
  for ($i = 0; $i < 6; $i++) {
    echo '<label for="number' . ($i + 1) . '">Number ' . ($i + 1) . ':</label>';
    echo '<input type="number" id="number' . ($i + 1) . '" name="numbers[]" required><br><br>';
  }
  ?>
  <button type="submit">Submit</button>
</form>
<?php endif; ?>

</body>
</html>
