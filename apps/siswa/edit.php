<?php
session_start();
if (isset($_POST['edit_siswa'])) {
    include '../../config/database.php';

    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        mysqli_query($kon, "START TRANSACTION");

        $id_siswa = input($_POST["id_siswa"]);
        $nama = input($_POST["nama"]);
        $sekolah = input($_POST["sekolah"]);
        $jurusan = input($_POST["jurusan"]);
        $nis = input($_POST["nis"]);
        $mulai_magang = input($_POST["mulai_magang"]);
        $akhir_magang = input($_POST["akhir_magang"]);
        $no_telp = input($_POST["no_telp"]);
        $alamat = input($_POST["alamat"]);
        $foto_saat_ini = input($_POST['foto_saat_ini']);

        // Proses upload file foto baru
        $foto_baru = $_FILES['foto_baru']['name'];
        if (!empty($foto_baru)) {
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'gif');
            $x = explode('.', $foto_baru);
            $ekstensi = strtolower(end($x));
            $ukuran = $_FILES['foto_baru']['size'];
            $file_tmp = $_FILES['foto_baru']['tmp_name'];

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                move_uploaded_file($file_tmp, 'foto/'.$foto_baru);
                if ($foto_saat_ini != 'foto_default.png') {
                    unlink("foto/".$foto_saat_ini);
                }
                $sql = "UPDATE tbl_siswa SET
                        nama='$nama',
                        sekolah='$sekolah',
                        jurusan='$jurusan',
                        nis='$nis',
                        mulai_magang='$mulai_magang',
                        akhir_magang='$akhir_magang',
                        no_telp='$no_telp',
                        alamat='$alamat',
                        foto='$foto_baru'
                        WHERE id_siswa=$id_siswa";
            } else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=siswa&edit=gagal&msg=Invalid file type");
                exit();
            }
        } else {
            // Jika tidak ada foto baru yang diupload, update data lain saja
            $sql = "UPDATE tbl_siswa SET
                    nama='$nama',
                    sekolah='$sekolah',
                    jurusan='$jurusan',
                    nis='$nis',
                    mulai_magang='$mulai_magang',
                    akhir_magang='$akhir_magang',
                    no_telp='$no_telp',
                    alamat='$alamat'
                    WHERE id_siswa=$id_siswa";
        }

        $edit_siswa = mysqli_query($kon, $sql);
        if ($edit_siswa) {
            mysqli_query($kon, "COMMIT");
            header("Location:../../index.php?page=siswa&edit=berhasil");
        } else {
            mysqli_query($kon, "ROLLBACK");
            header("Location:../../index.php?page=siswa&edit=gagal");
        }
    }
}
?>


<?php 
    include '../../config/database.php';
    $id_siswa=$_POST["id_siswa"];
    $sql="select * from tbl_siswa where id_siswa=$id_siswa limit 1";
    $hasil=mysqli_query($kon,$sql);
    $data = mysqli_fetch_array($hasil); 
?>

<form action="apps/siswa/edit.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Nama Lengkap :</label>
                <input type="hidden" name="id_siswa" class="form-control" value="<?php echo $data['id_siswa'];?>">
                <input type="text" name="nama" class="form-control" value="<?php echo $data['nama'];?>" placeholder="Masukan Nama Siswa" required>

            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Sekolah :</label>
                <input type="text" name="sekolah" class="form-control" value="<?php echo $data['sekolah'];?>" placeholder="Masukan Nama Sekolah" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Jurusan :</label>
                <input type="text" name="jurusan" class="form-control" value="<?php echo $data['jurusan'];?>" placeholder="Masukan Nama Jurusan" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Nomor Induk Siswa :</label>
                <input type="text" name="nis" class="form-control" value="<?php echo $data['nis'];?>" placeholder="Masukan Nomor Induk Siswa" required>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Mulai Magang :</label>
                <input type="date" name="mulai_magang" class="form-control" value="<?php echo $data['mulai_magang'];?>" required>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Akhir Magang :</label>
                <input type="date" name="akhir_magang" class="form-control" value="<?php echo $data['akhir_magang'];?>" required>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>No Telp :</label>
                <input type="text" name="no_telp" class="form-control" placeholder="Masukan No Telp" value="<?php echo $data['no_telp'];?>" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-7">
            <div class="form-group">
                <label>Alamat :</label>
                <textarea class="form-control" name="alamat" rows="4" id="alamat"><?php echo $data['alamat'];?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
        <label>Foto :</label><br>
            <img src="apps/siswa/foto/<?php echo $data['foto'];?>" id="preview" width="90%" class="rounded" alt="Cinque Terre">
            <input type="hidden" name="foto_saat_ini" value="<?php echo $data['foto'];?>" class="form-control" />
        </div>
        <div class="col-sm-4">
            <div id="msg"></div>
            <label>Upload Foto Baru:</label>
            <input type="file" name="foto_baru" class="file" >
                <div class="input-group my-3">
                    <input type="text" class="form-control" disabled placeholder="Upload File" id="file">
                    <div class="input-group-append">
                            <button type="button" id="pilih_foto" class="browse btn btn-info"><i class="fa fa-search"></i> Pilih Foto</button>
                    </div>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <br>
                <button type="submit" name="edit_siswa" id="Submit" class="btn btn-warning" ><i class="fa fa-edit"></i> Update</button>
            </div>
        </div>
    </div>
</form>

<style>
    .file {
    visibility: hidden;
    position: absolute;
    }
</style>

<script>
    $(document).on("click", "#pilih_foto", function() {
    var file = $(this).parents().find(".file");
    file.trigger("click");
    });
    $('input[type="file"]').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);
    var reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById("preview").src = e.target.result;
    };
    reader.readAsDataURL(this.files[0]);
    });
</script>