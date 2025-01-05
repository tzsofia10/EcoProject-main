<?php
header("Content-Type: text/html; charset=UTF-8");

$serverName = "localhost";
$username = 'eco';
$password = 'matemate';
$database = 'eco';


// Kapcsolódás létrehozása
$conn = mysqli_connect($serverName, $username, $password, $database );

// Kapcsolódási hiba ellenőrzése
if (!$conn) {
    die("Kapcsolódási hiba: " . mysqli_connect_error());
}


