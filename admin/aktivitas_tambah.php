<?php
include '../koneksi.php';
include '../session.php';
checkLogin();

$lansia_query = mysqli_query($koneksi, "SELECT * FROM lansia");

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Tambah Aktivitas Lansia</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="../proses/aktivitas_proses.php?aksi=tambah" method="POST">
                            <div class="form-group">
                                <label>Lansia</label>
                                <select name="id_lansia" class="form-control" required>
                                    <option value="">-- Pilih Lansia --</option>
                                    <?php while ($l = mysqli_fetch_assoc($lansia_query)): ?>
                                        <option value="<?php echo $l['id_lansia']; ?>"><?php echo $l['nama_lansia']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Aktivitas Fisik</label>
                                <input type="text" name="aktivitas_fisik" class="form-control" placeholder="Contoh: Jalan pagi, Senam">
                            </div>
                            <div class="form-group">
                                <label>Kondisi Emosional</label>
                                <input type="text" name="kondisi_emosional" class="form-control" placeholder="Contoh: Senang, Sedih, Cemas">
                            </div>
                            <div class="form-group">
                                <label>Interaksi Sosial</label>
                                <input type="text" name="interaksi_sosial" class="form-control" placeholder="Contoh: Mengobrol, Menyendiri">
                            </div>
                            <div class="form-group">
                                <label>Kehadiran Kegiatan</label>
                                <input type="text" name="kehadiran_kegiatan" class="form-control" placeholder="Contoh: Hadir, Tidak Hadir">
                            </div>
                            <div class="form-group">
                                <label>Pola Makan</label>
                                <input type="text" name="pola_makan" class="form-control" placeholder="Contoh: Baik, Kurang">
                            </div>
                            <div class="form-group">
                                <label>Kesehatan Harian</label>
                                <input type="text" name="kesehatan_harian" class="form-control" placeholder="Contoh: Sehat, Pusing, Demam">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="aktivitas.php" class="btn btn-light">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
