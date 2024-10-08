<?php
//подключение к БД
// $servername = "localhost";
$servername = "my-final-project-coffeeshop";
$username = "root";
$password = "";
$dbname = "final-project-db";

$connection = new mysqli($servername, $username, $password, $dbname);
if (isset($connection->connect_error)) {
    die("connection failed: ". $connection->connect_error);
}

// print_r($connection);
