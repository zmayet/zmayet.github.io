<?php

// include a PHP file to connect to the database
include("connectdb.php");

// start a session
session_start();

// display a welcome message if the user session is logged in
echo "<div class='welcomeCon'>";
if (isset($_SESSION['logged'])) {
  echo "Welcome: " .$_SESSION['logged'];
}

// if the user is logged in, display their current XP points
if (isset($_SESSION["logged"])) {
  $loggedinuser = $_SESSION['logged'];
  $sql = "SELECT * FROM login WHERE username='$loggedinuser'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  echo "------Your current XP points: " . $row['xp'];
}

echo "</div>";

// Update the user's XP points in the database in case the "addxp" form is submitted.
if (isset($_POST['addxp'])) {
  $username = $_SESSION['logged'];
  $current_count = $row['xp'];
  $new_count = $current_count + 5;
  $sql = "UPDATE login SET xp = xp + 5 WHERE username = '$username'";
  mysqli_query($conn, $sql);
  echo "XP added successfully!";

  // To avoid form resubmission, route the user to the same page.
  header("HTTP/1.1 303 See Other");
  header("Location: " . $_SERVER['PHP_SELF']);
  exit();
}

?>



<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="stylesheet.css">
<title>Quiz</title>

<script>
  // Set the countdown duration in seconds
  const countdownDuration = 59; // 2 minutes in seconds

  // Set the countdown end time
  const countdownEndTime = new Date().getTime() + countdownDuration * 1000;

  // Update the countdown every second
  const countdownInterval = setInterval(function() {
    // Get the current time
    const now = new Date().getTime();

    // Calculate the remaining time in seconds
    const remainingTime = Math.floor((countdownEndTime - now) / 1000);

    // Output the result in an element with id="demo"
    const countdownElement = document.getElementById("demo");
    countdownElement.innerHTML = `<span style="position: absolute; top:250px; left:800px;">Time remaining: <span style="color:red">${remainingTime} seconds</span>`;


    // If the countdown is over, display a message and refresh the page when the message is closed
    if (remainingTime <= 0) {
      clearInterval(countdownInterval);
      countdownElement.innerHTML = "Time's up!";
      alert("Time's up!");
      location.reload();
    }
  }, 1000);
</script>
</head>
<body>



<div class="bg"></div>
<img src="./Images/quizBubble.gif"  style = "position: absolute; top:100px; left:1000px;" width="40%">

<input class="button" style = "position: absolute; top:250px; left:200px;"onclick="location.href='profile.php';" value="Profile" /> 
<input class="button" style = "position: absolute; top:350px; left:200px;" onclick="location.href='rate.php';" value="Rate" />
<input class="button" style = "position: absolute; top:450px; left:200px;"onclick="location.href='chat.php';" value="Chat" />
<input class="button" style = "position: absolute; top:550px; left:200px;" onclick="location.href='shop.php';" value="Shop" />
<input class="button" style = "position: absolute; top:650px; left:200px;" onclick="location.href='index.php';" value="Logout" />


<p id="demo"></p>

<form method="POST" >
  <input style = "position: absolute; top:300px; left:0px;"class = "button" type="submit" name="addxp" value="Add 5 XP">
</form>

<div class="quiz-container" id="quiz">
    <div class="quiz-header">
      <h2 id="question">Question Text</h2>
      <ul>
        <li>
          <input type="radio" name="answer" id="a" class="answer">
          <label for="a" id="a_text">Answer</label>
        </li>
        <li>
          <input type="radio" name="answer" id="b" class="answer">
          <label for="b" id="b_text">Answer</label>
        </li>
        <li>
          <input type="radio" name="answer" id="c" class="answer">
          <label for="c" id="c_text">Answer</label>
        </li>
        <li>
          <input type="radio" name="answer" id="d" class="answer">
          <label for="d" id="d_text">Answer</label>
        </li>
      </ul>
    </div>
    <button class = "button" id="submit">Submit</button>
  </div>


 

<script>



    const quizData = [
    {
        question: "Which Japanese film studio began in 1985?",
        a: "Madhouse",
        b: "Wizz",
        c: "Mappa",
        d: "Studio Ghibli",
        correct: "d",
    },
    {
        question: "Who sang 'Gurenge' from Demon Slayer?",
        a: "MISA",
        b: "LISA",
        c: "MIMI",
        d: "LUCY",
        correct: "b",
    },
    {
        question: "I'll take a ______ and eat it ?",
        a: "Potato Chip",
        b: "Carrot Stick",
        c: "Mushroom",
        d: "Pineapple",
        correct: "a",
    },
    {
        question: "What is Naruto's favourite dish?",
        a: "Meat",
        b: "Ramen",
        c: "Rice",
        d: "Curry",
        correct: "b",
    },
];
const quiz= document.getElementById('quiz')
const answerEls = document.querySelectorAll('.answer')
const questionEl = document.getElementById('question')
const a_text = document.getElementById('a_text')
const b_text = document.getElementById('b_text')
const c_text = document.getElementById('c_text')
const d_text = document.getElementById('d_text')
const submitBtn = document.getElementById('submit')
let currentQuiz = 0
let score = 0
loadQuiz()
function loadQuiz() {
    deselectAnswers()
    const currentQuizData = quizData[currentQuiz]
    questionEl.innerText = currentQuizData.question
    a_text.innerText = currentQuizData.a
    b_text.innerText = currentQuizData.b
    c_text.innerText = currentQuizData.c
    d_text.innerText = currentQuizData.d
}
function deselectAnswers() {
    answerEls.forEach(answerEl => answerEl.checked = false)
}
function getSelected() {
    let answer
    answerEls.forEach(answerEl => {
        if(answerEl.checked) {
            answer = answerEl.id
        }
    })
    return answer
}
submitBtn.addEventListener('click', () => {
    const answer = getSelected()
    if(answer) {
       if(answer === quizData[currentQuiz].correct) {
           score++
       }
       currentQuiz++
       if(currentQuiz < quizData.length) {
           loadQuiz()
       } else {
           quiz.innerHTML = `
           <h2>You answered ${score}/${quizData.length} questions correctly</h2>
           <button class = "button" type = "reload" onclick="location.reload()">Reload</button>
           `
       }
    }
})




</script>
<style>

	</style>










<style> 

</style>

</body>
</html>
