<?php
$host = 'localhost';
$db   = 'uts5a';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

try {
    $sql = "CREATE TABLE IF NOT EXISTS krs (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(30) NOT NULL,
        nim VARCHAR(10) NOT NULL,
        kelas ENUM('5A', '5B', '5C', '5D', '5E') NOT NULL,
        mata_kuliah_pilihan SET('Web Application Development', 'Mobile Application Development', 'UI/UX Design', 'Software Engineering', 'Data Engineering') NOT NULL
    )";
    $pdo->exec($sql);
    echo "Table created successfully or already exists<br>";
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}