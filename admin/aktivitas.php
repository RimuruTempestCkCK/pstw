<?php
include '../koneksi.php';
include '../session.php';
checkLogin();
checkRole('admin');

$query = "SELECT a.*, l.nama_lansia, u.nama as petugas 
          FROM aktivitas_lansia a 
          JOIN lansia l ON a.id_lansia = l.id_lansia 
          JOIN users u ON a.created_by = u.id_user 
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
                    <h4>Aktivitas Lansia</h4>
                    <p class="mb-0">Riwayat aktivitas harian lansia</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <a href="aktivitas_tambah.php" class="btn btn-primary">Tambah Aktivitas</a>
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
                                        <th>Kehadiran</th>
                                        <th>Makan</th>
                                        <th>Kesehatan</th>
                                        <th>Petugas</th>
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
                                        <td><?php echo $row['kehadiran_kegiatan']; ?></td>
                                        <td><?php echo $row['pola_makan']; ?></td>
                                        <td><?php echo $row['kesehatan_harian']; ?></td>
                                        <td><?php echo $row['petugas']; ?></td>
                                        <td>
                                            <a href="aktivitas_edit.php?id=<?php echo $row['id_aktivitas']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="aktivitas_hapus.php?id=<?php echo $row['id_aktivitas']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
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
