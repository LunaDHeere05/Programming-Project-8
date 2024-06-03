<?php 
include '../database.php';
include '../sessionStart.php';

if(isset($gebruikersnaam)) {
    $query = "SELECT * FROM WINKELMAND_ITEMS wi
    JOIN WINKELMAND w ON w.winkelmand_id=wi.winkelmand_id 
    WHERE w.email = '$gebruikersnaam'";

    $result = mysqli_query($conn, $query);

    // Initialize session variable
    $_SESSION['reservering_info'] = [];

    while($row = mysqli_fetch_assoc($result)) {   
        $aantal = $row['aantal'];
        $item_id = $row['item_id'];
        $uitleen_datum = $row['uitleen_datum'];
        $inlever_datum = $row['inlever_datum'];

        $vrijeExemplaren = "SELECT ei.exemplaar_item_id
        FROM EXEMPLAAR_ITEM ei
        WHERE ei.item_id = $item_id
        AND NOT EXISTS (
            SELECT 1
            FROM UITLENING u 
            WHERE u.exemplaar_item_id = ei.exemplaar_item_id
            AND (
                (u.uitleen_datum <= '$uitleen_datum' AND u.inlever_datum >= '$inlever_datum')
                OR (u.uitleen_datum >= '$uitleen_datum' AND u.uitleen_datum < '$inlever_datum')
                OR (u.inlever_datum <= '$inlever_datum' AND u.inlever_datum > '$uitleen_datum')
                )
            )
        AND ei.zichtbaarheid = 1
        LIMIT $aantal";

        $vrijeExemplaren_result = mysqli_query($conn, $vrijeExemplaren);

        if(mysqli_num_rows($vrijeExemplaren_result) == $aantal) {
            while ($exemplaren_row = mysqli_fetch_assoc($vrijeExemplaren_result)) {
                $exemplaar_item_id = $exemplaren_row['exemplaar_item_id'];

                $uitgeleendItem = "INSERT INTO UITLENING (email, exemplaar_item_id, uitleen_datum, inlever_datum) 
                VALUES ('$gebruikersnaam', '$exemplaar_item_id', '$uitleen_datum', '$inlever_datum')";

                if (mysqli_query($conn, $uitgeleendItem)) {
                    $uitleen_id = mysqli_insert_id($conn);

                    $_SESSION['reservering_info'][] = [
                        'uitleen_id' => $uitleen_id
                    ];
                } else {
                    echo "Error inserting row into UITLENING: " . mysqli_error($conn);
                    exit;
                }
            }
        } else {
            echo 'Dit item is intussen al uitgeleend, sorry.';
            exit;
        }
    }

    // Reset winkelmand
    $query = "DELETE wi FROM WINKELMAND_ITEMS wi
    JOIN WINKELMAND w ON w.winkelmand_id=wi.winkelmand_id 
    WHERE w.email = '$gebruikersnaam'";
    $result = mysqli_query($conn, $query);

    header("Location: ../FinalBevestigingReservatie.php");
    exit;
} else {
    echo "<script>
        window.location.href = '../Home.php';
    </script>";
}
?>
