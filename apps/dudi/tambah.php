<?php
    session_start();
    if (isset($_POST['tambah_dudi'])) {
        
        //Menghubungkan ke database
        include '../../config/database.php';

        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        //Cek apakah ada kiriman form dari method post
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //Memulai transaksi
            mysqli_query($kon,"START TRANSACTION");

            //Menyimpan input dari form tambah admin
            $nip=input($_POST["nip"]);
            $nama=input($_POST["nama"]);
            $email=input($_POST["email"]);

            //Membuat kode pembimbing otomatis berdasarkan nomor terakhir dari kolom kode_pengguna
            include '../../config/database.php';
            $query = mysqli_query($kon, "SELECT max(id_dudi) AS id_terbesar FROM tbl_dudi");
            $ambil= mysqli_fetch_array($query);
            $id_dudi= $ambil['id_terbesar'];
            $id_dudi++;
            $huruf = "D";
            $kode_dudi = $huruf . sprintf("%03s", $id_dudi);
      
            $sql="INSERT INTO tbl_user (kode_pengguna) VALUES ('$kode_dudi')";

            //Menyimpan ke tabel pengguna
            $simpan_pengguna=mysqli_query($kon,$sql);
            
            // Menyimpan ke tabel pembimbing
            $sql="INSERT INTO tbl_dudi (kode_dudi,nama,nip,email) VALUES ('$kode_dudi','$nama','$nip','$email')";
            //Menyimpan ke tabel pembimbing
            $simpan_dudi=mysqli_query($kon,$sql);

            //validasi jika berhasil menambahkan data pembimbing dan data pengguna 
            if ($simpan_pengguna and $simpan_dudi) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=dudi&add=berhasil");
            }
            //validasi jika gagal menambahkan data pembimbing dan data pengguna
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=dudi&add=gagal");
            }
        }
    }
?>

<form action="apps/dudi/tambah.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Nama Lengkap :</label>
                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Lengkap" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Nomor Induk Pegawai (NIP) :</label>
                <input type="text" name="nip" class="form-control"  value="" placeholder="Masukan Nomor Induk Pegawai" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Email :</label>
                <input type="email" name="email" class="form-control" placeholder="Masukan Email" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <button type="submit" name="tambah_dudi" id="Submit" class="btn btn-success"><i class="fa fa-plus"></i> Daftar</button>
            <button type="reset" class="btn btn-warning"><i class="fa fa-trash"></i> Reset</button>
        </div>
    </div>
</form>

<style>
    .file {
    visibility: hidden;
    position: absolute;
    }
</style>