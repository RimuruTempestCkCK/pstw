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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">Tambah Lansia</button>
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
                                            <button type="button" class="btn btn-warning btn-sm btn-edit" 
                                                data-toggle="modal" 
                                                data-target="#modalEdit"
                                                data-id="<?php echo $row['id_lansia']; ?>"
                                                data-nama="<?php echo $row['nama_lansia']; ?>"
                                                data-umur="<?php echo $row['umur']; ?>"
                                                data-jk="<?php echo $row['jenis_kelamin']; ?>"
                                                data-health="<?php echo $row['kondisi_health']; ?>"
                                                data-social="<?php echo $row['status_sosial']; ?>"
                                                data-foto="<?php echo $row['foto']; ?>">
                                                Edit
                                            </button>
                                            <a href="../proses/lansia_proses.php?aksi=hapus&id=<?php echo $row['id_lansia']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
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
                <h5 class="modal-title">Tambah Lansia</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="../proses/lansia_proses.php?aksi=tambah" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Lansia</label>
                        <input type="text" name="nama_lansia" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Umur</label>
                                <input type="number" name="umur" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
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
                <h5 class="modal-title">Edit Lansia</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="../proses/lansia_proses.php?aksi=edit" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id_lansia" id="edit-id">
                    <div class="form-group">
                        <label>Nama Lansia</label>
                        <input type="text" name="nama_lansia" id="edit-nama" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Umur</label>
                                <input type="number" name="umur" id="edit-umur" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="edit-jk" class="form-control" required>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Kondisi Kesehatan</label>
                        <input type="text" name="kondisi_health" id="edit-health" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Status Sosial</label>
                        <input type="text" name="status_social" id="edit-social" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Foto (Kosongkan jika tidak ingin mengubah)</label>
                        <input type="file" name="foto" class="form-control-file">
                        <div id="edit-foto-container" class="mt-2" style="display: none;">
                            <p>Foto saat ini:</p>
                            <img id="edit-foto-preview" src="" width="100">
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
        const nama = $(this).data('nama');
        const umur = $(this).data('umur');
        const jk = $(this).data('jk');
        const health = $(this).data('health');
        const social = $(this).data('social');
        const foto = $(this).data('foto');

        $('#edit-id').val(id);
        $('#edit-nama').val(nama);
        $('#edit-umur').val(umur);
        $('#edit-jk').val(jk);
        $('#edit-health').val(health);
        $('#edit-social').val(social);

        if (foto) {
            $('#edit-foto-preview').attr('src', '<?php echo $base_url; ?>uploads/foto_lansia/' + foto);
            $('#edit-foto-container').show();
        } else {
            $('#edit-foto-container').hide();
        }
    });
});
</script>
