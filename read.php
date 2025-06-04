<?php 
include 'koneksi.php'; 

// Check if the connection was successful
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa KKN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-10">
    <h1 class="text-2xl font-bold mb-4">Data Mahasiswa KKN</h1>
    <a href="tambah.php" class="bg-green-500 text-white px-4 py-2 rounded">+ Tambah Data</a>

    <table class="table-auto w-full mt-4 border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-2 py-1">No</th>
                <th class="border px-2 py-1">Nama</th>
                <th class="border px-2 py-1">NIM</th>
                <th class="border px-2 py-1">Alamat</th>
                <th class="border px-2 py-1">JK</th>
                <th class="border px-2 py-1">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $stmt = $koneksi->prepare("SELECT * FROM mahasiswa");
            if ($stmt) {
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td class='border px-2 py-1'>{$no}</td>
                            <td class='border px-2 py-1'>" . htmlspecialchars($row['nama']) . "</td>
                            <td class='border px-2 py-1'>" . htmlspecialchars($row['nim']) . "</td>
                            <td class='border px-2 py-1'>" . htmlspecialchars($row['alamat']) . "</td>
                            <td class='border px-2 py-1'>" . htmlspecialchars($row['jk']) . "</td>
                            <td class='border px-2 py-1'>
                                <a href='edit.php?id=" . htmlspecialchars($row['id']) . "' class='text-blue-500'>Edit</a> |
                                <a href='hapus.php?id=" . htmlspecialchars($row['id']) . "' onclick='return confirm(\"Yakin?\")' class='text-red-500'>Hapus</a>
                            </td>
                          </tr>";
                }

                $stmt->close();
            } else {
                echo "<tr><td colspan='6' class='border px-2 py-1 text-red-500'>Error: " . htmlspecialchars($koneksi->error) . "</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php $koneksi->close(); // Close the database connection ?>
</body>
</html>
