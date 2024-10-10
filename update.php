<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uts5a";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mendapatkan data KRS berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "SELECT * FROM krs WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan!";
        exit();
    }
}

// Memproses pembaruan data KRS jika form di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $kelas = $_POST['kelas'];
    $makul = isset($_POST['makul']) ? implode(", ", $_POST['makul']) : '';

    $sql = "UPDATE krs SET nama='$nama', nim='$nim', kelas='$kelas', mata_kuliah_pilihan='$makul' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: read.php"); // Redirect ke halaman utama setelah update
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data KRS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Data KRS</h2>
        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <div class="form-group">
                <label for="nama">Nama Mahasiswa:</label>
                <input type="text" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required pattern="[A-Za-z\s]+" title="Nama hanya boleh berisi huruf">
            </div>

            <div class="form-group">
                <label for="nim">NIM:</label>
                <input type="text" id="nim" name="nim" value="<?php echo $row['nim']; ?>" required pattern="\d{10}" title="NIM harus berisi 10 digit angka">
            </div>

            <div class="form-group">
                <label for="kelas">Kelas:</label>
                <div class="radio-group">
                    <label><input type="radio" name="kelas" value="5A" <?php if ($row['kelas'] == '5A') echo 'checked'; ?>> Kelas 5A</label>
                    <label><input type="radio" name="kelas" value="5B" <?php if ($row['kelas'] == '5B') echo 'checked'; ?>> Kelas 5B</label>
                    <label><input type="radio" name="kelas" value="5C" <?php if ($row['kelas'] == '5C') echo 'checked'; ?>> Kelas 5C</label>
                    <label><input type="radio" name="kelas" value="5D" <?php if ($row['kelas'] == '5D') echo 'checked'; ?>> Kelas 5D</label>
                    <label><input type="radio" name="kelas" value="5E" <?php if ($row['kelas'] == '5E') echo 'checked'; ?>> Kelas 5E</label>
                </div>
            </div>

            <div class="form-group">
                <label>Mata Kuliah Pilihan:</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="makul[]" value="Web Application Development" <?php if (strpos($row['mata_kuliah_pilihan'], 'Web Application Development') !== false) echo 'checked'; ?>> Web Application Development</label>
                    <label><input type="checkbox" name="makul[]" value="Mobile Application Development" <?php if (strpos($row['mata_kuliah_pilihan'], 'Mobile Application Development') !== false) echo 'checked'; ?>> Mobile Application Development</label>
                    <label><input type="checkbox" name="makul[]" value="UI/UX Design" <?php if (strpos($row['mata_kuliah_pilihan'], 'UI/UX Design') !== false) echo 'checked'; ?>> UI/UX Design</label>
                    <label><input type="checkbox" name="makul[]" value="Software Engineering" <?php if (strpos($row['mata_kuliah_pilihan'], 'Software Engineering') !== false) echo 'checked'; ?>> Software Engineering</label>
                    <label><input type="checkbox" name="makul[]" value="Data Engineering" <?php if (strpos($row['mata_kuliah_pilihan'], 'Data Engineering') !== false) echo 'checked'; ?>> Data Engineering</label>
                </div>
            </div>

            <div class="form-group">
                <input type="submit" value="Update KRS" class="btn">
            </div>
        </form>
        <a href="read.php" class="btn">Lihat Data KRS</a>
    </div>
</body>
</html>
