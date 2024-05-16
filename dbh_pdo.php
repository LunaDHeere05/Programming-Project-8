<?php
// Database configuration
$host = 'dt5.ehb.be'; // Database server name
$dbname = '2324PROGPROJGR8'; // Database name
$username = '2324PROGPROJGR8'; // Database username
$password = 'P!j6WD5KL'; // Database password

try {
    // Connect to the database using PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Optionally, set other PDO attributes here
} catch (PDOException $e) {
    // If connection fails, display an error message
    die("Failed to connect to the database: " . $e->getMessage());
}
?>
