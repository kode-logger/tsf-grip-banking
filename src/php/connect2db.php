<?php
// database details
$servername = "localhost";
$username = "<Enter your username>";
$password = "<Enter your password>";
$database = "<Enter your database name>";

$conn = new mysqli($servername, $username, $password, $database);

// if unable to establish a connection to database then display the error message and halt.
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
