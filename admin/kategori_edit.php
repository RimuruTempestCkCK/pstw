<?php
include '../koneksi.php';
include '../session.php';
checkLogin();
checkRole('admin');

$id = $_GET['id'];
$row = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM kategori_perilaku WHERE id_kategori='$id'"));

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Edit Kategori Perilaku</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="../proses/kategori_proses.php?aksi=edit" method="POST">
                            <input type="hidden" name="id_kategori" value="<?php echo $row['id_kategori']; ?>">
                            <div class="form-group">
                                <label>Nama Kategori</label>
                                <input type="text" name="nama_kategori" class="form-control" value="<?php echo $row['nama_kategori']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea name="keterangan" class="form-control" rows="4"><?php echo $row['keterangan']; ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <a href="kategori_perilaku.php" class="btn btn-light">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
