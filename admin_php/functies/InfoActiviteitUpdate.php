<?php

include '../database.php';
include '../ftp_server.php';

if(isset($_POST['submit'])){
    $Act_title = $_POST['ActTitle'];
    $ActInfo = $_POST['ActInfo'];
    $Flyer = $_FILES['flyer'];
    $Date = $_POST['ActDate'];

    //if there is no row in the database, insert a new row
    $sql = "SELECT * FROM ACTIVITEIT WHERE Activiteit_id = 1";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {

        //upload the image to the server
        $file = $_FILES['flyer'];
        $ftpDirectory = '/www/images/';
        ftp_pasv($ftpConnection, true);

        if (ftp_put($ftpConnection, $ftpDirectory . $file['name'], $file['tmp_name'], FTP_BINARY)) {
            $fileUrl = 'http://www.ppgroep8.be/images/' . $file['name'];
        }

        $activiteitQuery = "INSERT INTO ACTIVITEIT (Activiteit_id, Act_Info, Act_Title, Datum) VALUES (1, '$ActInfo', '$Act_title', '$Date')";
        if ($conn->query($activiteitQuery) === TRUE) {
            $activiteit_id = $conn->insert_id;
        }
    }

    //Delete the old image from the server
    $sql = "SELECT Flyer FROM ACTIVITEIT WHERE Activiteit_id = 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $imageLink = $row['Flyer'];
        $imageLink = str_replace('http://www.ppgroep8.be/images/', '', $imageLink);
        ftp_delete($ftpConnection, $ftpDirectory . $imageLink);
    }

    //Upload the image to the server
    $file = $_FILES['flyer'];
    $ftpDirectory = '/www/images/';
    ftp_pasv($ftpConnection, true);

    if (ftp_put($ftpConnection, $ftpDirectory . $file['name'], $file['tmp_name'], FTP_BINARY)) {
        $fileUrl = 'http://www.ppgroep8.be/images/' . $file['name'];
    }

    $activiteitQuery = "UPDATE ACTIVITEIT SET Act_Info = '$ActInfo', flyer = '$fileUrl', Act_Title = '$Act_title', Datum = '$Date' WHERE Activiteit_id = 1";
    if ($conn->query($activiteitQuery) === TRUE) {
        $activiteit_id = $conn->insert_id;
    }

    $conn->close();
    ftp_close($ftpConnection);
    header("Location: ../Info.php");
    
}
    
