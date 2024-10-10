<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $kelas = $_POST['kelas'];
    $mata_kuliah = implode(',', $_POST['mata_kuliah']);

    $sql = "INSERT INTO krs (nama, nim, kelas, mata_kuliah_pilihan) VALUES (?, ?, ?, ?)";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$nama, $nim, $kelas, $mata_kuliah]);

    header("Location: form_buat_krs.php");
    exit();
}
