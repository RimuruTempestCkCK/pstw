<?php
include '../koneksi.php';
include '../session.php';
checkLogin();
checkRole('kepala_uptd');

// Fetch statistics
$total_lansia = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM lansia"))['count'];
$total_aktivitas = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM aktivitas_lansia"))['count'];
$total_prediksi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM prediksi"))['count'];

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4 class="text-primary">Executive Dashboard</h4>
                    <p class="mb-0">Analisis Kinerja Pelayanan & Kondisi Lansia</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">UPTD</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Executive Dashboard</a></li>
                </ol>
            </div>
        </div>

        <!-- Executive Summary Cards -->
        <div class="row">
            <div class="col-lg-4">
                <div class="card bg-primary text-white border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="text-white opacity-70 mb-2">Populasi Lansia</h5>
                                <h2 class="text-white mb-0"><?php echo $total_lansia; ?></h2>
                            </div>
                            <div class="icon-box bg-white-opacity-20 rounded p-3">
                                <i class="fa fa-users fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card bg-success text-white border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="text-white opacity-70 mb-2">Total Aktivitas</h5>
                                <h2 class="text-white mb-0"><?php echo $total_aktivitas; ?></h2>
                            </div>
                            <div class="icon-box bg-white-opacity-20 rounded p-3">
                                <i class="fa fa-heartbeat fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card bg-info text-white border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="text-white opacity-70 mb-2">Total Analisis</h5>
                                <h2 class="text-white mb-0"><?php echo $total_prediksi; ?></h2>
                            </div>
                            <div class="icon-box bg-white-opacity-20 rounded p-3">
                                <i class="fa fa-microscope fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h4 class="card-title text-dark">Proporsi Perilaku Lansia</h4>
                    </div>
                    <div class="card-body">
                        <div style="height: 300px;">
                            <canvas id="perilakuPieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h4 class="card-title text-dark">Volume Prediksi (6 Bulan)</h4>
                    </div>
                    <div class="card-body">
                        <div style="height: 300px;">
                            <canvas id="prediksiTrendChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service Evaluation Summary -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom">
                        <h4 class="card-title">Distribusi Real-time Kondisi Lansia</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php
                            $total_p = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM prediksi"))['count'];
                            $q_sum = mysqli_query($koneksi, "SELECT hasil_prediksi, COUNT(*) as count FROM prediksi GROUP BY hasil_prediksi");
                            $colors = ['bg-primary', 'bg-warning', 'bg-success', 'bg-danger'];
                            $i = 0;
                            while($sum = mysqli_fetch_assoc($q_sum)):
                                $percent = $total_p > 0 ? round(($sum['count'] / $total_p) * 100) : 0;
                            ?>
                            <div class="col-md-3 mb-3">
                                <div class="p-3 border rounded">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="text-dark font-weight-bold"><?php echo $sum['hasil_prediksi']; ?></span>
                                        <span class="badge badge-light"><?php echo $percent; ?>%</span>
                                    </div>
                                    <div class="progress" style="height: 6px">
                                        <div class="progress-bar <?php echo $colors[$i % 4]; ?>" style="width: <?php echo $percent; ?>%;" role="progressbar"></div>
                                    </div>
                                    <small class="text-muted mt-2 d-block"><?php echo $sum['count']; ?> Lansia Terdeteksi</small>
                                </div>
                            </div>
                            <?php $i++; endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-white-opacity-20 {
        background-color: rgba(255, 255, 255, 0.2);
    }
</style>

<?php include '../includes/footer.php'; ?>

<script>
    // Pie Chart with professional colors
    var ctxPie = document.getElementById('perilakuPieChart').getContext('2d');
    <?php
    $labels_pie = []; $data_pie = [];
    $q_pie = mysqli_query($koneksi, "SELECT hasil_prediksi, COUNT(*) as count FROM prediksi GROUP BY hasil_prediksi");
    while($r = mysqli_fetch_assoc($q_pie)) {
        $labels_pie[] = $r['hasil_prediksi'];
        $data_pie[] = $r['count'];
    }
    ?>
    new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($labels_pie); ?>,
            datasets: [{
                data: <?php echo json_encode($data_pie); ?>,
                backgroundColor: ['#4d7cff', '#ff9f43', '#1bc5bd', '#f64e60'],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: { 
            responsive: true, 
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // Monthly Trend Bar Chart
    var ctxBar = document.getElementById('prediksiTrendChart').getContext('2d');
    <?php
    $months = []; $data_m = [];
    for ($i = 5; $i >= 0; $i--) {
        $m = date('Y-m', strtotime("-$i months"));
        $months[] = date('M Y', strtotime($m));
        $q_m = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM prediksi WHERE DATE_FORMAT(tanggal_prediksi, '%Y-%m') = '$m'"));
        $data_m[] = $q_m['count'];
    }
    ?>
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($months); ?>,
            datasets: [{
                label: 'Jumlah Prediksi',
                data: <?php echo json_encode($data_m); ?>,
                backgroundColor: '#4d7cff',
                borderRadius: 5,
                barThickness: 20
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
                    grid: { borderDash: [5, 5] }
                },
                x: {
                    ticks: { color: '#999' },
                    grid: { display: false }
                }
            }
        }
    });
</script>
