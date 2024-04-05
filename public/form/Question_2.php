<!DOCTYPE html>
<html>
<head>
    <title>Quiz Game</title>
</head>
<body>
    <h1>Question 2</h1>
    <form method="post" action="">
        <p>Question: Which planet is known as the "Red Planet"?</p>
        <input type="radio" name="answer" value="A"> A) Venus<br>
        <input type="radio" name="answer" value="B"> B) Jupter<br>
        <input type="radio" name="answer" value="C"> C) Mars<br><br>
        <input type="submit" name="submit" value="Submit">
        <button type="button" onclick="abandonGame()">Abandon Game</button>
    </form>
    <?php
    // Check if form is submitted
    if(isset($_POST['submit'])){
        // Correct answer
        $correct_answer = 'C';
        // User's answer
        $user_answer = $_POST['answer'];
        
        // Check if the answer is correct
        if($user_answer == $correct_answer){
            // Display congratulations image
            echo "<p>Congratulations! Your answer is correct.</p>";
            echo '<iframe src="https://giphy.com/embed/DKnMqdm9i980E" width="250" height="150" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><br>';
            // Offer to go to the next question
            echo '<a href="Question_3.php">Next Question</a>';
        } else {
            // Display apology image
            echo "<p>Sorry, your answer is incorrect.</p>";
            echo '<iframe src="https://giphy.com/embed/7SF5scGB2AFrgsXP63" width="250" height="150" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><br>';
        }
        
    }
    ?>
    <script>
    function abandonGame() {
        // Redirect to a page indicating the game has been abandoned
        window.location.href = "abandoned_game_page.php";
    }
    </script>
</body>
</html>
