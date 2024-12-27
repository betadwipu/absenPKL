<?php
session_start();
if (isset($_POST['simpan_kegiatan'])) {

    include '../../config/database.php';

    function input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $id_siswa = $_POST["siswa"];
    $tanggal = $_POST["tanggal"];
    $waktu_awal = $_POST["waktu_awal"];
    $waktu_akhir = $_POST["waktu_akhir"];
    $kegiatan = $_POST["kegiatan"];
    $foto = $_FILES['foto']['name'];
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['foto']['size'];
    $file_tmp = $_FILES['foto']['tmp_name'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($foto)) {
            $foto = "foto_default.png";
        } else {
            $absenpkl = "C:/xampp/htdocs/absenpkl/img/admin/";
            if (!file_exists($absenpkl)) {
                mkdir($absenpkl, 0777, true);
            }
            $pathPhoto = "img/admin/" . $foto;

            move_uploaded_file($file_tmp, $absenpkl . $foto);
        }

        $sql = "INSERT INTO tbl_kegiatan (id_siswa,kegiatan,waktu_awal,waktu_akhir,tanggal, foto) 
        VALUES ('$id_siswa','$kegiatan','$waktu_awal','$waktu_akhir','$tanggal', '$pathPhoto')";
        $simpan_kegiatan = mysqli_query($kon, $sql);

        // validasi data
        if ($simpan_kegiatan) {
            mysqli_query($kon, "COMMIT");
            header("Location:../../index.php?page=data_kegiatan&tambah=berhasil");
        } else {
            mysqli_query($kon, "ROlLBACK");
            header("Location:../../index.php?page=data_kegiatan&tambah=gagal");
        }
    }
}
?>

<form action="apps/data_kegiatan/tambah.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Nama Siswa :</label>
                <select class="form-control" id="siswa" name="siswa" required>
                    <?php
                    // Tampilkan data nama dan id_siswa pada elemen select option
                    include '../../config/database.php';
                    $query = "SELECT id_siswa, nama FROM tbl_siswa";
                    $result = mysqli_query($kon, $query);
                    while ($data = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $data['id_siswa'] . "'>" . $data['nama'] . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Tanggal Kegiatan :</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Waktu Awal Kegiatan :</label>
                <input type="time" name="waktu_awal" id="waktu_awal" class="form-control" value="">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Waktu Akhir Kegiatan:</label>
                <input type="time" name="waktu_akhir" id="waktu_akhir" class="form-control" value="">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label>Kegiatan :</label>
                <input type="text" name="kegiatan" id="kegiatan" class="form-control" value="" placeholder="Masukkan Kegiatan Harian">
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group">
                <div id="msg"></div>
                <label>Foto :</label>
                <input type="file" name="foto" class="file">
                <div class="input-group my-3">
                    <input type="text" class="form-control" disabled placeholder="Upload Foto" id="file">
                    <div class="input-group-append">
                        <button type="button" id="pilih_foto" class="browse btn btn-info"><i class="fa fa-search"></i> Pilih</button>
                    </div>
                </div>
                <img src="source/img/size.png" id="preview" class="img-thumbnail">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <br>
                <button type="submit" name="simpan_kegiatan" id="simpan_kegiatan" class="btn btn-success"><i class="fa fa-plus"></i> Simpan</button>
                <button type="clear" class="btn btn-warning"><i class="fa fa-trash"></i> Hapus</button>
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
            // get loaded data and render thumbnail.
            document.getElementById("preview").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });
</script>