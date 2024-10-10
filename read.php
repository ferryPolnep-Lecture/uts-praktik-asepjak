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

$sql = "SELECT * FROM krs";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data KRS</title>
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <div class="container">
        <h2>Data KRS</h2>
        <?php
        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Kelas</th>
                        <th>Mata Kuliah Pilihan</th>
                        <th>Aksi</th>
                    </tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row["id"]."</td>
                        <td>".$row["nama"]."</td>
                        <td>".$row["nim"]."</td>
                        <td>".$row["kelas"]."</td>
                        <td>".$row["mata_kuliah_pilihan"]."</td>
                        <td>
                            <a href='update.php?id=".$row["id"]."' class='btn-edit'>Edit</a>
                            <a href='delete.php?id=".$row["id"]."' class='btn-delete' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>Hapus</a>
                        </td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
        <br>
        <a href="form_buat_krs.html" class="btn">Kembali ke Form</a>
    </div>
</body>
</html>
