<?php
// Koneksi ke database
require 'functions.php';
// Ambil id dari URL
$id = $_GET["id"];
// cek apakah data berhasil dihapus atau tidak
if (hapus ($id) > 0 ) {
    // Jika data berhasil dihapus
    echo "
    <script>
    alert('data berhasil dihapus!');
    document.location.href = 'welcome.php?page=laporan';
    </script>
";
} else {
    // Jika data gagal dihapus
    echo "
    <script>
    alert('data gagal dihapus!');
    document.location.href = 'welcome.php?page=laporan'</script>";
}
?>
