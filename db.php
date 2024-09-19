<?php
$servername = "localhost";
$username = "root";
$password = "minmoy@1234"; // Replace with your MySQL password
$dbname = "crud_app";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

