<?php
include '../koneksi.php';
include '../session.php';
checkLogin();
checkRole('kepala_uptd');

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Statistik & Analitik</h4>
                    <p class="mb-0">Analisis mendalam data lansia</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Distribusi Perilaku</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="perilakuChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tren Aktivitas (7 Hari Terakhir)</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="trenChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

<script>
    // Perilaku Chart
    var ctx1 = document.getElementById('perilakuChart').getContext('2d');
    <?php
    $labels = [];
    $data_counts = [];
    $chart_query = mysqli_query($koneksi, "SELECT hasil_prediksi, COUNT(*) as count FROM prediksi GROUP BY hasil_prediksi");
    while($c = mysqli_fetch_assoc($chart_query)) {
        $labels[] = $c['hasil_prediksi'];
        $data_counts[] = $c['count'];
    }
    ?>
    new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                data: <?php echo json_encode($data_counts); ?>,
                backgroundColor: ['#4d7cff', '#7de311', '#ffc107', '#ff5252']
            }]
        }
    });

    // Tren Chart
    var ctx2 = document.getElementById('trenChart').getContext('2d');
    <?php
    $dates = [];
    $counts = [];
    for($i = 6; $i >= 0; $i--) {
        $date = date('Y-m-d', strtotime("-$i days"));
        $dates[] = $date;
        $q = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as count FROM aktivitas_lansia WHERE tanggal = '$date'"));
        $counts[] = $q['count'];
    }
    ?>
    new Chart(ctx2, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($dates); ?>,
            datasets: [{
                label: 'Jumlah Aktivitas',
                data: <?php echo json_encode($counts); ?>,
                borderColor: '#4d7cff',
                fill: false
            }]
        }
    });
</script>
