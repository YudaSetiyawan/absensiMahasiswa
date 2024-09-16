<?php
$servername = "localhost";
$username = "root"; // atau username database Anda
$password = ""; // atau password database Anda
$database = "absen"; // ganti dengan nama database Anda

// Membuat koneksi
$mysqli = new mysqli($servername, $username, $password, $database);

// Mengecek koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
?>
