<?php
// include the database connection file
include("connectdb.php");

// start session
session_start();

// check if the form is submitted we used POST here as it is confidential data of form
if(isset($_POST['submit'])){

    // retrieve the user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    //retrieve the username and password and check if they exist in database and store result in 
    //count variable as if someone exists in database then there will be atleast one record of that person
    $sql = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    // if the user exists and the password is correct, set the session variable and redirect to the profile page
    if($count == 1){
        $_SESSION['logged'] = $username;
        header("Location: profile.php");
    }
    else{
        // otherwise if the user doesn't exist or the password is incorrect
        // show error messages
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="stylesheet.css">
</head>
<body>

<div class="bg"></div>
 
</head>
<body style="text-align:center">



<div class="popup" onclick="myFunction()" style="top: 515px;left:970px">Help?
  <span class="popuptext" id="myPopup">Enter your credentials to login in!</span>
</div>

<script>
// When the user clicks on div the popup whose id=myPopup will be displayed
function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}
</script>



<form action = "login.php" method = "post" style="top: 150px;left:600px"style="  display: flex;
justify-content:space-evenly;
align-items: center;" class="form1" >  
    <div class="container_" >   
    <!-- <label>Enter your login details </label>   <br> -->
    <img src="./Images/loginBubble.gif"  alt="Cat" width="80%"> <br>
        <label>Username : </label>   
        <input type="text" placeholder="###" name="username" required>  
        <label>Password : </label>   
        <input type="password" placeholder="###" name="password" required>  

        <button class="button"name="submit"type="submit">Login</button>   
 
        <button  style = "position: absolute; top:331px; left:301px;" class="button"type="button" onclick="location.href='index.php';" class="cancelbtn"> Cancel</button>   

        <img src="./Images/neccoHappy.gif"  style = "position: absolute; top:400px; left:20px; "alt="Cat" width="20%">
    </div>   

</form>     




</body>
</html>
