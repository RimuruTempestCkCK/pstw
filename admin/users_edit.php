<?php
include '../koneksi.php';
include '../session.php';
checkLogin();
checkRole('admin');

$id = $_GET['id'];
$row = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM users WHERE id_user='$id'"));

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Edit Pengguna</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="../proses/users_proses.php?aksi=edit" method="POST">
                            <input type="hidden" name="id_user" value="<?php echo $row['id_user']; ?>">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Password (Kosongkan jika tidak ingin mengubah)</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select name="role" class="form-control" required>
                                    <option value="admin" <?php echo $row['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                    <option value="petugas" <?php echo $row['role'] == 'petugas' ? 'selected' : ''; ?>>Petugas</option>
                                    <option value="kepala_uptd" <?php echo $row['role'] == 'kepala_uptd' ? 'selected' : ''; ?>>Kepala UPTD</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="users.php" class="btn btn-light">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
