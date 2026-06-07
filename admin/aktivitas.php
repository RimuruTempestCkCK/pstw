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

$lansia_query = mysqli_query($koneksi, "SELECT * FROM lansia ORDER BY nama_lansia ASC");
$lansia_list = [];
while ($l = mysqli_fetch_assoc($lansia_query)) {
    $lansia_list[] = $l;
}

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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">Tambah Aktivitas</button>
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
                                            <button type="button" class="btn btn-warning btn-sm btn-edit" 
                                                data-toggle="modal" 
                                                data-target="#modalEdit"
                                                data-id="<?php echo $row['id_aktivitas']; ?>"
                                                data-lansia="<?php echo $row['id_lansia']; ?>"
                                                data-tgl="<?php echo $row['tanggal']; ?>"
                                                data-fisik="<?php echo $row['aktivitas_fisik']; ?>"
                                                data-emosi="<?php echo $row['kondisi_emosional']; ?>"
                                                data-sosial="<?php echo $row['interaksi_sosial']; ?>"
                                                data-hadir="<?php echo $row['kehadiran_kegiatan']; ?>"
                                                data-makan="<?php echo $row['pola_makan']; ?>"
                                                data-sehat="<?php echo $row['kesehatan_harian']; ?>">
                                                Edit
                                            </button>
                                            <a href="../proses/aktivitas_proses.php?aksi=hapus&id=<?php echo $row['id_aktivitas']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
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

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Aktivitas Lansia</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="../proses/aktivitas_proses.php?aksi=tambah" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lansia</label>
                                <select name="id_lansia" class="form-control" required>
                                    <option value="">-- Pilih Lansia --</option>
                                    <?php foreach ($lansia_list as $l): ?>
                                        <option value="<?php echo $l['id_lansia']; ?>"><?php echo $l['nama_lansia']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Aktivitas Fisik</label>
                                <input type="text" name="aktivitas_fisik" class="form-control" placeholder="Contoh: Jalan pagi, Senam">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kondisi Emosional</label>
                                <input type="text" name="kondisi_emosional" class="form-control" placeholder="Contoh: Senang, Sedih, Cemas">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Interaksi Sosial</label>
                                <input type="text" name="interaksi_sosial" class="form-control" placeholder="Contoh: Mengobrol, Menyendiri">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kehadiran Kegiatan</label>
                                <input type="text" name="kehadiran_kegiatan" class="form-control" placeholder="Contoh: Hadir, Tidak Hadir">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pola Makan</label>
                                <input type="text" name="pola_makan" class="form-control" placeholder="Contoh: Baik, Kurang">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kesehatan Harian</label>
                                <input type="text" name="kesehatan_harian" class="form-control" placeholder="Contoh: Sehat, Pusing, Demam">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Aktivitas Lansia</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="../proses/aktivitas_proses.php?aksi=edit" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_aktivitas" id="edit-id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Lansia</label>
                                <select name="id_lansia" id="edit-lansia" class="form-control" required>
                                    <?php foreach ($lansia_list as $l): ?>
                                        <option value="<?php echo $l['id_lansia']; ?>"><?php echo $l['nama_lansia']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" id="edit-tgl" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Aktivitas Fisik</label>
                                <input type="text" name="aktivitas_fisik" id="edit-fisik" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kondisi Emosional</label>
                                <input type="text" name="kondisi_emosional" id="edit-emosi" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Interaksi Sosial</label>
                                <input type="text" name="interaksi_sosial" id="edit-sosial" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kehadiran Kegiatan</label>
                                <input type="text" name="kehadiran_kegiatan" id="edit-hadir" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pola Makan</label>
                                <input type="text" name="pola_makan" id="edit-makan" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kesehatan Harian</label>
                                <input type="text" name="kesehatan_harian" id="edit-sehat" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

<script>
$(document).ready(function() {
    $('.btn-edit').on('click', function() {
        const id = $(this).data('id');
        const lansia = $(this).data('lansia');
        const tgl = $(this).data('tgl');
        const fisik = $(this).data('fisik');
        const emosi = $(this).data('emosi');
        const sosial = $(this).data('sosial');
        const hadir = $(this).data('hadir');
        const makan = $(this).data('makan');
        const sehat = $(this).data('sehat');

        $('#edit-id').val(id);
        $('#edit-lansia').val(lansia);
        $('#edit-tgl').val(tgl);
        $('#edit-fisik').val(fisik);
        $('#edit-emosi').val(emosi);
        $('#edit-sosial').val(sosial);
        $('#edit-hadir').val(hadir);
        $('#edit-makan').val(makan);
        $('#edit-sehat').val(sehat);
    });
});
</script>
