<?php
include '../koneksi.php';
include '../session.php';
checkLogin();
checkRole('petugas');

$query = "SELECT p.*, l.nama_lansia, l.umur, l.jenis_kelamin, l.foto, 
          a.tanggal as tgl_aktivitas, a.aktivitas_fisik, a.kondisi_emosional, 
          a.interaksi_sosial, a.kehadiran_kegiatan, a.pola_makan, a.kesehatan_harian 
          FROM prediksi p 
          JOIN lansia l ON p.id_lansia = l.id_lansia 
          JOIN aktivitas_lansia a ON p.id_aktivitas = a.id_aktivitas 
          ORDER BY p.tanggal_prediksi DESC";
$result = mysqli_query($koneksi, $query);

include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Kondisi Perilaku Lansia</h4>
                    <p class="mb-0">Hasil analisis prediksi perilaku</p>
                </div>
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
                                        <th>Tanggal Prediksi</th>
                                        <th>Nama Lansia</th>
                                        <th>Hasil Prediksi</th>
                                        <th>Akurasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo $row['tanggal_prediksi']; ?></td>
                                        <td><?php echo $row['nama_lansia']; ?></td>
                                        <td>
                                            <span class="badge badge-info"><?php echo $row['hasil_prediksi']; ?></span>
                                        </td>
                                        <td><?php echo $row['akurasi']; ?>%</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm btn-detail" 
                                                data-toggle="modal" 
                                                data-target="#modalDetail"
                                                data-id="<?php echo $row['id_prediksi']; ?>"
                                                data-nama="<?php echo $row['nama_lansia']; ?>"
                                                data-umur="<?php echo $row['umur']; ?>"
                                                data-jk="<?php echo $row['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?>"
                                                data-foto="<?php echo $row['foto']; ?>"
                                                data-fisik="<?php echo $row['aktivitas_fisik']; ?>"
                                                data-emosi="<?php echo $row['kondisi_emosional']; ?>"
                                                data-sosial="<?php echo $row['interaksi_sosial']; ?>"
                                                data-hadir="<?php echo $row['kehadiran_kegiatan']; ?>"
                                                data-makan="<?php echo $row['pola_makan']; ?>"
                                                data-sehat="<?php echo $row['kesehatan_harian']; ?>"
                                                data-hasil="<?php echo $row['hasil_prediksi']; ?>"
                                                data-akurasi="<?php echo $row['akurasi']; ?>"
                                                data-tgl="<?php echo $row['tanggal_prediksi']; ?>">
                                                Detail
                                            </button>
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

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Hasil Prediksi</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Data Lansia -->
                    <div class="col-lg-4">
                        <div class="card border">
                            <div class="card-header bg-light">
                                <h4 class="card-title mb-0">Data Lansia</h4>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <img id="detail-foto" src="" width="150" class="rounded-circle border">
                                </div>
                                <table class="table table-sm">
                                    <tr>
                                        <th>Nama</th>
                                        <td>: <span id="detail-nama"></span></td>
                                    </tr>
                                    <tr>
                                        <th>Umur</th>
                                        <td>: <span id="detail-umur"></span> Tahun</td>
                                    </tr>
                                    <tr>
                                        <th>Gender</th>
                                        <td>: <span id="detail-jk"></span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Analisis -->
                    <div class="col-lg-8">
                        <div class="card border">
                            <div class="card-header bg-light">
                                <h4 class="card-title mb-0">Detail Analisis</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Data Aktivitas (Input)</h5>
                                        <hr>
                                        <table class="table table-bordered table-sm">
                                            <tr><th>Aktivitas Fisik</th><td id="detail-fisik"></td></tr>
                                            <tr><th>Emosional</th><td id="detail-emosi"></td></tr>
                                            <tr><th>Sosial</th><td id="detail-sosial"></td></tr>
                                            <tr><th>Kehadiran</th><td id="detail-hadir"></td></tr>
                                            <tr><th>Pola Makan</th><td id="detail-makan"></td></tr>
                                            <tr><th>Kesehatan</th><td id="detail-sehat"></td></tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <h5>Hasil Prediksi</h5>
                                        <hr>
                                        <div class="alert alert-info mt-4 py-4">
                                            <h3 class="mb-0" id="detail-hasil"></h3>
                                            <p class="mb-0 mt-2">Tingkat Akurasi: <span id="detail-akurasi"></span>%</p>
                                        </div>
                                        <p class="mt-4"><i>Prediksi dilakukan pada: <br><span id="detail-tgl"></span></i></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>

<script>
$(document).ready(function() {
    $('.btn-detail').on('click', function() {
        const data = $(this).data();
        
        // Lansia Info
        $('#detail-nama').text(data.nama);
        $('#detail-umur').text(data.umur);
        $('#detail-jk').text(data.jk);
        
        if (data.foto) {
            $('#detail-foto').attr('src', '<?php echo $base_url; ?>uploads/foto_lansia/' + data.foto);
        } else {
            $('#detail-foto').attr('src', '<?php echo $base_url; ?>images/avatar/1.png');
        }

        // Aktivitas Info
        $('#detail-fisik').text(data.fisik);
        $('#detail-emosi').text(data.emosi);
        $('#detail-sosial').text(data.sosial);
        $('#detail-hadir').text(data.hadir);
        $('#detail-makan').text(data.makan);
        $('#detail-sehat').text(data.sehat);

        // Hasil Info
        $('#detail-hasil').text(data.hasil);
        $('#detail-akurasi').text(data.akurasi);
        $('#detail-tgl').text(data.tgl);
    });
});
</script>
