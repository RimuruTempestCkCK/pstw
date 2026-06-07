<?php
include '../koneksi.php';
include '../session.php';
checkLogin();

$id = $_GET['id'];
$query = "SELECT p.*, l.*, a.* 
          FROM prediksi p 
          JOIN lansia l ON p.id_lansia = l.id_lansia 
          JOIN aktivitas_lansia a ON p.id_aktivitas = a.id_aktivitas 
          WHERE p.id_prediksi = '$id'";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Detail Hasil Prediksi</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Lansia</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <?php if ($data['foto']): ?>
                                <img src="<?php echo $base_url; ?>uploads/foto_lansia/<?php echo $data['foto']; ?>" width="150" class="rounded-circle">
                            <?php else: ?>
                                <img src="<?php echo $base_url; ?>images/avatar/1.png" width="150" class="rounded-circle">
                            <?php endif; ?>
                        </div>
                        <table class="table">
                            <tr>
                                <th>Nama</th>
                                <td>: <?php echo $data['nama_lansia']; ?></td>
                            </tr>
                            <tr>
                                <th>Umur</th>
                                <td>: <?php echo $data['umur']; ?> Tahun</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>: <?php echo $data['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Detail Analisis</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Data Aktivitas (Input)</h5>
                                <hr>
                                <table class="table table-bordered">
                                    <tr><th>Aktivitas Fisik</th><td><?php echo $data['aktivitas_fisik']; ?></td></tr>
                                    <tr><th>Emosional</th><td><?php echo $data['kondisi_emosional']; ?></td></tr>
                                    <tr><th>Sosial</th><td><?php echo $data['interaksi_sosial']; ?></td></tr>
                                    <tr><th>Kehadiran</th><td><?php echo $data['kehadiran_kegiatan']; ?></td></tr>
                                    <tr><th>Pola Makan</th><td><?php echo $data['pola_makan']; ?></td></tr>
                                    <tr><th>Kesehatan</th><td><?php echo $data['kesehatan_harian']; ?></td></tr>
                                </table>
                            </div>
                            <div class="col-md-6 text-center">
                                <h5>Hasil Prediksi</h5>
                                <hr>
                                <div class="alert alert-info mt-4">
                                    <h3><?php echo $data['hasil_prediksi']; ?></h3>
                                    <p>Tingkat Akurasi: <?php echo $data['akurasi']; ?>%</p>
                                </div>
                                <p class="mt-4"><i>Prediksi dilakukan pada: <br><?php echo $data['tanggal_prediksi']; ?></i></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="prediksi.php" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
