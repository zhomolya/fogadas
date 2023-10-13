<?php
session_start();

if($_SESSION["gok"]=="vau"){
  //  echo("Belépve<br>");
}else{
    header("Location: index.php");
    exit;
}

//$servername = "localhost"; // Replace with your MySQL server hostname or IP address
//$username = "id21349287_zotogemunka"; // Replace with your MySQL username
//$password = "20040212ZOli!"; // Replace with your MySQL password
//$database = "id21349287_zotogemunka"; // Replace with the name of your MySQL database

$servername = "localhost"; // Replace with your MySQL server hostname or IP address
$username = "root"; // Replace with your MySQL usernam
$password = ""; // Replace with your MySQL password
$database = "fogadas"; // Replace with the name of your MySQL database


$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
   // echo "Connected successfully<br>";
}

// Perform your database operations here

// Close the connection when you're done




?>