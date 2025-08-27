<?php
require 'functions.php';

// cek apakah ada id di URL
if (!isset($_GET["id"])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = (int)$_GET["id"]; // amankan input
$ubahDB = query("SELECT * FROM siswa WHERE id = $id")[0];

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
    if (ubah($_POST) > 0) {
        echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'welcome.php?page=laporan';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'welcome.php?page=laporan';
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update data siswa</title>
    <style>
        body{
    font-family: apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
     background-image: linear-gradient(to bottom, rgb(27, 60, 83),rgb(69, 104, 130));
        }
.container{
    width: 400px;
    padding: 20px;
    margin: 1   00px auto;
    background-color: #f4f4f4;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
h1 {
    text-align: center; 
    color: #333;
}
form ul {
    list-style-type: none;  
    padding: 0;
}
form ul li {
    margin-bottom: 15px;
}
label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
}
input[type="text"], select {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}
button {    
    background-color: #28a745;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}


    </style>
</head>
<body>
    <div class="container">
    <h1>Update Data Siswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <!-- gunakan hidden agar id tetap terkirim -->
        <input type="hidden" name="id" value="<?= $ubahDB['id']; ?>">
        <ul>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" name="nama" id="nama" required value="<?= $ubahDB['nama']; ?>">
            </li>
            <li>
                <label for="nis">NIS : </label>
                <input type="text" name="nis" id="nis" required value="<?= $ubahDB['nis']; ?>">
            </li>
            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" id="email" required value="<?= $ubahDB['email']; ?>">
            </li>
            <li>
                <label for="jurusan">Jurusan:</label>
                <select id="jurusan" name="jurusan" required>
                    <option value="">Pilih Jurusan</option>
                    <option value="Teknik Informatika" <?= ($ubahDB['jurusan'] == "Teknik Informatika") ? "selected" : ""; ?>>Teknik Informatika</option>
                    <option value="Sistem Informasi" <?= ($ubahDB['jurusan'] == "Sistem Informasi") ? "selected" : ""; ?>>Sistem Informasi</option>
                </select>
            </li>
            <li>
                <label for="gambar">Gambar : </label><br>
                <img src="img/<?= $ubahDB['gambar']; ?>" width="50"><br>
                <input type="file" name="gambar" id="gambar">
                <!-- untuk simpan gambar lama jika tidak upload -->
                <input type="hidden" name="gambarLama" value="<?= $ubahDB['gambar']; ?>">
            </li>
            <li>
                <button type="submit" name="submit">Ubah Data!</button>
            </li>
         </ul>   
    </form>
    </div>
</body>
</html>
