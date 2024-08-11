<?php
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "voting";

// $conn = new mysqli($servername, $username, $password, $dbname);



// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

$connect = mysqli_connect("localhost", "root", "", "voting") or die("connection failed");

if($connect) { 
    echo 'Connection Success';
 }else {
     echo 'Connection Failed';
 }

?>
