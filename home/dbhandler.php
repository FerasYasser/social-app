<?php

$host = "localhost";
$user="root";
$password = "";
$dbname = "registration";

//connection to server
$connect = mysqli_connect($host,$user,$password,$dbname);
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}

echo "Database is connected successfully "."<br>";

?>
