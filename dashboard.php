<?php
include 'koneksi.php';
include 'session.php';
checkLogin();

// Fetch statistics
$total_lansia = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM lansia"))['count'];
$total_aktivitas = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM aktivitas_lansia"))['count'];
$total_prediksi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM prediksi"))['count'];
$total_users = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM users"))['count'];

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total Lansia</div>
                            <div class="stat-digit"><?php echo $total_lansia; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total Aktivitas</div>
                            <div class="stat-digit"><?php echo $total_aktivitas; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total Prediksi</div>
                            <div class="stat-digit"><?php echo $total_prediksi; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total Pengguna</div>
                            <div class="stat-digit"><?php echo $total_users; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Selamat Datang, <?php echo $_SESSION['nama']; ?>!</h4>
                    </div>
                    <div class="card-body">
                        <p>Anda login sebagai <strong><?php echo ucfirst($_SESSION['role']); ?></strong>. Gunakan menu di sebelah kiri untuk mengelola data sistem.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
