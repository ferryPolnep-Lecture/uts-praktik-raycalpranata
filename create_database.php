<?php
$servername = "localhost";
$username = "root";  // Nama pengguna default MySQL
$password = "";      // Kata sandi default (kosong)
$database = "uts5a"; // Nama database

// Membuat koneksi
$conn = new mysqli($servername, $username, $password);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Membuat database
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Pilih database
$conn->select_db($database);

// Membuat tabel
$sql = "CREATE TABLE IF NOT EXISTS krs (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_mahasiswa VARCHAR(100) NOT NULL,
    nim VARCHAR(10) NOT NULL UNIQUE,
    kelas ENUM('5A', '5B', '5C', '5D', '5E') NOT NULL,
    mata_kuliah VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table krs created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

// Tutup koneksi
$conn->close();
?>