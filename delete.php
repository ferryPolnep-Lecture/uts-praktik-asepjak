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

// Menghapus data KRS berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM krs WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: update.php"); // Redirect ke halaman utama setelah delete
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID tidak ditemukan!";
}

$conn->close();
?>
