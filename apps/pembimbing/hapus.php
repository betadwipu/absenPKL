<?php
    //Memulai Session
    session_start();

    //Koneksi database
    include '../../config/database.php';
    //Memulai admin
    mysqli_query($kon,"START TRANSACTION");

    $id_pembimbing=$_GET['id_pembimbing'];
    $kode_pembimbing=$_GET['kode_pembimbing'];

    //Menghapus data dalam tabel admin
    $hapus_pembimbing=mysqli_query($kon,"DELETE FROM tbl_pembimbing WHERE id_pembimbing='$id_pembimbing'");
    //Menghapus data dalam tabel pengguna
    $hapus_pengguna=mysqli_query($kon,"DELETE FROM tbl_user WHERE kode_pengguna='$kode_pembimbing'");

    //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
    if ($hapus_pembimbing and $hapus_pengguna) {
        mysqli_query($kon,"COMMIT");
        header("Location:../../index.php?page=pembimbing&hapus=berhasil");
    }
    else {
        mysqli_query($kon,"ROLLBACK");
        header("Location:../../index.php?page=pembimbing&hapus=gagal");

    }

?>