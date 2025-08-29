<?php
session_start();

// Versi lokal saya
include 'functions.php';
echo "Login page dari versi lokal";

$conn = mysqli_connect("localhost", "root", '', "belajardata");
function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    //menyediakan wadah untuk menyimpan data
    $rows = [];

    //mengambil data dari setiap baris
    while ($row = mysqli_fetch_assoc($result)) {
      
    //menambahkan elemen baru setiap array    
        $rows[] = $row;
    }
//mengembalikan data, rows bentuknya array associative
    return $rows;
}
  function tambah($data) {
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $nis = htmlspecialchars($data["nis"]);
    $email = htmlspecialchars($data["email"]);  
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambar = htmlspecialchars($data["gambar"]);

    //cek apakah gambar sudah diupload
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = 'default.jpg'; //gunakan gambar default jika tidak ada yang diupload
    } else {
          $gambar = ($_FILES['gambar']['name']);
          $tmpName = $_FILES['gambar']['tmp_name'];
          $targetDir = "image/";
          $targetFile = $targetDir . basename($gambar);
          move_uploaded_file($tmpName, $targetFile);
    }

    //query insert data
    $query = "INSERT INTO siswa VALUES ('', '$nama', '$nis', '$email', '$jurusan', '$gambar')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);

  
  }
  //fungsi untuk hapus data
    function hapus($id) {

  }

// fungsi hapus
  function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM siswa WHERE id =$id");

    return mysqli_affected_rows($conn);

    }
//fungsi untuk ubah data
    function ubah($data) {
    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $nis = htmlspecialchars($data["nis"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $gambarLama = htmlspecialchars($data["gambar"]);

    //query insert data
    $query = "UPDATE siswa SET
                nama = '$nama',
                nis = '$nis',
                email = '$email',
                jurusan = '$jurusan',
                gambar = '$gambarLama'
              WHERE id = $id
            ";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
    }

  

  function update($data){
    global $conn;

    $id         = $data["id"];
    $nis        = htmlspecialchars($data["nis"]);
    $nama       = htmlspecialchars($data["nama"]);
    $email      = htmlspecialchars($data["email"]);
    $jurusan    = htmlspecialchars($data["jurusan"]);
    $gambar     = htmlspecialchars($data["gambar"]);

    // query insert data
    $query = " UPDATE siswa SET
                nama    = '$nama',
                nis     = '$nis',
                email   = '$email',
                jurusan = '$jurusan',
                gambar  = '$gambar'
              WHERE id  = $id
            ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

?>
