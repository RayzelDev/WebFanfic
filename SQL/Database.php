<?php
$servername = "127.0.0.1";
$username = "root";
$password = "46984698";
$database = "NeverlandDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>