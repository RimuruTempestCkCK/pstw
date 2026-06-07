        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    <li><a href="<?php echo $base_url; ?>dashboard.php" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a></li>
                    
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                    <li class="nav-label">Admin Menu</li>
                    <li><a href="<?php echo $base_url; ?>admin/users.php" aria-expanded="false"><i class="icon icon-users-mm-2"></i><span class="nav-text">Data Pengguna</span></a></li>
                    <li><a href="<?php echo $base_url; ?>admin/lansia.php" aria-expanded="false"><i class="icon icon-single-04"></i><span class="nav-text">Data Lansia</span></a></li>
                    <li><a href="<?php echo $base_url; ?>admin/aktivitas.php" aria-expanded="false"><i class="icon icon-form"></i><span class="nav-text">Aktivitas Lansia</span></a></li>
                    <li><a href="<?php echo $base_url; ?>admin/kategori_perilaku.php" aria-expanded="false"><i class="icon icon-world-2"></i><span class="nav-text">Kategori Perilaku</span></a></li>
                    <li><a href="<?php echo $base_url; ?>admin/prediksi.php" aria-expanded="false"><i class="icon icon-chart-bar-33"></i><span class="nav-text">Hasil Prediksi</span></a></li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-layout-25"></i><span class="nav-text">Laporan</span></a>
                        <ul aria-expanded="false">
                            <li><a href="<?php echo $base_url; ?>admin/laporan/laporan_lansia.php">Laporan Lansia</a></li>
                            <li><a href="<?php echo $base_url; ?>admin/laporan/laporan_aktivitas.php">Laporan Aktivitas</a></li>
                            <li><a href="<?php echo $base_url; ?>admin/laporan/laporan_prediksi.php">Laporan Prediksi</a></li>
                            <li><a href="<?php echo $base_url; ?>admin/laporan/evaluasi_perilaku.php">Evaluasi Perilaku</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if ($_SESSION['role'] == 'petugas'): ?>
                    <li class="nav-label">Petugas Menu</li>
                    <li><a href="<?php echo $base_url; ?>petugas/aktivitas.php" aria-expanded="false"><i class="icon icon-form"></i><span class="nav-text">Input Aktivitas</span></a></li>
                    <li><a href="<?php echo $base_url; ?>petugas/kondisi_perilaku.php" aria-expanded="false"><i class="icon icon-form"></i><span class="nav-text">Kondisi Perilaku</span></a></li>
                    <li><a href="<?php echo $base_url; ?>petugas/prediksi.php" aria-expanded="false"><i class="icon icon-chart-bar-33"></i><span class="nav-text">Hasil Prediksi</span></a></li>
                    <?php endif; ?>

                    <?php if ($_SESSION['role'] == 'kepala_uptd'): ?>
                    <li class="nav-label">Kepala UPTD Menu</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-layout-25"></i><span class="nav-text">Laporan</span></a>
                        <ul aria-expanded="false">
                            <li><a href="<?php echo $base_url; ?>kepala_uptd/laporan/data_lansia.php">Data Lansia</a></li>
                            <li><a href="<?php echo $base_url; ?>kepala_uptd/laporan/aktivitas_lansia.php">Aktivitas Lansia</a></li>
                            <li><a href="<?php echo $base_url; ?>kepala_uptd/laporan/hasil_prediksi.php">Hasil Prediksi</a></li>
                            <li><a href="<?php echo $base_url; ?>kepala_uptd/laporan/evaluasi_pelayanan.php">Evaluasi Pelayanan</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo $base_url; ?>kepala_uptd/statistik.php" aria-expanded="false"><i class="icon icon-chart-bar-33"></i><span class="nav-text">Statistik</span></a></li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
