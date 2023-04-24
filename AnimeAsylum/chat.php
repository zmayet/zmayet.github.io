<?php
// include the database connection file
include("connectdb.php");

// start the session
session_start();

// create a div with class 'welcomeCon'
echo "<div class='welcomeCon'>";

//if user is logged in then display their username
if (isset($_SESSION['logged'])){
  echo "Welcome: " .$_SESSION['logged'];
}

// if the user is logged in then display their XP points
if (isset($_SESSION["logged"])) {
  $loggedinuser = $_SESSION['logged'];
  $sql = "SELECT * FROM login WHERE username='$loggedinuser'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  echo "------Your current XP points: " . $row['xp'];
}

// closing div
echo "</div>";

// check if the form is submitted we used POST here as it is confidential data of form
if (isset($_POST['submit']) && isset($_POST['text'])) {
  // retrieve the user input
  $username = $_SESSION['logged'];
  $text = mysqli_real_escape_string($conn, $_POST['text']);

  // insert the user input which are username and text into the messages table
  $sql = "INSERT INTO messages (username, text) VALUES ('$username', '$text')";
  //if message added successfully show the success echo
  if (mysqli_query($conn, $sql)) {
    echo "Message added successfully!";
  } 
  //otherwise show the sql error/exception
  else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  // redirect the user to the same page to prevent form resubmission
  header("HTTP/1.1 303 See Other");
  header("Location: " . $_SERVER['PHP_SELF']);
  exit();
}

// check if the request method is GET rather then post as it is not a form to be submitted
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  // retrieve data that are username and text columns from the database 
  $sql = "SELECT username, text FROM messages";
  $result = mysqli_query($conn, $sql);

  // create a div with class 'chatCon'
  echo "<div class='chatCon'>";

  // display messages
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<p><strong>" . $row['username'] . ":</strong> " . $row['text'] . "</p>";
  }

  // close the div
  echo "</div>";
}

// close the database connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="stylesheet.css">
<title>Chat</title>

<!-- Start of Async Drift Code -->
<script>
    "use strict";
    
    !function() {
      var t = window.driftt = window.drift = window.driftt || [];
      if (!t.init) {
        if (t.invoked) return void (window.console && console.error && console.error("Drift snippet included twice."));
        t.invoked = !0, t.methods = [ "identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on" ], 
        t.factory = function(e) {
          return function() {
            var n = Array.prototype.slice.call(arguments);
            return n.unshift(e), t.push(n), t;
          };
        }, t.methods.forEach(function(e) {
          t[e] = t.factory(e);
        }), t.load = function(t) {
          var e = 3e5, n = Math.ceil(new Date() / e) * e, o = document.createElement("script");
          o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + n + "/" + t + ".js";
          var i = document.getElementsByTagName("script")[0];
          i.parentNode.insertBefore(o, i);
        };
      }
    }();
    drift.SNIPPET_VERSION = '0.3.1';
    drift.load('3kia45czekvp');
    </script>
    <!-- End of Async Drift Code -->
</head>
<body>

<div class="bg"></div>

<input class="button" style = "position: absolute; top:250px; left:200px;"onclick="location.href='profile.php';" value="Profile" /> 
<input class="button" style = "position: absolute; top:350px; left:200px;" onclick="location.href='rate.php';" value="Rate" />
<input class="button" style = "position: absolute; top:450px; left:200px;"onclick="location.href='quiz.php';" value="Quiz" />
<input class="button" style = "position: absolute; top:550px; left:200px;" onclick="location.href='shop.php';" value="Shop" />
<input class="button" style = "position: absolute; top:650px; left:200px;" onclick="location.href='index.php';" value="Logout" />

<form style = "position: absolute; top:300px; left:400px;" class = "welcomeCon" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <label for="text">Message:</label>
        <textarea name="text" rows="5" cols="30" required></textarea><br><br>

        <input class = "button" type="submit" name="submit" value="Submit">
    </form>

</form>



</body>
</html>