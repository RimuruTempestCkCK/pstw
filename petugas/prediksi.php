<?php
include '../koneksi.php';
include '../session.php';
checkLogin();

$query = "SELECT p.*, l.nama_lansia, a.tanggal 
          FROM prediksi p 
          JOIN lansia l ON p.id_lansia = l.id_lansia 
          JOIN aktivitas_lansia a ON p.id_aktivitas = a.id_aktivitas 
          ORDER BY p.tanggal_prediksi DESC";
$result = mysqli_query($koneksi, $query);

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hasil Prediksi Pola Perilaku</h4>
                    <p class="mb-0">Hasil analisis menggunakan metode Random Forest</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <a href="prediksi_baru.php" class="btn btn-primary">Mulai Prediksi Baru</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>Tanggal Prediksi</th>
                                        <th>Nama Lansia</th>
                                        <th>Tanggal Aktivitas</th>
                                        <th>Hasil Prediksi</th>
                                        <th>Akurasi (%)</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo $row['tanggal_prediksi']; ?></td>
                                        <td><?php echo $row['nama_lansia']; ?></td>
                                        <td><?php echo $row['tanggal']; ?></td>
                                        <td>
                                            <span class="badge badge-info"><?php echo $row['hasil_prediksi']; ?></span>
                                        </td>
                                        <td><?php echo $row['akurasi']; ?>%</td>
                                        <td>
                                            <a href="prediksi_detail.php?id=<?php echo $row['id_prediksi']; ?>" class="btn btn-info btn-sm">Detail</a>
                                            <a href="../proses/prediksi_proses.php?aksi=hapus&id=<?php echo $row['id_prediksi']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus hasil prediksi ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
