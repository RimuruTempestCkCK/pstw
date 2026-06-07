<?php
include '../koneksi.php';
include '../session.php';
checkLogin();
checkRole('admin');

$id = $_GET['id'];
$row = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM lansia WHERE id_lansia='$id'"));

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Edit Lansia</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="../proses/lansia_proses.php?aksi=edit" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_lansia" value="<?php echo $row['id_lansia']; ?>">
                            <div class="form-group">
                                <label>Nama Lansia</label>
                                <input type="text" name="nama_lansia" class="form-control" value="<?php echo $row['nama_lansia']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Umur</label>
                                <input type="number" name="umur" class="form-control" value="<?php echo $row['umur']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="L" <?php echo $row['jenis_kelamin'] == 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                                    <option value="P" <?php echo $row['jenis_kelamin'] == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kondisi Kesehatan</label>
                                <input type="text" name="kondisi_health" class="form-control" value="<?php echo $row['kondisi_health']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Status Sosial</label>
                                <input type="text" name="status_social" class="form-control" value="<?php echo $row['status_sosial']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Foto (Kosongkan jika tidak ingin mengubah)</label>
                                <input type="file" name="foto" class="form-control-file">
                                <?php if ($row['foto']): ?>
                                    <p class="mt-2">Foto saat ini: <br>
                                    <img src="<?php echo $base_url; ?>uploads/foto_lansia/<?php echo $row['foto']; ?>" width="100"></p>
                                <?php endif; ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="lansia.php" class="btn btn-light">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
