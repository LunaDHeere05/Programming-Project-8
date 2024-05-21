<?php
$host = "dt5.ehb.be";
$dbname = "2324PROGPROJGR8";
$username = "2324PROGPROJGR8";
$password = "P!j6WD5KL";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Additional configuration or operations with the PDO object can be done here
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
