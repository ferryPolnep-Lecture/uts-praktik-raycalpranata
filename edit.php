<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM krs WHERE id = ?");
    $stmt->execute([$id]);
    $data = $stmt->fetch();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $kelas = $_POST['kelas'];
    $mata_kuliah = implode(',', $_POST['mata_kuliah']);

    $sql = "UPDATE krs SET nama = ?, nim = ?, kelas = ?, mata_kuliah_pilihan = ? WHERE id = ?";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$nama, $nim, $kelas, $mata_kuliah, $id]);

    header("Location: form_buat_krs.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Data Mahasiswa</h1>
    <form action="edit.php" method="post">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
        
        <label for="nama">Nama Mahasiswa:</label>
        <input type="text" id="nama" name="nama" required pattern="[A-Za-z\s]+" title="Hanya huruf diperbolehkan" value="<?php echo $data['nama']; ?>">

        <label for="nim">NIM:</label>
        <input type="text" id="nim" name="nim" required pattern="\d{10}" title="NIM harus 10 digit angka" value="<?php echo $data['nim']; ?>">

        <label for="kelas">Kelas:</label>
        <select id="kelas" name="kelas" required>
            <option value="">Pilih Kelas</option>
            <option value="5A" <?php if($data['kelas'] == '5A') echo 'selected'; ?>>5A</option>
            <option value="5B" <?php if($data['kelas'] == '5B') echo 'selected'; ?>>5B</option>
            <option value="5C" <?php if($data['kelas'] == '5C') echo 'selected'; ?>>5C</option>
            <option value="5D" <?php if($data['kelas'] == '5D') echo 'selected'; ?>>5D</option>
            <option value="5E" <?php if($data['kelas'] == '5E') echo 'selected'; ?>>5E</option>
        </select>

        <fieldset>
            <legend>Mata Kuliah Pilihan:</legend>
            <?php
            $mata_kuliah = explode(',', $data['mata_kuliah_pilihan']);
            $options = ['Web Application Development', 'Mobile Application Development', 'UI/UX Design', 'Software Engineering', 'Data Engineering'];
            foreach ($options as $option) {
                $checked = in_array($option, $mata_kuliah) ? 'checked' : '';
                echo "<input type='checkbox' id='" . strtolower(str_replace(' ', '', $option)) . "' name='mata_kuliah[]' value='$option' $checked>";
                echo "<label for='" . strtolower(str_replace(' ', '', $option)) . "'>$option</label><br>";
            }
            ?>
        </fieldset>

        <button type="submit">Update</button>
    </form>
</body>
</html>
