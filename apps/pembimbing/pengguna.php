<?php
session_start();
    if (isset($_POST['submit'])) {
        
        //Include file koneksi, untuk koneksikan ke database
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

            $kode_pembimbing=input($_POST["kode_pembimbing"]);
            $username=input($_POST["username"]);
            $password=md5(input($_POST["password"]));
            $level="Pembimbing";

            $sql="UPDATE tbl_user SET 
            username='$username',
            password='$password',
            level='$level'
            where kode_pengguna='$kode_pembimbing'";

            //Menyimpan ke tabel pengguna
            $setting_pengguna=mysqli_query($kon,$sql);

            if ($setting_pengguna) {
                mysqli_query($kon,"COMMIT");
                header("Location:../../index.php?page=pembimbing&pengguna=berhasil");
            }
            else {
                mysqli_query($kon,"ROLLBACK");
                header("Location:../../index.php?page=pembimbing&pengguna=gagal");
            }
        }  
    }
?>

<form action="apps/pembimbing/pengguna.php" method="post">
<?php
    include '../../config/database.php';
    $kode_pengguna=$_POST['kode_pembimbing'];
    $query = mysqli_query($kon, "SELECT * FROM tbl_user where kode_pengguna='$kode_pengguna'");
    $data = mysqli_fetch_array($query);
    $username=$data['username'];
    $password=$data['password'];
?>

    <div class="row">
        <div class="col-sm-7">
            <div class="form-group">
                <input name="kode_pembimbing" type="hidden" id="kode_pembimbing" class="form-control" value="<?php echo $_POST['kode_pembimbing'];?>"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Username :</label>
                <input name="username" type="text" id="username" class="form-control" value="<?php echo $username; ?>" 
                <?php
                //Mencegah pembimbing lain mengubah username jika password sudah dibuat
                if($username == $_SESSION["username"]) {
                    echo "";
                    } else if (empty($username)) {
                    echo "";
                    } else
                    echo "disabled";
                ?>
                placeholder="Buat Username" required>
                <div id="info_username"> </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Password :</label>
                <input name="password" type="password" class="form-control" value="" 
                <?php
                //Mencegah admin lain mengubah username jika password sudah dibuat
                if($username == $_SESSION["username"]) {
                    echo "";
                    } else if (empty($username)) {
                    echo "";
                    } else
                    echo "disabled";
                ?>
                placeholder="Buat Password" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <button type="submit" name="submit" id="submit" class="btn-setting btn btn-success"><i class="fa fa-edit"></i> Simpan</button>
        </div>
    </div>
</form>

<script>
    //Event pada field username, untuk mengecek ketersediaan username
    $("#username").bind('keyup', function () {

        var username = $('#username').val();

        $.ajax({
            url: 'apps/pengguna/cek_username.php',
            method: 'POST',
            data:{username:username},
            success:function(data){
                $('#info_username').show();
                $('#info_username').html(data);
            }
        }); 
    });
</script>

<script>
    // fungsi mengubah password
   $('.btn-setting').on('click',function(){
        konfirmasi=confirm("Konfirmasi Menyimpan Username dan Password?")
        if (konfirmasi){
            return true;
        }else {
            return false;
        }
    });
</script>