<?php
include '../koneksi.php';
include '../session.php';
checkLogin();
checkRole('admin');

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Tambah Lansia</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="../proses/lansia_proses.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Nama Lansia</label>
                                <input type="text" name="nama_lansia" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Umur</label>
                                <input type="number" name="umur" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kondisi Kesehatan</label>
                                <input type="text" name="kondisi_health" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Status Sosial</label>
                                <input type="text" name="status_social" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Foto</label>
                                <input type="file" name="foto" class="form-control-file">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="lansia.php" class="btn btn-light">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
