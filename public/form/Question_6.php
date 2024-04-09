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

// Function to verify if user's numbers are correct.
function checkAnswer($minNumber, $maxNumber, $shuffledNumbers) {
  sort($shuffledNumbers); // Sort shuffled numbers in ascending order.
  
  return $minNumber == $shuffledNumbers[0] && $maxNumber == $shuffledNumbers[5];
}

// Verification if the form was submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the numbers from the player and convert to integers.
  $minNumber = intval($_POST['min_number']);
  $maxNumber = intval($_POST['max_number']);

  // Get the shuffled numbers.
  $shuffledNumbers = $_SESSION['shuffledNumbers'];

  // Verify if the numbers are correct.
  if (checkAnswer($minNumber, $maxNumber, $shuffledNumbers)) {
    $message = "Correct – You identified the smallest and largest numbers correctly.";

    // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>NEED TO IMPLEMENT PLAY AGAIN.
    $nextQuestionButton = '<button onclick="location.href=\'Question_5.php\'">Play Again</button>';
    
  } else {
    $message = "Incorrect – Please identify the smallest and largest numbers correctly.";
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
<title>Level 6: Identify the smallest and largest number</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">   
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/index.css">
</head>
<body>
<h1>Level 6</h1>
<h2>Identify the smallest and largest number</h2>
<style>
/* This CSS is to hide the spinners. */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

</style>


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
  <label for="min_number">Smallest Number:</label>
  <input type="number" id="min_number" name="min_number" min="0" max="100" required><br><br>
  
  <label for="max_number">Largest Number:</label>
  <input type="number" id="max_number" name="max_number" min="0" max="100" required><br><br>
  
  <button type="submit">Submit</button>
</form>
<?php endif; ?>

</body>
</html>
