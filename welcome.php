<?php
session_start();

// Cek login
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
exit;
}
// Ambil data user
$username = $_SESSION['user'];
// Mengatur halaman yang akan ditampilkan
$page = $_GET['page'] ?? 'home';
?>

<?php
// Koneksi ke database
require 'functions.php';

// Ambil semua data siswa
$siswa = mysqli_query($conn, "SELECT * FROM siswa");

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST['submit'])) {
    if (tambah($_POST) > 0) {
        // Jika data berhasil ditambahkan
        echo "<script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'welcome.php?page=laporan';
              </script>";
    } else {
        // Jika data gagal ditambahkan
        echo "<script>
                alert('Data gagal ditambahkan!');
                document.location.href = 'welcome.php?page=laporan';
              </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="welcome.css">
</head>
<body>
    <div class="sidebar">
        <h2>Dashboard</h2>
        <ul>
            <li><a href="welcome.php?page=home">Home</a></li>
            <li><a href="welcome.php?page=nilai">Nilai</a></li>
            <li><a href="welcome.php?page=kehadiran">Kehadiran</a></li>
            <li><a href="welcome.php?page=jadwal">Jadwal</a></li>
            <li><a href="welcome.php?page=pengaturan">Pengaturan</a></li>
            <li><a href="welcome.php?page=laporan">Laporan</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="content">
        <?php
        switch($page) {
            case 'home':
                echo "<h1>Selamat Datang di Dashboard</h1><h2>Halo, saya Rafa Fauzan</h2>
                <p>
                Saya adalah seorang siswa di sekolah Ibnul Qayyim yang saat ini sedang duduk di kelas XI jurusan RPL (Rekayasa Perangkat Lunak).<br>
                Saya memiliki minat dalam bidang IT, dan saya selalu berusaha untuk meningkatkan pengetahuan dan keterampilan saya setiap hari.<br>
                Di dashboard ini, saya dapat melihat nilai, kehadiran, jadwal pelajaran, dan berbagai informasi penting lainnya yang mendukung kegiatan belajar saya.
                </p>";
                break;

            case 'nilai':
                echo "<h1>Halaman Nilai</h1><p>Menampilkan data nilai siswa.</p>";
                break;

           case 'kehadiran':
        ?>
                <table border="1" cellpadding="10" cellspacing="0">
                    <thead>

                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // jika data kosong, tampilkan pesan
                        if (empty($siswa)): ?>
                            <tr>
                                <td colspan="7" style="text-align:center; padding:30px;">Data kosong.</td>
                            </tr>
                        <?php
                        // jika data tidak kosong, tampilkan data
                        else: ?>
                            <?php
                            $i = 1;
                            $siswa = isset($siswa) ? $siswa : [];
                            foreach ($siswa as $row) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= htmlspecialchars($row['nama']); ?></td>

                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            <?php
                break;

            case 'jadwal':
                echo "<h1>Halaman Jadwal</h1><p>Menampilkan jadwal pelajaran.</p>";
                break;

            case 'pengaturan':
                echo "<h1>Halaman Pengaturan</h1><p>Pengaturan akun dan preferensi.</p>";
                break;

            case 'laporan':
                echo "<h1>Halaman Laporan</h1>";
                ?>
                 <h3>Laporan Siswa</h3>
                <div class="form-container">
                    <h4>Tambah Siswa Baru</h4>
                    <form action="welcome.php?page=laporan" method="post" enctype="multipart/form-data">
                        <label for="nama">Nama:</label>
                        <input type="text" id="nama" name="nama" required>

                        <label for="nis">NIS</label>
                        <input type="text" id="nis" name="nis" required>

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>

                        <label for="jurusan">Jurusan:</label>
                        <select id="jurusan" name="jurusan" required>
                            <option value="">Pilih Jurusan</option>
                            <option value="Teknik Informatika">Teknik Informatika</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                        </select>

                               <label for="gambar">Gambar:</label>
                        <input type="file" id="gambar" name="gambar" accept="image/*">
                        
                        <button type="submit" name="submit">Tambah Siswa</button>
                    </form>
                </div>

                <h4>Daftar Siswa</h4>
                <table border="1" cellpadding="10" cellspacing="0">
                    <tr>
                        <th>No.</th>
                        <th>Gambar</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    $i = 1;
                    $siswa = isset($siswa) ? $siswa : [];
                    foreach ($siswa as $row) :
                    ?>
                        <tr>
                            <td><?= $i; ?></td>


                            <td><img src="<?= htmlspecialchars($row['gambar']); ?>" width="50"></td>
                            <td><?= htmlspecialchars($row['nis']); ?></td>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td><?= htmlspecialchars($row['jurusan']); ?></td>
                            <td class="aksi-btns">
                        <a href="view.php?nis=<?= urlencode($s['nis']); ?>" class="view">View</a>
                        <a href="ubah.php?id=<?= $row["id"]; ?>" class="edit">Ubah</a>
                        <a href="hapus.php?id=<?= $row["id"];?>" class="delete">Hapus</a>
                    </td>
                        </tr>
                    <?php
                        $i++;
                    endforeach;
                    ?>
                </table>
        <?php
                break;
            default:
                echo "<h3>Halaman tidak ditemukan</h3>";
                break;
        }
        ?>
    </div>
</body>
</html>