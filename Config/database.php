<?php

$host = 'localhost'; // Host name
$username = 'root';  // mysql username
$password = ''; // mysql password

$dbname = 'mydb'; // Database name


try{
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected succussfully";
} catch(PDOException $e){
        echo "Connection failed : " . $e->getMessage() ." - " . (int)$e->getCode();
    }


