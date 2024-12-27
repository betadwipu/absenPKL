<?php
//memulai session
session_start();
//Jika terdeteksi ada variabel id_pengguna dalam session maka langsung arahkan ke halaman dashboard
if (isset($_SESSION["id_pengguna"])) {
    session_unset();
    session_destroy();
}
//Variable pesan untuk menampilkan validasi login
$pesan = "";
//Fungsi untuk mencegah inputan karakter yang tidak sesuai
function input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
//Cek apakah ada kiriman form dari method post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Menghubungkan database
    include "config/database.php";
    //Mengambil input username dan password dari form login
    $username = input($_POST["username"]);
    $password = input(md5($_POST["password"])); //hash yang dipakai md5
    //Query untuk cek tbl_user yang dijoinkan dengan table tbl_admin
    $tabel_admin = "SELECT * FROM tbl_user u
                        INNER JOIN tbl_admin a ON a.kode_admin = u.kode_pengguna
                        WHERE u.username='" . $username . "' AND u.password='" . $password . "' LIMIT 1";
    $cek_tabel_admin = mysqli_query($kon, $tabel_admin);
    $admin = mysqli_num_rows($cek_tabel_admin);

    //Query untuk cek pada tbl_user yang dijoinkan dengan table tbl_siswa
    $tabel_siswa = "SELECT * FROM tbl_user u
                            INNER JOIN tbl_siswa m ON m.kode_siswa = u.kode_pengguna
                            WHERE u.username='" . $username . "' AND u.password='" . $password . "' LIMIT 1";
    $cek_tabel_siswa = mysqli_query($kon, $tabel_siswa);
    $siswa = mysqli_num_rows($cek_tabel_siswa);

    //Query untuk cek tbl_user yang dijoinkan dengan table tbl_pembimbing
    $tabel_pembimbing = "SELECT * FROM tbl_user u
                             INNER JOIN tbl_pembimbing p ON p.kode_pembimbing = u.kode_pengguna
                             WHERE u.username='" . $username . "' AND u.password='" . $password . "' LIMIT 1";
    $cek_tabel_pembimbing = mysqli_query($kon, $tabel_pembimbing);
    $pembimbing = mysqli_num_rows($cek_tabel_pembimbing);

    //Query untuk cek tbl_user yang dijoinkan dengan table tbl_dudi
    $tabel_dudi = "SELECT * FROM tbl_user u
                             INNER JOIN tbl_dudi d ON d.kode_dudi = u.kode_pengguna
                             WHERE u.username='" . $username . "' AND u.password='" . $password . "' LIMIT 1";
    $cek_tabel_dudi = mysqli_query($kon, $tabel_dudi);
    $dudi = mysqli_num_rows($cek_tabel_dudi);

    // Kondisi jika pengguna merupakan admin
    if ($admin > 0) {
        $row = mysqli_fetch_assoc($cek_tabel_admin);
        $_SESSION["id_pengguna"] = $row["id_user"];
        $_SESSION["kode_pengguna"] = $row["kode_pengguna"];
        $_SESSION["nama_admin"] = $row["nama"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["level"] = $row["level"];
        $_SESSION["nip"] = $row["nip"];
        //mengalihkan halaman ke page beranda
        header("Location:index.php?page=beranda");
    } else if ($siswa > 0) {
        $row = mysqli_fetch_assoc($cek_tabel_siswa);
        $_SESSION["id_pengguna"] = $row["id_user"];
        $_SESSION["kode_pengguna"] = $row["kode_pengguna"];
        $_SESSION["id_siswa"] = $row["id_siswa"];
        $_SESSION["nama_siswa"] = $row["nama"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["sekolah"] = $row["sekolah"];
        $_SESSION["level"] = $row["level"];
        $_SESSION["foto"] = $row["foto"];
        $_SESSION["nis"] = $row["nis"];
        //mengalihkan halaman ke page beranda
        header("Location:index.php?page=beranda");
    } else if ($pembimbing > 0) {
        $row = mysqli_fetch_assoc($cek_tabel_pembimbing);
        $_SESSION["id_pengguna"] = $row["id_user"];
        $_SESSION["kode_pengguna"] = $row["kode_pengguna"];
        $_SESSION["nama_pembimbing"] = $row["nama"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["level"] = $row["level"];
        $_SESSION["nip"] = $row["nip"];
        //mengalihkan halaman ke page beranda
        header("Location:index.php?page=beranda");
    } else if ($dudi > 0) {
        $row = mysqli_fetch_assoc($cek_tabel_dudi);
        $_SESSION["id_pengguna"] = $row["id_user"];
        $_SESSION["kode_pengguna"] = $row["kode_pengguna"];
        $_SESSION["nama_dudi"] = $row["nama"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["level"] = $row["level"];
        $_SESSION["nip"] = $row["nip"];
        //mengalihkan halaman ke page beranda
        header("Location:index.php?page=beranda");
    } else {
        //variable di buat terlebih dahulu
        $pesan = "<div class='alert alert-danger'><strong>Error!</strong> Username dan Password Salah.</div>";
    }
}
?>

<!-- Mengambil Profil Aplikasi -->
<?php
//Menghubungkan database
include 'config/database.php';
//Melakukan query untuk menampilkan table tbl_site
$query = mysqli_query($kon, "SELECT * FROM tbl_site LIMIT 1");
//Menyimpan hasil query    
$row = mysqli_fetch_array($query);
//Menyimpan nama instansi dari tbl_site
$nama_instansi = $row['nama_instansi'];
//Menyimpan nama logo dari tbl_site
$logo = $row['logo'];
?>
<!-- Mengambil Profil Aplikasi -->

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Favicon -->
    <link rel="shortcut icon" href="apps/pengaturan/logo/<?php echo $logo; ?>">
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="template/login/css/bootstrap.min.css" />
    <!-- Google Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <!-- Custom CSS -->
    <style>
        body {
            font-family: "Roboto Condensed", sans-serif;
            background: linear-gradient(135deg, #f9f9f9, #a1c4fd);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 400px;
            padding: 2rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
        }

        .container:hover {
            transform: translateY(-10px);
        }

        h1 {
            font-family: "Poppins", sans-serif;
            text-align: center;
            color: #333;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
            position: relative;
        }

        .form-group label {
            font-size: 0.9rem;
            color: #777;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem 2.5rem;
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            font-size: 0.9rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }

        .form-group .icon {
            position: absolute;
            left: 10px;
            top: 75%;
            transform: translateY(-50%);
            font-size: 1.2rem;
            color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 0.8rem;
            width: 100%;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            cursor: pointer;
        }

        .text-center {
            text-align: center;
            font-size: 0.9rem;
            margin-top: 1rem;
            color: #555;
        }

        .alert {
            text-align: center;
            margin-top: 1rem;
            color: red;
            font-weight: bold;
        }
    </style>
    <!-- Title Website -->
    <title>Login | E-PRESENSI</title>
</head>

<body>
    <div class="container">
        <h1>E-PRESENSI</h1>
        <div class="text-center">
            <p>Please, login here!</p>
        </div>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <span class="icon"><i class="fas fa-user"></i></span>
                <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username" required />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <span class="icon"><i class="fas fa-lock"></i></span>
                <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password" required />
            </div>
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo $pesan; ?>
            <button type="submit" name="submit" class="btn btn-primary">Masuk</button>
        </form>
    </div>
</body>

</html>