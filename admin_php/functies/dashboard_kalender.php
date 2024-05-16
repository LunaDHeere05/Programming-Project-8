<?php
include 'database.php';

$deze_maand = date('N');
$deze_dag = date('j');
$dit_jaar = date('Y');

$dagenIndeMaand = cal_days_in_month(CAL_GREGORIAN, $deze_maand, $dit_jaar);
for($day=1; $day <= $dagenIndeMaand; $day++){
    $dayOfWeek = date('N', strtotime("$currentYear-$currentMonth-$day"));
    if ($dayOfWeek == 1 || $dayOfWeek == 4 || $dayOfWeek == 5) {
        echo "<li><h3>$day</h3></li>";
    } else {
        echo "<li><h3>$day</h3></li>";
    }
}
?>