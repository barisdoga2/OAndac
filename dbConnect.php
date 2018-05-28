<?php


$host = "127.0.0.1";
$username = "root";
$password = "2q9.0z8";
$db = "oandac";


$conn = new mysqli($host, $username, $password, $db);
$conn->set_charset("utf8");
if ($conn->connect_error)
    die("SQL Connection Error!");
