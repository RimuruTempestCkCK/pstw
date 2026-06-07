<?php
include '../../koneksi.php';
include '../../session.php';
checkLogin();
checkRole('admin');

$tgl_mulai = isset($_GET['tgl_mulai']) ? $_GET['tgl_mulai'] : '2000-01-01';
$tgl_selesai = isset($_GET['tgl_selesai']) ? $_GET['tgl_selesai'] : date('Y-m-d');

$query = "SELECT * FROM lansia 
          WHERE DATE(created_at) BETWEEN '$tgl_mulai' AND '$tgl_selesai'
          ORDER BY nama_lansia ASC";
$result = mysqli_query($koneksi, $query);

include '../../includes/header.php';
include '../../includes/sidebar.php';
?>

<style>
    @media print {
        .header, .quixnav, .footer, .page-titles, .filter-section, .no-print {
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
        .main-wrapper {
            margin: 0 !important;
        }
        .container-fluid {
            padding: 0 !important;
        }
        .print-header {
            display: block !important;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100% !important;
            border-collapse: collapse !important;
        }
        th, td {
            border: 1px solid #000 !important;
            padding: 5px !important;
            font-size: 12px !important;
        }
    }
    .print-header {
        display: none;
    }
</style>

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0 no-print">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Laporan Data Lansia</h4>
                    <p class="mb-0">Daftar seluruh lansia yang terdaftar</p>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <button onclick="window.print()" class="btn btn-secondary mr-2"><i class="fa fa-print"></i> Cetak</button>
            </div>
        </div>

        <div class="row filter-section no-print">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Registrasi Mulai</label>
                                    <input type="date" name="tgl_mulai" class="form-control" value="<?php echo $tgl_mulai == '2000-01-01' ? '' : $tgl_mulai; ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Registrasi Selesai</label>
                                    <input type="date" name="tgl_selesai" class="form-control" value="<?php echo $tgl_selesai; ?>">
                                </div>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="laporan_lansia.php" class="btn btn-light">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="print-header">
                            <h2>PSTW KASIH SAYANG IBU</h2>
                            <h3>LAPORAN DATA LANSIA</h3>
                            <?php if ($tgl_mulai != '2000-01-01'): ?>
                                <p>Periode Registrasi: <?php echo date('d-m-Y', strtotime($tgl_mulai)); ?> s/d <?php echo date('d-m-Y', strtotime($tgl_selesai)); ?></p>
                            <?php else: ?>
                                <p>Semua Data Terdaftar s/d <?php echo date('d-m-Y', strtotime($tgl_selesai)); ?></p>
                            <?php endif; ?>
                            <hr>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered text-dark">
                                <thead class="bg-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lansia</th>
                                        <th>Umur</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Kondisi Kesehatan</th>
                                        <th>Status Sosial</th>
                                        <th class="no-print">Tgl Registrasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $row['nama_lansia']; ?></td>
                                        <td><?php echo $row['umur']; ?></td>
                                        <td><?php echo $row['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
                                        <td><?php echo $row['kondisi_health']; ?></td>
                                        <td><?php echo $row['status_sosial']; ?></td>
                                        <td class="no-print"><?php echo date('d-m-Y', strtotime($row['created_at'])); ?></td>
                                    </tr>
                                    <?php endwhile; ?>
                                    <?php if (mysqli_num_rows($result) == 0): ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Data tidak ditemukan untuk periode ini.</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="print-header mt-4" style="text-align: right; display: none;">
                            <p>Dicetak pada: <?php echo date('d-m-Y H:i'); ?></p>
                            <br><br><br>
                            <p>(......................................)</p>
                            <p>Petugas PSTW</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
