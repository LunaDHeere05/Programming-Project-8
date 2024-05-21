use PDOException; // Add this line to import the PDOException class
<?php
$host = "dt5.ehb.be";
$dbname = "2324PROGPROJGR8";
$username = "2324PROGPROJGR8";
$password = "P!j6WD5KL";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Log the error message
    error_log($e->getMessage(), 3, '/path/to/error.log');
    // Display a generic error message to the user
    echo "Connection failed. Please try again later.";
    exit;
}

// Validate and sanitize user input
$productId = isset($_GET['productId']) ? filter_var($_GET['productId'], FILTER_VALIDATE_INT) : null;

if ($productId === null) {
    echo 'Invalid product ID.';
    exit;
}

// Using Prepared Statements for Safe Queries: Selecting Data
try {
    $stmt = $pdo->prepare("SELECT id, name, inserted, size FROM products WHERE id = :id");
    $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) {
        echo 'ID: ' . htmlspecialchars($row['id']) . ' - Name: ' . htmlspecialchars($row['name']) . '<br>';
    }
} catch (PDOException $e) {
    error_log($e->getMessage(), 3, '/path/to/error.log');
    echo 'An error occurred while fetching data. Please try again later.';
}

// Inserting Data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? filter_var($_POST['name'], FILTER_SANITIZE_STRING) : null;
    $size = isset($_POST['size']) ? filter_var($_POST['size'], FILTER_VALIDATE_INT) : null;

    if ($name && $size !== null) {
        try {
            $stmt = $pdo->prepare("INSERT INTO products (name, size) VALUES (:name, :size)");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':size', $size, PDO::PARAM_INT);
            $stmt->execute();
            echo 'Product inserted successfully.';
        } catch (PDOException $e) {
            error_log($e->getMessage(), 3, '/path/to/error.log');
            echo 'An error occurred while inserting data. Please try again later.';
        }
    } else {
        echo 'Invalid input for name or size.';
    }
}
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Log the error message
    error_log($e->getMessage(), 3, '/path/to/error.log');
    // Display a generic error message to the user
    echo "Connection failed. Please try again later.";
    exit;
}
?>
<!-- //Als wachtwoord opgeslagen in database => hashen:

// // Example of password hashing (for registration) and verifying (for login)
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
//     $password = $_POST['password'];
//     $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
//     // Store $hashedPassword in the database
    
//     // During login
//     // Assume $storedHashedPassword is retrieved from the database for the given user
//     $storedHashedPassword = /* query to get hashed password from database */;

//     if (password_verify($password, $storedHashedPassword)) {
//         echo 'Login successful.';
//     } else {
//         echo 'Invalid password.';
//     }
// } -->
