<?php
// konfigurasi.php

// Database configuration
define('DB_HOST', 'localhost'); // Change this to your database host
define('DB_USER', 'your_username'); // Change this to your database username
define('DB_PASS', 'your_password'); // Change this to your database password
define('DB_NAME', 'your_database_name'); // Change this to your database name

// Function to connect to the database
function connectDatabase() {
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    return $connection;
}

// Function to fetch all mahasiswa data
function fetchMahasiswaData() {
    $connection = connectDatabase();
    $sql = "SELECT * FROM mahasiswa"; // Assuming you have a table named 'mahasiswa'
    $result = $connection->query($sql);
    
    $mahasiswa = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $mahasiswa[] = $row;
        }
    }
    
    $connection->close();
    return $mahasiswa;
}

// Function to insert or update mahasiswa data
function saveMahasiswaData($data) {
    $connection = connectDatabase();
    
    if (isset($data['id'])) {
        // Update existing record
        $stmt = $connection->prepare("UPDATE mahasiswa SET nama=?, nim=?, email=?, alamat=?, tempat_tgl=?, jenis_kelamin=? WHERE id=?");
        $stmt->bind_param("ssssssi", $data['nama'], $data['nim'], $data['email'], $data['alamat'], $data['tempat_tgl'], $data['jenis_kelamin'], $data['id']);
    } else {
        // Insert new record
        $stmt = $connection->prepare("INSERT INTO mahasiswa (nama, nim, email, alamat, tempat_tgl, jenis_kelamin) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $data['nama'], $data['nim'], $data['email'], $data['alamat'], $data['tempat_tgl'], $data['jenis_kelamin']);
    }
    
    $stmt->execute();
    $stmt->close();
    $connection->close();
}

// Function to delete mahasiswa data
function deleteMahasiswaData($id) {
    $connection = connectDatabase();
    $stmt = $connection->prepare("DELETE FROM mahasiswa WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $connection->close();
}
?>
