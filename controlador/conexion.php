<?php
$servername = "localhost";
$username = "root";

try {
    $conn = new PDO("mysql:host=$servername;dbname=express-sale-bd", $username, '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>