<?php include 'koneksi.php';
$id = $_GET['id'];
$data = $koneksi->query("SELECT * FROM mahasiswa WHERE id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-10">
    <h1 class="text-2xl font-bold mb-4">Edit Data Mahasiswa</h1>
    <form method="POST" class="space-y-4 max-w-md">
        <input type="text" name="nama" value="<?= $data['nama'] ?>" class="w-full border p-2 rounded" required>
        <input type="text" name="nim" value="<?= $data['nim'] ?>" class="w-full border p-2 rounded" required>
        <input type="text" name="alamat" value="<?= $data['alamat'] ?>" class="w-full border p-2 rounded" required>
        <div>
            <label class="block mb-1">Jenis Kelamin</label>
            <label><input type="radio" name="jk" value="Laki-laki" <?= $data['jk']=='Laki-laki'?'checked':'' ?>> Laki-laki</label>
            <label class="ml-4"><input type="radio" name="jk" value="Perempuan" <?= $data['jk']=='Perempuan'?'checked':'' ?>> Perempuan</label>
        </div>
        <button name="update" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>

    <?php
    if (isset($_POST['update'])) {
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $alamat = $_POST['alamat'];
        $jk = $_POST['jk'];
        $koneksi->query("UPDATE mahasiswa SET nama='$nama', nim='$nim', alamat='$alamat', jk='$jk' WHERE id=$id");
        echo "<p class='mt-4 text-green-600'>Data berhasil diupdate. <a href='index.php' class='underline'>Kembali</a></p>";
    }
    ?>
</body>
</html>