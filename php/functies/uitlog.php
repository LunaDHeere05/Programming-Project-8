<?php
include '../sessionStart.php';
include '../database.php';


session_destroy();

header("Location: ../Home.php");
?>