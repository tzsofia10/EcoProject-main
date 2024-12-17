<?php
header("Content-Type: text/html; charset=UTF-8");


const DB_HOST = 'localhost';
const DB_NAME = 'kornyezettudatos';
const DB_USER = 'zsoraf';
const DB_PASS = '';


$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}
?>
