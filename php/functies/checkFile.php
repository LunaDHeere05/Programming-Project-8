<?php
// Check if the function doesn't already exist
if (!function_exists('checkFile')) {
    // Define the checkFile function
    function checkFile() {
        $currentFile = basename($_SERVER["PHP_SELF"]);
        if($currentFile == "Home.php") { // Adjust the filename here if necessary
            return 'user';
        } else {
            return 'admin';
        }
    }
}
?>