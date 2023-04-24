<?php

// include database connection script
include("connectdb.php");

// start session
session_start();

// display welcome message if user is logged in
echo "<div class='welcomeCon'>";
if (isset($_SESSION['logged'])){
  echo "Welcome: " .$_SESSION['logged'];
}

// if the user is logged in, display their current XP points.
if (isset($_SESSION["logged"])) {
  $loggedinuser = $_SESSION['logged'];
  $sql = "SELECT * FROM login WHERE username='$loggedinuser'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  echo "------Your current XP points: " . $row['xp'];
}

// closing tag of welcome message div
echo "</div>";

// handle form submission when user submits a rating
if (isset($_POST['rating'])) {
  $rating = $_POST['rating'];
  $movie = 'Anime';
  $username = $_SESSION['logged'];

  // insert rating into database
  $sql = "INSERT INTO ratings (username, movie, rating) VALUES ('$username', '$movie', '$rating')";
  mysqli_query($conn, $sql);

  // the user's account will receive 5 XP points if the rating was applied correctly.
  if (mysqli_affected_rows($conn) > 0) {
    $sql = "UPDATE login SET xp = xp + 5 WHERE username='$loggedinuser'";
    mysqli_query($conn, $sql);
  }

  // To avoid form resubmission, guide the user back to the original page.
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

<title>Rate</title>
<style>
</style>


</head>
<body>



<div class="bg"></div>

<input class="button" style = "position: absolute; top:250px; left:200px;"onclick="location.href='profile.php';" value="Profile" /> 
<input class="button" style = "position: absolute; top:350px; left:200px;" onclick="location.href='quiz.php';" value="Quiz" />
<input class="button" style = "position: absolute; top:450px; left:200px;"onclick="location.href='chat.php';" value="Chat" />
<input class="button" style = "position: absolute; top:550px; left:200px;" onclick="location.href='shop.php';" value="Shop" />
<input class="button" style = "position: absolute; top:650px; left:200px;" onclick="location.href='index.php';" value="Logout" />

<img src="./Images/rateBubble.gif"  style = "position: absolute; top:100px; left:1000px;" width="40%">
<div class="center">
  <input type="checkbox" id="click" >
  <label for="click" style = "position: absolute; top:730px; left:870px;"class="button">Rate </label>
  <div class="content">
    <div class="text">
      Rating 
   </div>
      <label for="click" id="temp">x</label>

  <form method="post" class="form1" style="top: 92px;
  left: -154px;background-color:aliceblue">
  <input type="hidden" name="rating" id="rating-input" value="">

      <label for="message">What would you rate this anime?</label>

      <div class="review">
  <h2>Rate the movie:</h2>
  <div class="rating">
    <span class="star" data-rating="1"></span>
    <span class="star" data-rating="2"></span>
    <span class="star" data-rating="3"></span>
    <span class="star" data-rating="4"></span>
    <span class="star" data-rating="5"></span>
  </div>
  <button class = "button" style = "position: absolute; top:250px; left:100px;" onclick="submitReview()">Submit</button>
</div>
  </form>
    </div>
  </div>
</div>

<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 4</div>
  <img src="./Images/COTW.jpg" style="width:100%">
  <div class="text">Corner Of This World</div>

</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 4</div>
  <img src="./Images/FOF.jpg" style="width:100%">
  <div class="text">Forest Of Fireflies</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 4</div>
  <img src="./Images/HMC.jpg" style="width:100%">
  <div class="text">Howls Moving Castle</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">4 / 4</div>
  <img src="./Images/SA.jpg" style="width:100%">
  <div class="text">Spirited Away</div>
</div>



<a class="prev" onclick="plusSlides(-1)">❮</a>
<a class="next" onclick="plusSlides(1)">❯</a>

</div>
<br>

<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>
<script> 

// Get all star elements
const stars = document.querySelectorAll('.star');

// Add click event listener to each star
stars.forEach((star) => {
  star.addEventListener('click', () => {
    // Remove active class from all stars
    stars.forEach((s) => {
      s.classList.remove('active');
    });
    // Add active class to the star that was clicked and all earlier stars
    star.classList.add('active');
    let prev = star.previousElementSibling;
    while (prev) {
      prev.classList.add('active');
      prev = prev.previousElementSibling;
    }
        // Set the hidden input value to the chosen rating.
        const ratingInput = document.getElementById('rating-input');
    ratingInput.value = star.dataset.rating;
  });
});
//Create the submitReview function, which will be invoked when the user submits the review form.
function submitReview() {
      // Get the rating input field element
      const ratingInput = document.getElementById('rating-input');
      // Obtain the rating input field's value.
      const rating = ratingInput.value;

      // Get the form element
      const form = document.querySelector('form');
      // Submit the form
      form.submit();
}

// Set the initial slide index to 1
let slideIndex = 1;
// Show the first slide
showSlides(slideIndex);

// Create the plusSlides function, which accepts the input n (1 or -1).
function plusSlides(n) {
// Use the current slide index + n when calling the showSlides method.
showSlides(slideIndex += n);
}

// Create the currentSlide function, which accepts the input n (the slide number).
function currentSlide(n) {
    // With the current slide index set to n, call the showSlides method.
    showSlides(slideIndex = n);
}

// Create the function showSlides, which accepts the input n (the slide number).
function showSlides(n) {
      let i;
      // Get all slide elements
      let slides = document.getElementsByClassName("mySlides");
      // Get all dot elements
      let dots = document.getElementsByClassName("dot");

      //Slide index should be set to 1 if it exceeds the number of slides.
      if (n > slides.length) {slideIndex = 1}

      // If the slide index is less than 1, set the slide index to the last slide
      if (n < 1) {slideIndex = slides.length}

      // Loop through all slide elements and hide them
      for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
      }
      // Loop through all dot elements and replace the "active" class with ""/no class
      for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
      }
      // Display the current slide and add the "active" class to the corresponding dot element
      slides[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " active";
}
</script>
 


</body>
</html>