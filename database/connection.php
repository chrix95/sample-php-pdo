<?php
// define connection variables
$host = "localhost";
$dbname = "symphart";
$username = "root";
$password = "";

$connection_string = "mysql:host=".$host.";dbname=".$dbname;

try {
    $conn = new PDO($connection_string, $username, $password);
    // echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}