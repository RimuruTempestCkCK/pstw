<?php
include '../../koneksi.php';
include '../../session.php';
checkLogin();

$query = "SELECT hasil_prediksi, COUNT(*) as jumlah FROM prediksi GROUP BY hasil_prediksi";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Evaluasi Perilaku Lansia</title>
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
        <h3>REKAP EVALUASI PERILAKU LANSIA</h3>
        <hr>
    </div>

    <p>Berikut adalah ringkasan pola perilaku lansia berdasarkan hasil prediksi sistem:</p>

    <table>
        <thead>
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
                <td><?php echo $row['jumlah']; ?></td>
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
