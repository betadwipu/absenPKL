<?php
    //Memulai Session
    session_start();

    //Koneksi database
    include '../../config/database.php';
    //Memulai admin
    mysqli_query($kon,"START TRANSACTION");

    $id_dudi=$_GET['id_dudi'];
    $kode_dudi=$_GET['kode_dudi'];

    //Menghapus data dalam tabel admin
    $hapus_dudi=mysqli_query($kon,"DELETE FROM tbl_dudi WHERE id_dudi='$id_dudi'");
    //Menghapus data dalam tabel pengguna
    $hapus_pengguna=mysqli_query($kon,"DELETE FROM tbl_user WHERE kode_pengguna='$kode_dudi'");

    //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
    if ($hapus_dudi and $hapus_pengguna) {
        mysqli_query($kon,"COMMIT");
        header("Location:../../index.php?page=dudi&hapus=berhasil");
    }
    else {
        mysqli_query($kon,"ROLLBACK");
        header("Location:../../index.php?page=dudi&hapus=gagal");

    }

?>