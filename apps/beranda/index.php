<div class="row">
    <ol class="breadcrumb">
        <li><a href="index.php?page=beranda">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">Beranda</li>
    </ol>
</div>
<!--/.row-->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Beranda</div>
            <div class="panel-body">

            <!-- Menampilkan Nama Pengguna Sesuai Level -->
            <?php if ($_SESSION['level']=='Admin'):?>
                <h3>Selamat Datang,  <?php echo  $_SESSION["nama_admin"]; ?>.</h3>
            <?php elseif ($_SESSION['level']=='Siswa'):?>
                <h3>Selamat Datang, <?php echo  $_SESSION["nama_siswa"]; ?>.</h3>
            <?php elseif ($_SESSION['level']=='Pembimbing'):?>
                <h3>Selamat Datang,  <?php echo  $_SESSION["nama_pembimbing"]; ?>.</h3>
            <?php elseif ($_SESSION['level']=='Dudi'):?>
                <h3>Selamat Datang,  <?php echo  $_SESSION["nama_dudi"]; ?>.</h3>
            <?php endif; ?>
            <!-- Menampilkan Nama Pengguna Sesuai Level -->

            <!-- Mengambil data table tbl_site -->
            <?php 
                include 'config/database.php';
                $query = mysqli_query($kon, "SELECT * FROM tbl_site LIMIT 1");    
                $row = mysqli_fetch_array($query);
            ?>
            <!-- Mengambil data table tbl_site -->

            <!-- Info Aplikasi -->
            <p>Selamat Datang di Aplikasi E-Presensi berbasis Web. Sebuah sistem yang memungkinkan para Siswa PKL di <?php echo $row['nama_instansi'];?> untuk melalukan absensi dan mencatat kegiatan harian dari website. Sistem ini diharapkan dapat memberi kemudahan setiap siswa PKL untuk melakukan absensi dan mencatat kegiatan harian.</p>
            <!-- Info Aplikasi -->

            <!-- Timeline Magang -->
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h4>Timeline Magang</h4>
                </div>
                <div class="panel-body">
                    <ul class="timeline">
                        <li class="timeline-item">
                            <div class="timeline-badge" style="background-color: #4CAF50;"><i class="fa fa-check-circle"></i></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Juni - Persiapan Magang</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Mulai persiapan administrasi dan penugasan ke perusahaan/instansi.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-item">
                            <div class="timeline-badge" style="background-color: #2196F3;"><i class="fa fa-briefcase"></i></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">Juli - Mulai Magang</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Para siswa mulai menjalankan magang di tempat yang sudah ditentukan.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-item">
                            <div class="timeline-badge" style="background-color: #FF9800;"><i class="fa fa-hourglass-half"></i></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">September - Monitoring Kegiatan</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Pembimbing melakukan monitoring terhadap kegiatan magang yang sudah dilakukan.</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-item">
                            <div class="timeline-badge" style="background-color: #F44336;"><i class="fa fa-flag-checkered"></i></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title">November - Akhir Magang</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>Magang berakhir dan siswa menyerahkan laporan hasil kegiatan magang.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Timeline Magang -->

            </div>
        </div>
    </div>
</div>
