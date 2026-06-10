<?php
include 'koneksi.php';
include 'session.php';
checkLogin();

$role = $_SESSION['role'];
$user_id = $_SESSION['id_user'];

if ($role == 'kepala_uptd') {
    header("Location: kepala_uptd/dashboard.php");
    exit();
}

// General Statistics
$total_lansia = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM lansia"))['count'];
$total_aktivitas = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM aktivitas_lansia"))['count'];
$total_prediksi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM prediksi"))['count'];
$total_users = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM users"))['count'];

// Role Specific Data
if ($role == 'petugas') {
    $my_aktivitas = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM aktivitas_lansia WHERE created_by = '$user_id'"))['count'];
    $my_lansia_handled = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(DISTINCT id_lansia) as count FROM aktivitas_lansia WHERE created_by = '$user_id'"))['count'];
}

include 'includes/header.php';
include 'includes/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4 class="text-primary">Dashboard Overview</h4>
                    <p class="mb-0">Selamat datang kembali, <strong><?php echo $_SESSION['nama']; ?></strong></p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">App</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
                </ol>
            </div>
        </div>

        <?php if ($role == 'admin'): ?>
        <!-- Admin Professional Dashboard -->
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card bg-primary text-white border-0 shadow-sm">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text text-white">Total Lansia</div>
                            <div class="stat-digit text-white"> <i class="fa fa-users mr-2"></i><?php echo $total_lansia; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card bg-primary text-white border-0 shadow-sm">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text text-white">Aktivitas Tercatat</div>
                            <div class="stat-digit text-white"> <i class="fa fa-tasks mr-2"></i><?php echo $total_aktivitas; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card bg-primary text-white border-0 shadow-sm">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text text-white">Hasil Prediksi</div>
                            <div class="stat-digit text-white"> <i class="fa fa-chart-pie mr-2"></i><?php echo $total_prediksi; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card bg-primary text-white border-0 shadow-sm">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text text-white">Total Pengguna</div>
                            <div class="stat-digit text-white"> <i class="fa fa-user-circle mr-2"></i><?php echo $total_users; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom">
                        <h4 class="card-title text-dark">Laju Pencatatan Aktivitas (7 Hari)</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="aktivitasTrendChart" height="300"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom">
                        <h4 class="card-title text-dark">Kondisi Lansia</h4>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="position: relative; height:250px;">
                            <canvas id="perilakuDistChart"></canvas>
                        </div>
                        <div class="mt-4">
                            <?php
                            $q_p = mysqli_query($koneksi, "SELECT hasil_prediksi, COUNT(*) as count FROM prediksi GROUP BY hasil_prediksi");
                            $total_p = mysqli_num_rows($q_p) > 0 ? $total_prediksi : 1;
                            $colors = ['text-primary', 'text-warning', 'text-success', 'text-danger'];
                            $i = 0;
                            while($r = mysqli_fetch_assoc($q_p)):
                                $pct = round(($r['count'] / $total_prediksi) * 100);
                            ?>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-dark"><i class="fa fa-circle mr-2 <?php echo $colors[$i % 4]; ?>"></i> <?php echo $r['hasil_prediksi']; ?></span>
                                <span class="font-weight-bold"><?php echo $pct; ?>%</span>
                            </div>
                            <?php $i++; endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php elseif ($role == 'petugas'): ?>
        <!-- Petugas Professional Dashboard -->
        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="card-body p-0">
                        <div class="px-4 py-4 bg-primary text-white">
                            <h5 class="text-white opacity-70 mb-2">Produktivitas Saya</h5>
                            <h2 class="text-white mb-0"><?php echo $my_aktivitas; ?> <small style="font-size: 14px">Aktivitas</small></h2>
                        </div>
                        <div class="px-4 py-3 bg-white">
                            <span class="text-muted">Total aktivitas yang telah diinput</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="card-body p-0">
                        <div class="px-4 py-4 bg-primary text-white">
                            <h5 class="text-white opacity-70 mb-2">Lansia Dipantau</h5>
                            <h2 class="text-white mb-0"><?php echo $my_lansia_handled; ?> <small style="font-size: 14px">Orang</small></h2>
                        </div>
                        <div class="px-4 py-3 bg-white">
                            <span class="text-muted">Lansia unik dalam catatan Anda</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="card-body p-0">
                        <div class="px-4 py-4 bg-primary text-white">
                            <h5 class="text-white opacity-70 mb-2">Total Lansia</h5>
                            <h2 class="text-white mb-0"><?php echo $total_lansia; ?> <small style="font-size: 14px">Total</small></h2>
                        </div>
                        <div class="px-4 py-3 bg-white">
                            <span class="text-muted">Populasi lansia di sistem</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom d-flex justify-content-between">
                        <h4 class="card-title">Pencatatan Aktivitas Terbaru</h4>
                        <a href="petugas/aktivitas.php" class="btn btn-primary btn-sm">Lihat Semua</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nama Lansia</th>
                                        <th>Kondisi Kesehatan</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $recent_query = mysqli_query($koneksi, "SELECT a.*, l.nama_lansia FROM aktivitas_lansia a JOIN lansia l ON a.id_lansia = l.id_lansia WHERE a.created_by = '$user_id' ORDER BY a.tanggal DESC LIMIT 5");
                                    if(mysqli_num_rows($recent_query) > 0):
                                        while($recent = mysqli_fetch_assoc($recent_query)):
                                    ?>
                                    <tr>
                                        <td><span class="text-dark font-weight-bold"><?php echo date('d M Y', strtotime($recent['tanggal'])); ?></span></td>
                                        <td><?php echo $recent['nama_lansia']; ?></td>
                                        <td><?php echo $recent['kesehatan_harian']; ?></td>
                                        <td><span class="badge badge-success px-3">Tersimpan</span></td>
                                    </tr>
                                    <?php 
                                        endwhile;
                                    else:
                                    ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-4">Belum ada aktivitas yang dicatat.</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<?php if ($role == 'admin'): ?>
<script>
    // Behavior Distribution Chart
    var ctxPerilaku = document.getElementById('perilakuDistChart').getContext('2d');
    <?php
    $labels_p = []; $data_p = [];
    $q_p = mysqli_query($koneksi, "SELECT hasil_prediksi, COUNT(*) as count FROM prediksi GROUP BY hasil_prediksi");
    while($r = mysqli_fetch_assoc($q_p)) {
        $labels_p[] = $r['hasil_prediksi'];
        $data_p[] = $r['count'];
    }
    ?>
    new Chart(ctxPerilaku, {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($labels_p); ?>,
            datasets: [{
                data: <?php echo json_encode($data_p); ?>,
                backgroundColor: ['#4d7cff', '#ff9f43', '#1bc5bd', '#f64e60'],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: { 
            responsive: true, 
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            cutout: '70%'
        }
    });

    // Activity Trend Chart (Last 7 Days)
    var ctxTrend = document.getElementById('aktivitasTrendChart').getContext('2d');
    <?php
    $labels_t = []; $data_t = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = date('Y-m-d', strtotime("-$i days"));
        $labels_t[] = date('d M', strtotime($date));
        $q_t = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM aktivitas_lansia WHERE tanggal = '$date'"));
        $data_t[] = $q_t['count'];
    }
    ?>
    new Chart(ctxTrend, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($labels_t); ?>,
            datasets: [{
                label: 'Jumlah Aktivitas',
                data: <?php echo json_encode($data_t); ?>,
                borderColor: '#4d7cff',
                backgroundColor: 'rgba(77, 124, 255, 0.1)',
                borderWidth: 3,
                pointBackgroundColor: '#4d7cff',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: { 
                y: { 
                    beginAtZero: true, 
                    ticks: { stepSize: 1, color: '#999' },
                    grid: { borderDash: [5, 5], color: '#eee' }
                },
                x: {
                    ticks: { color: '#999' },
                    grid: { display: false }
                }
            }
        }
    });
</script>
<?php endif; ?>
