<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM krs WHERE id = ?";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$id]);

    header("Location: form_buat_krs.php");
    exit();
}