<?php

include '../database.php';

    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $sql = "INSERT INTO UITLENING (uitleen_datum, inlever_datum) VALUES ('$start_date', '$end_date')";
    mysqli_query($conn, $sql);

    header("Location: ../ReservatieBevestigen.php"); 
    exit;

