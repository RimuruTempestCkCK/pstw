<?php
include '../koneksi.php';
include '../session.php';
checkLogin();
checkRole('admin');

$query = "SELECT * FROM users ORDER BY created_at DESC";
$result = mysqli_query($koneksi, $query);

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Data Pengguna</h4>
                    <p class="mb-0">Manajemen akses sistem</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <a href="users_tambah.php" class="btn btn-primary">Tambah Pengguna</a>
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
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Dibuat Pada</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo $row['nama']; ?></td>
                                        <td><?php echo $row['username']; ?></td>
                                        <td><?php echo ucfirst($row['role']); ?></td>
                                        <td><?php echo $row['created_at']; ?></td>
                                        <td>
                                            <a href="users_edit.php?id=<?php echo $row['id_user']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <?php if ($row['id_user'] != $_SESSION['id_user']): ?>
                                                <a href="users_hapus.php?id=<?php echo $row['id_user']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pengguna ini?')">Hapus</a>
                                            <?php endif; ?>
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
