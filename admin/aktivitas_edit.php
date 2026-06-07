<?php
include '../koneksi.php';
include '../session.php';
checkLogin();

$id = $_GET['id'];
$row = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM aktivitas_lansia WHERE id_aktivitas='$id'"));
$lansia_query = mysqli_query($koneksi, "SELECT * FROM lansia");

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Edit Aktivitas Lansia</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="../proses/aktivitas_proses.php?aksi=edit" method="POST">
                            <input type="hidden" name="id_aktivitas" value="<?php echo $row['id_aktivitas']; ?>">
                            <div class="form-group">
                                <label>Lansia</label>
                                <select name="id_lansia" class="form-control" required>
                                    <?php while ($l = mysqli_fetch_assoc($lansia_query)): ?>
                                        <option value="<?php echo $l['id_lansia']; ?>" <?php echo $l['id_lansia'] == $row['id_lansia'] ? 'selected' : ''; ?>><?php echo $l['nama_lansia']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" value="<?php echo $row['tanggal']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Aktivitas Fisik</label>
                                <input type="text" name="aktivitas_fisik" class="form-control" value="<?php echo $row['aktivitas_fisik']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Kondisi Emosional</label>
                                <input type="text" name="kondisi_emosional" class="form-control" value="<?php echo $row['kondisi_emosional']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Interaksi Sosial</label>
                                <input type="text" name="interaksi_sosial" class="form-control" value="<?php echo $row['interaksi_sosial']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Kehadiran Kegiatan</label>
                                <input type="text" name="kehadiran_kegiatan" class="form-control" value="<?php echo $row['kehadiran_kegiatan']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Pola Makan</label>
                                <input type="text" name="pola_makan" class="form-control" value="<?php echo $row['pola_makan']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Kesehatan Harian</label>
                                <input type="text" name="kesehatan_harian" class="form-control" value="<?php echo $row['kesehatan_harian']; ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="aktivitas.php" class="btn btn-light">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
