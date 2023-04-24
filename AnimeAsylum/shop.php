<?php

// includes the file that contains the code to connect to the database
include("connectdb.php"); 

// starts a new or resumes an existing session
session_start(); 

// starts a div with the class 'welcomeCon'
echo "<div class='welcomeCon'>"; 
// checks if the session variable 'logged' is set means if the user is logged in
if (isset($_SESSION['logged'])){ 
  // displays the username of the logged in user with a welcome message
  echo "Welcome: " .$_SESSION['logged']; 
}

// checks if the session variable 'logged' is set
if (isset($_SESSION["logged"])) {
  $loggedinuser = $_SESSION['logged'];
  // A database query to selects all data from the 'login' table where the username matches the logged in user's username
  $sql = "SELECT * FROM login WHERE username='$loggedinuser'"; 
  // executing a query on the database
  $result = mysqli_query($conn, $sql); 
  // fetching a result row as an associative array
  $row = mysqli_fetch_assoc($result);
  // displays the user's current XP points
  echo "------Your current XP points: " . $row['xp']; 
}
echo "</div>"; // ends the div

// checks if the form with name 'subxp' has been submitted
if (isset($_POST['subxp'])) { 
    $username = $_SESSION['logged'];
    $current_count = $row['xp'];
    // checks if the user's XP points is greater than 0
    if ($current_count > 0) { 
      // subtracts 5 XP points from the user's current count
        $new_count = $current_count - 5; 
        // 'login' table is updated to deduct 5 XP points from the user's total.
        $sql = "UPDATE login SET xp = xp - 5 WHERE username = '$username'"; 
        // updates the table by running a query on the database.
        mysqli_query($conn, $sql);
        echo "XP subtracted successfully!";


        // Add code to the purchases table to store the picture name.
        // sets the image's name for the 'purchases' table
        $image_name = 'hat'; 
        // adds the username and image name to the table called "purchases"
        $sql = "INSERT INTO purchases (username, item) VALUES ('$username', '$image_name')";
        // executing a query on the database
        mysqli_query($conn, $sql); 
    } 
    //if No enough XP then show error message
    else {
        echo "You do not have enough XP to subtract.";
    } 

// To avoid form resubmission, route the user to the same page.
header("HTTP/1.1 303 See Other");
// redirects the user to the same page
header("Location: " . $_SERVER['PHP_SELF']); 
// terminates the current script
exit();

  }

?>

<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="stylesheet.css">
<title>Shop</title> 


<img src="./Images/shelf.png"  style="position: absolute; top: 50px; left: 800px;" width="40%">
<img src="./Images/hat.png" alt="Hat" style="position: absolute; top: 130px; left: 900px;" width="10%">
<img src="./Images/cup.png"  style="position: absolute; top: 350px; left: 1050px;" width="10%">
<img src="./Images/soldout.png"  style="position: absolute; top: 400px; left: 1050px;" width="10%">
<img src="./Images/sword.png"  style="position: absolute; top: 600px; left: 1200px;" width="10%">
<img src="./Images/soldout.png"  style="position: absolute; top: 650px; left: 1200px;" width="10%">
<img src="./Images/plant.gif"  style="position: absolute; top: 90px; left: 1200px;" width="10%">
<img src="./Images/plant.gif"  style="position: absolute; top: 550px; left: 900px;" width="10%">
<form method="POST" style = "position: absolute; top:-30px; left:700px;">
<input  class = "button" style="position: absolute; top: 250px; left: 220px;" type="submit"  onclick= name="subxp" value="Buy 5 XP" >

<!-- <button type="button" style = "position: absolute; top:270px; left:230px;" class="buy"> Buy 5 XP</button>    -->
</form>  
<script> 

function tyMessage() {
  alert("Thank you buying this item ^_^,");
}
</script>

</head>
<body>

<div class="bg"></div>
<input class="button" style = "position: absolute; top:250px; left:200px;"onclick="location.href='profile.php';" value="Profile" /> 
<input class="button" style = "position: absolute; top:350px; left:200px;" onclick="location.href='rate.php';" value="Rate" />
<input class="button" style = "position: absolute; top:450px; left:200px;"onclick="location.href='quiz.php';" value="Quiz" />
<input class="button" style = "position: absolute; top:550px; left:200px;" onclick="location.href='chat.php';" value="Chat" />
<input class="button" style = "position: absolute; top:650px; left:200px;" onclick="location.href='index.php';" value="Logout" />
 


</body>
</html>
