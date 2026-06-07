<?php
include '../../koneksi.php';
include '../../session.php';
checkLogin();
checkRole('kepala_uptd');

$query = "SELECT p.*, l.nama_lansia, a.tanggal 
          FROM prediksi p 
          JOIN lansia l ON p.id_lansia = l.id_lansia 
          JOIN aktivitas_lansia a ON p.id_aktivitas = a.id_aktivitas 
          ORDER BY p.tanggal_prediksi DESC";
$result = mysqli_query($koneksi, $query);

include '../../includes/header.php';
include '../../includes/sidebar.php';
?>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Laporan Hasil Prediksi</h4>
                    <span class="ml-1">PSTW Kasih Sayang Ibu</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Laporan</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Hasil Prediksi</a></li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Hasil Analisis Perilaku</h4>
                        <button onclick="window.print()" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Cetak Laporan</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Analisis</th>
                                        <th>Nama Lansia</th>
                                        <th>Tanggal Aktivitas</th>
                                        <th>Hasil Prediksi</th>
                                        <th>Akurasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($row['tanggal_prediksi'])); ?></td>
                                        <td><?php echo $row['nama_lansia']; ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($row['tanggal'])); ?></td>
                                        <td>
                                            <span class="badge badge-outline-primary"><?php echo $row['hasil_prediksi']; ?></span>
                                        </td>
                                        <td><strong><?php echo $row['akurasi']; ?>%</strong></td>
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

<style>
@media print {
    .header, .quixnav, .footer, .nav-header, .page-titles, .card-header button, .btn {
        display: none !important;
    }
    .content-body {
        margin-left: 0 !important;
        padding: 0 !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
    .card-body {
        padding: 0 !important;
    }
    .table-responsive {
        overflow: visible !important;
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
