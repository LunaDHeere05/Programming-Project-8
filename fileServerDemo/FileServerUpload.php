<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ftpServer = 'ftp.ppgroep8be.webhosting.be';
    $ftpUsername = 'ppgroep8@ppgroep8be';
    $ftpPassword = 'PPgroep82024';
    $ftpDirectory = '/www/images/';

    $file = $_FILES['fileToUpload'];

    $ftpConnection = ftp_connect($ftpServer);

if ($ftpConnection === false) {
    die('Error: Could not connect to FTP server.');
}

$login = ftp_login($ftpConnection, $ftpUsername, $ftpPassword);

if ($login === false) {
    die('Error: Could not log in to FTP server.');
}

ftp_pasv($ftpConnection, true);

    if (ftp_put($ftpConnection, $ftpDirectory . $file['name'], $file['tmp_name'], FTP_BINARY)) {
        echo 'File uploaded successfully to FTP server.';
    } else {
        echo 'Error uploading file to FTP server.';
    }

    ftp_close($ftpConnection);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>File Upload to FTP Server</title>
</head>
<body>
    <h1>File Upload to FTP Server</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>