<?php
include '../../koneksi.php';
include '../../session.php';
checkLogin();

$query = "SELECT a.*, l.nama_lansia FROM aktivitas_lansia a JOIN lansia l ON a.id_lansia = l.id_lansia ORDER BY a.tanggal DESC";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Aktivitas Lansia</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 12px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        .header { text-align: center; margin-bottom: 20px; }
        .no-print { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="no-print">
        <button onclick="window.print()">Cetak Laporan</button>
        <button onclick="window.close()">Tutup</button>
    </div>

    <div class="header">
        <h2>PSTW KASIH SAYANG IBU</h2>
        <h3>LAPORAN AKTIVITAS HARIAN LANSIA</h3>
        <hr>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Lansia</th>
                <th>Fisik</th>
                <th>Emosional</th>
                <th>Sosial</th>
                <th>Kehadiran</th>
                <th>Makan</th>
                <th>Kesehatan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['tanggal']; ?></td>
                <td><?php echo $row['nama_lansia']; ?></td>
                <td><?php echo $row['aktivitas_fisik']; ?></td>
                <td><?php echo $row['kondisi_emosional']; ?></td>
                <td><?php echo $row['interaksi_sosial']; ?></td>
                <td><?php echo $row['kehadiran_kegiatan']; ?></td>
                <td><?php echo $row['pola_makan']; ?></td>
                <td><?php echo $row['kesehatan_harian']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div style="margin-top: 50px; text-align: right;">
        <p>Dicetak pada: <?php echo date('d-m-Y H:i'); ?></p>
        <br><br><br>
        <p>(......................................)</p>
    </div>
</body>
</html>
