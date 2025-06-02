<?php
$host = "localhost"; // Host database
$dbUsername = "root"; // Username database
$dbPassword = ""; // Password database
$dbName = "furniture_store"; // Nama database

// Membuat koneksi
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>