<?php
include("connectdb.php");

session_start();

if(isset($_POST['submit'])) {
  // Retrieve user input
  $username = $_POST['username'];
  $password = hash('sha256',$_POST['password']);
  $gender = $_POST['gender'];

  // Check if the username already exists in the database
  $query = "SELECT * FROM login WHERE username = '$username'";
  $result = mysqli_query($conn, $query);
  $count = mysqli_num_rows($result);

  if($count == 0) {
    // If the username does not already exist, insert the new user's information into the database
    $query = "INSERT INTO login (username, password, gender) VALUES ('$username', '$password', '$gender')";
    $result = mysqli_query($conn, $query);

    if($result) {
      // If the insert was successful, log the user in and redirect to the profile page
      $_SESSION['logged'] = $username;
      header("Location: profile.php");
    } else {
      // If the insert failed, display an error message
      echo "Error: " . mysqli_error($conn);
    }
  } else {
    // If the username already exists, display an error message
    echo "Username already exists.";
  }
}

?>


<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="stylesheet.css">

<style>
</style>


</head>
<body>

<div class="bg"></div>

<form action="register.php" method="post">  
  <div class="container_">   
  <img src="./Images/registrationBubble.gif"  alt="Cat" width="80%"> <br>
    <label>Enter A Username : </label>   
    <input type="text" placeholder="###" name="username" required>  

    <label>Enter A Password : </label>   
    <input type="password" placeholder="###" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"required>  

    <p>Are you male or female?:</p>
    <input type="radio" id="male" name="gender" value="male">
    <label for="html">Male</label><br>
    <input type="radio" id="female" name="gender" value="female">
    <label for="css">Female</label><br>

    <button class="button"name="submit" type="submit">Register</button>   

    <button type="button"  style = "position: absolute; top:500px; left:200px; " onclick="location.href='index.php';"class="button"> Cancel</button>   

    
    <img src="./Images/neccoHappy.gif"  style = "position: absolute; top:400px; left:400px; "alt="Cat" width="20%">

  </div>   
    
</form>     

</body>
</html>