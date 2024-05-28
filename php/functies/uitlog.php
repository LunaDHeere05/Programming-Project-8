<?php
include '../sessionStart.php';
session_destroy();

//winkelmand leegmaken 
echo "<script>localStorage.removeItem('winkelmand');</script>";
header("Location: ../Home.php");
?>