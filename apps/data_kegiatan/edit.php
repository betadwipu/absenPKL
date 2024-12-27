<?php
session_start();
if (isset($_POST['edit_kegiatan'])) {
    include '../../config/database.php';

    function input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $id_siswa = $_POST["id_siswa"];
    $id_kegiatan = $_POST["id_kegiatan"];
    $tanggal = $_POST["tanggal"];
    $waktu_awal = $_POST["waktu_awal"];
    $waktu_akhir = $_POST["waktu_akhir"];
    $kegiatan = $_POST["kegiatan"];

    $foto = $_FILES['foto']['name'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($foto)) {
            $foto = "foto_default.png";
        }

        $sql = "UPDATE tbl_kegiatan SET
        kegiatan = '$kegiatan', 
        waktu_awal = '$waktu_awal',
        waktu_akhir = '$waktu_akhir', 
        tanggal = '$tanggal',
        foto = '$foto' 
        WHERE id_kegiatan = '$id_kegiatan';";
        $edit_kegiatan = mysqli_query($kon, $sql);

        // validasi data
        if ($edit_kegiatan) {
            mysqli_query($kon, "COMMIT");
            header("Location:../../index.php?page=data_kegiatan&edit=berhasil");
        } else {
            mysqli_query($kon, "ROlLBACK");
            header("Location:../../index.php?page=data_kegiatan&edit=gagal");
        }
    }
}
?>

<?php
// Mendapatkan data variable dari AJAX
$id_kegiatan = $_POST['id_kegiatan'];

//Include file koneksi, untuk koneksikan ke database
include '../../config/database.php';

//Seleksi data berdasarkan id_absensi dari AJAX untuk menampilkan ke form absensi
$query = "SELECT id_kegiatan, kegiatan, waktu_awal, waktu_akhir, tanggal 
        FROM tbl_kegiatan WHERE id_kegiatan = '$id_kegiatan';";
$result = $kon->query($query);
$row = $result->fetch_assoc();
$waktu_awal = $row['waktu_awal'];
$waktu_akhir = $row['waktu_akhir'];
$tanggal = $row['tanggal'];
$kegiatan = $row['kegiatan'];
?>

<form action="apps/data_kegiatan/edit.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <input type="hidden" name="id_siswa" value="<?php echo $_POST['id_siswa']; ?>">
        <input type="hidden" name="id_kegiatan" value="<?php echo $_POST['id_kegiatan']; ?>">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Tanggal Kegiatan :</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo $tanggal; ?>">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Waktu Awal Kegiatan :</label>
                <input type="time" name="waktu_awal" id="waktu_awal" class="form-control" value="<?php echo $waktu_awal; ?>">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Waktu Akhir Kegiatan:</label>
                <input type="time" name="waktu_akhir" id="waktu_akhir" class="form-control" value="<?php echo $waktu_akhir; ?>">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label>Kegiatan :</label>
                <input type="text" name="kegiatan" id="kegiatan" class="form-control" value="<?php echo $kegiatan; ?>" placeholder="Masukkan Kegiatan Harian">
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
                <button type="submit" name="edit_kegiatan" id="edit_kegiatan" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button>
                <button type="clear" class="btn btn-warning"><i class="fa fa-trash"></i> Reset</button>
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