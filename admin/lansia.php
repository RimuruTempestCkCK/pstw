<?php
include '../koneksi.php';
include '../session.php';
checkLogin();
checkRole('admin');

$query = "SELECT * FROM lansia ORDER BY created_at DESC";
$result = mysqli_query($koneksi, $query);

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Data Lansia</h4>
                    <p class="mb-0">Manajemen data lansia PSTW</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <a href="lansia_tambah.php" class="btn btn-primary">Tambah Lansia</a>
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
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Umur</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Kondisi Kesehatan</th>
                                        <th>Status Sosial</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td>
                                            <?php if ($row['foto']): ?>
                                                <img src="<?php echo $base_url; ?>uploads/foto_lansia/<?php echo $row['foto']; ?>" width="50" height="50" style="object-fit: cover;">
                                            <?php else: ?>
                                                <img src="<?php echo $base_url; ?>images/avatar/1.png" width="50" height="50">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $row['nama_lansia']; ?></td>
                                        <td><?php echo $row['umur']; ?></td>
                                        <td><?php echo $row['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
                                        <td><?php echo $row['kondisi_health']; ?></td>
                                        <td><?php echo $row['status_sosial']; ?></td>
                                        <td>
                                            <a href="lansia_edit.php?id=<?php echo $row['id_lansia']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="lansia_hapus.php?id=<?php echo $row['id_lansia']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
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
