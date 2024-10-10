<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS uts5e";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select the database
$conn->select_db("uts5e");

// Create table
$sql = "CREATE TABLE IF NOT EXISTS krs (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(50) NOT NULL,
    nim VARCHAR(10) NOT NULL,
    kelas ENUM('5A', '5B', '5C', '5D', '5E') NOT NULL,
    mata_kuliah_pilihan VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table krs created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>