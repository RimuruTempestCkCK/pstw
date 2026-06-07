<?php
include '../../koneksi.php';
include '../../session.php';
checkLogin();
checkRole('kepala_uptd');

$query = "SELECT hasil_prediksi, COUNT(*) as jumlah FROM prediksi GROUP BY hasil_prediksi";
$result = mysqli_query($koneksi, $query);

include '../../includes/header.php';
include '../../includes/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Evaluasi Pelayanan & Perilaku</h4>
                    <span class="ml-1">PSTW Kasih Sayang Ibu</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Laporan</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Evaluasi</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ringkasan Kondisi Lansia</h4>
                        <button onclick="window.print()" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Cetak</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="bg-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori Perilaku</th>
                                        <th>Jumlah Kasus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['hasil_prediksi']; ?></td>
                                        <td><strong><?php echo $row['jumlah']; ?></strong> Orang</td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informasi Evaluasi</h4>
                    </div>
                    <div class="card-body">
                        <p>Laporan ini menyajikan ringkasan kondisi perilaku lansia berdasarkan data terbaru yang diinputkan oleh petugas lapangan dan dianalisis menggunakan sistem cerdas.</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Total Data Dianalisis
                                <?php
                                $total_q = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM prediksi"));
                                ?>
                                <span class="badge badge-primary badge-pill"><?php echo $total_q['total']; ?></span>
                            </li>
                            <li class="list-group-item">
                                <small class="text-muted">Gunakan data ini sebagai dasar pengambilan kebijakan pelayanan harian di PSTW.</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .header, .quixnav, .footer, .nav-header, .page-titles, .card-header button, .btn, .col-lg-6:last-child {
        display: none !important;
    }
    .content-body {
        margin-left: 0 !important;
        padding: 0 !important;
    }
    .col-lg-6 {
        width: 100% !important;
        max-width: 100% !important;
        flex: 0 0 100% !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
    table {
        width: 100% !important;
        border-collapse: collapse !important;
    }
    th, td {
        border: 1px solid #000 !important;
        padding: 8px !important;
    }
}
</style>

<?php include '../../includes/footer.php'; ?>
