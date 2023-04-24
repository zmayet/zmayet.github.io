<?php
//local database fields
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "animeasylum";

// establishing the connection with mysql
$conn = new mysqli($servername, $username, $password, $db_name);

// check if the connection was unsuccessful then show error message
if($conn->connect_error){
    die("Connection Failed".$conn->connect_error);
}
// echo an empty string
echo "";
 ?>