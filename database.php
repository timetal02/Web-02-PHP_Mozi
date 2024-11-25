<?php
// Adatbázis kapcsolat adatai
$servername = "localhost";
$username = "root";
$password = ""; // Állítsd be a jelszót
$dbname = "mozi";

// Kapcsolat létrehozása
$conn = new mysqli($servername, $username, $password, $dbname);

// Kapcsolódási hiba ellenőrzése
if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}

echo "Sikeres adatbázis-kapcsolódás!";
?>
