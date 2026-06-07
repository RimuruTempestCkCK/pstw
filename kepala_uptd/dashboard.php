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
                    <h4>Dashboard Kepala UPTD</h4>
                    <p class="mb-0">Ringkasan operasional PSTW</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total Lansia</div>
                            <div class="stat-digit"><?php echo $total_lansia; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total Aktivitas</div>
                            <div class="stat-digit"><?php echo $total_aktivitas; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text">Total Prediksi Perilaku</div>
                            <div class="stat-digit"><?php echo $total_prediksi; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Statistik Perilaku Lansia</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="perilakuChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

<script>
    // Simple Chart.js integration
    var ctx = document.getElementById('perilakuChart').getContext('2d');
    <?php
    $labels = [];
    $data_counts = [];
    $chart_query = mysqli_query($koneksi, "SELECT hasil_prediksi, COUNT(*) as count FROM prediksi GROUP BY hasil_prediksi");
    while($c = mysqli_fetch_assoc($chart_query)) {
        $labels[] = $c['hasil_prediksi'];
        $data_counts[] = $c['count'];
    }
    ?>
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                label: 'Jumlah Lansia',
                data: <?php echo json_encode($data_counts); ?>,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        }
    });
</script>
