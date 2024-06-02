<?php
$servername = "dt5.ehb.be"; // Change this to your database server
$username = "2324PROGPROJGR8"; // Change this to your database username
$password = "P!j6WD5KL"; // Change this to your database password
$database = "2324PROGPROJGR8"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


