<?php
include '../koneksi.php';
include '../session.php';
checkLogin();

// Get activities that haven't been predicted yet
$query = "SELECT a.*, l.nama_lansia 
          FROM aktivitas_lansia a 
          JOIN lansia l ON a.id_lansia = l.id_lansia 
          LEFT JOIN prediksi p ON a.id_aktivitas = p.id_aktivitas 
          WHERE p.id_prediksi IS NULL 
          ORDER BY a.tanggal DESC";
$result = mysqli_query($koneksi, $query);

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Mulai Prediksi Baru</h4>
                    <p class="mb-0">Pilih aktivitas lansia untuk dianalisis</p>
                </div>
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
                                        <th>Tanggal</th>
                                        <th>Nama Lansia</th>
                                        <th>Aktivitas Fisik</th>
                                        <th>Emosional</th>
                                        <th>Sosial</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo $row['tanggal']; ?></td>
                                        <td><?php echo $row['nama_lansia']; ?></td>
                                        <td><?php echo $row['aktivitas_fisik']; ?></td>
                                        <td><?php echo $row['kondisi_emosional']; ?></td>
                                        <td><?php echo $row['interaksi_sosial']; ?></td>
                                        <td>
                                            <a href="../proses/prediksi_proses.php?aksi=proses&id_aktivitas=<?php echo $row['id_aktivitas']; ?>" class="btn btn-primary btn-sm">Proses Prediksi</a>
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
