<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Form Data Mahasiswa</h1>
    <form action="process.php" method="post">
        <label for="nama">Nama Mahasiswa:</label>
        <input type="text" id="nama" name="nama" required pattern="[A-Za-z\s]+" title="Hanya huruf diperbolehkan">

        <label for="nim">NIM:</label>
        <input type="text" id="nim" name="nim" required pattern="\d{10}" title="NIM harus 10 digit angka">

        <label for="kelas">Kelas:</label>
        <select id="kelas" name="kelas" required>
            <option value="">Pilih Kelas</option>
            <option value="5A">5A</option>
            <option value="5B">5B</option>
            <option value="5C">5C</option>
            <option value="5D">5D</option>
            <option value="5E">5E</option>
        </select>

        <fieldset>
            <legend>Mata Kuliah Pilihan:</legend>
            <input type="checkbox" id="web" name="mata_kuliah[]" value="Web Application Development">
            <label for="web">Web Application Development</label><br>
            <input type="checkbox" id="mobile" name="mata_kuliah[]" value="Mobile Application Development">
            <label for="mobile">Mobile Application Development</label><br>
            <input type="checkbox" id="uiux" name="mata_kuliah[]" value="UI/UX Design">
            <label for="uiux">UI/UX Design</label><br>
            <input type="checkbox" id="se" name="mata_kuliah[]" value="Software Engineering">
            <label for="se">Software Engineering</label><br>
            <input type="checkbox" id="de" name="mata_kuliah[]" value="Data Engineering">
            <label for="de">Data Engineering</label>
        </fieldset>

        <button type="submit">Simpan</button>
    </form>

    <h2>Data Mahasiswa</h2>
    <table>
        <tr>
            <th>Nama</th>
            <th>NIM</th>
            <th>Kelas</th>
            <th>Mata Kuliah Pilihan</th>
            <th>Aksi</th>
        </tr>
        <?php
        include 'config.php';
        $stmt = $pdo->query('SELECT * FROM krs');
        while ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
            echo "<td>" . htmlspecialchars($row['nim']) . "</td>";
            echo "<td>" . htmlspecialchars($row['kelas']) . "</td>";
            echo "<td>" . htmlspecialchars($row['mata_kuliah_pilihan']) . "</td>";
            echo "<td>
                    <a href='edit.php?id=" . $row['id'] . "'>Edit</a>
                    <a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>