<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="stylesheet.css">
<title>Profile</title>
 <div class="square" style = "  height: 600px;  width: 1800px;
background-color: #A3B5F3; position: absolute; top:100px; left:50px;"></div> 

<img src="./Images/snow.gif"  style = "position: absolute; top:30px; left:0px;" width="35%">
<img src="./Images/snow.gif"  style = "position: absolute; top:30px; left:500px;" width="35%">
<img src="./Images/snow.gif"  style = "position: absolute; top:30px; left:1200px;" width="35%">
<img src="./Images/avatarBubble.gif"  style = "position: absolute; top:300px; left:300px;" width="20%">

<style>
div{}

</style>
</head>
<body>


<div class="bg1"></div>

<input class="button" style = "position: absolute; top:150px; left:1400px;"onclick="location.href='rate.php';" value="Rate Anime" />
<input class="button" style = "position: absolute; top:250px; left:1400px;" onclick="location.href='quiz.php';" value="Quiz" />
<input class="button" style = "position: absolute; top:350px; left:1400px;"onclick="location.href='chat.php';" value="Chat" />
<input class="button" style = "position: absolute; top:450px; left:1400px;" onclick="location.href='shop.php';" value="Shop" />
<input class="button" style = "position: absolute; top:550px; left:1400px;" onclick="location.href='index.php';" value="Logout" />




<?php
    // includes the file to connect to the database
    include("connectdb.php"); 
    // starts a new or resumes an existing session
    session_start(); 

    // show a div element with class "welcomeCon"
    echo "<div class='welcomeCon'>"; 

    // checks if the 'logged' session variable is set then perform the specified actions
    if (isset($_SESSION['logged'])) {
      // displays the username of the logged-in user with Welcome message.
      echo "Welcome: " .$_SESSION['logged']; 
      // sets the value of $loggedinuser to the username of the logged-in user
      $loggedinuser = $_SESSION['logged']; 
      
      // SQL query to select data from the login table where username is the same as the logged-in user
      $sql = "SELECT * FROM login WHERE username='$loggedinuser'"; 
    // performs the SQL query on the database connection
      $result = mysqli_query($conn, $sql); 
      // fetches the result row as an associative array
      $row = mysqli_fetch_assoc($result); 
      // displays the user's XP points
      echo " ------Current XP Points: " . $row['xp']; 
      // closes the div element with class "welcomeCon"
      echo "</div>"; 
      // SQL query to select data from the purchases table where username is the same as the logged-in user
      $sql = "SELECT username, item FROM purchases WHERE username = '$loggedinuser'"; 
      // performs the SQL query on the database connection
      $result = $conn->query($sql); 

      // checks if there are any rows in the database with the user who purchases something
      if ($result->num_rows > 0) 
      { 
        echo "<div class='tableCon'>"; // displays a div element with class "tableCon"
        // displays a header for the purchases table
        echo "<h2>Purchases made by " . $loggedinuser . ":</h2>"; 
        // displays a table with headers
        echo "<table><tr><th>Username</th><th>Item</th></tr>"; 
        while ($row = $result->fetch_assoc()) { // loops through the result rows as associative arrays
          echo "<tr><td>" . $row["username"]. "</td><td>" . $row["item"]. "</td></tr>"; // displays the username and item in each row
        }
        echo "</table>";  
        echo "</div>";  
      } 
      else 
      {
        echo "No purchases found for " . $loggedinuser; // displays a message if no purchases are found for the user
      }
      // SQL query to select the username, gender, and image from the login 
      //and gender_image tables where the username is the same as the logged-in user
      $sql = "SELECT login.username, login.gender, gender_image.image
      FROM login
      INNER JOIN gender_image ON login.gender = gender_image.gender
      WHERE login.username='$loggedinuser'"; 

      $result = mysqli_query($conn, $sql); // performs the SQL query on the database connection
      $row = mysqli_fetch_assoc($result); // fetches the result row as an associative array

      // checks if the user's gender is female
      if ($row['gender'] == 'female') { 
        $image_path = "./Images/girl.png"; // sets the path for the female image
      } else {
        $image_path = "./Images/boy.png"; // sets the path for the male image
      }
      echo "<div class='avatarCon'>";  
      echo "<img src='" . $image_path . "' width='200' >"; // displays the user's avatar
    echo "</div>";
}
?>

<?php
    // $command = escapeshellcmd('python test.py');
    // $output = shell_exec($command);
    // echo $output;

    // chdir('C:\Users\zaina\Downloads\Documents\xampp\htdocs\AnimeAsylum\test.py');
// system('test.py');
// system('recommend_anime.py');
?>



<div class="welcomeCon" style="position: absolute; top:550px; left:100px;">

<p>Recommended Anime: Attack On Titan</p>
</div> 

<script> 




</script> 



</body>
</html>
