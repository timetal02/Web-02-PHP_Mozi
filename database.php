<?php
// Adatbázis kapcsolat adatai
$servername = "localhost:3307";
$username = "root";
$password = ""; // Állítsd be a jelszót
$dbname = "mozi";

// Kapcsolat létrehozása
$conn = new mysqli($servername, $username, $password, $dbname);

// Kapcsolódási hiba ellenőrzése
if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}

$conn->set_charset("utf8");
