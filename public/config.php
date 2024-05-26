<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "db_sispak";
$PORT = 3307;

$conn = new mysqli($host, $username, $password, $database, $PORT);

if($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
}

?>