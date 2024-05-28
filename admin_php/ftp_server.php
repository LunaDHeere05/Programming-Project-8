<?php

$ftpServer = 'ftp.ppgroep8be.webhosting.be';
$ftpUsername = 'ppgroep8@ppgroep8be';
$ftpPassword = 'PPgroep82024';
$ftpDirectory = '/www/images/';

$ftpConnection = ftp_connect($ftpServer);// Connect to the server

if ($ftpConnection === false) { // check if you are connected to the server
    die('Error: Could not connect to FTP server.');
}

$login = ftp_login($ftpConnection, $ftpUsername, $ftpPassword); // login to the server

if ($login === false) { // check if you are logged in
    die('Error: Could not log in to FTP server.');
}