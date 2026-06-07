<?php
include '../../koneksi.php';
include '../../session.php';
checkLogin();

$query = "SELECT p.*, l.nama_lansia, a.tanggal 
          FROM prediksi p 
          JOIN lansia l ON p.id_lansia = l.id_lansia 
          JOIN aktivitas_lansia a ON p.id_aktivitas = a.id_aktivitas 
          ORDER BY p.tanggal_prediksi DESC";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Prediksi Perilaku</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        .header { text-align: center; margin-bottom: 30px; }
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
        <h3>LAPORAN HASIL PREDIKSI PERILAKU LANSIA</h3>
        <hr>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Prediksi</th>
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
                <td><?php echo $row['tanggal_prediksi']; ?></td>
                <td><?php echo $row['nama_lansia']; ?></td>
                <td><?php echo $row['tanggal']; ?></td>
                <td><?php echo $row['hasil_prediksi']; ?></td>
                <td><?php echo $row['akurasi']; ?>%</td>
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
