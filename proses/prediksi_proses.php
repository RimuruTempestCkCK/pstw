<?php
include '../koneksi.php';
include '../session.php';
require_once '../random_forest/dataset_training.php';

checkLogin();

$aksi = $_GET['aksi'];

if ($aksi == 'proses') {
    $id_aktivitas = $_GET['id_aktivitas'];

    // Get activity data
    $query = "SELECT * FROM aktivitas_lansia WHERE id_aktivitas = '$id_aktivitas'";
    $result = mysqli_query($koneksi, $query);
    $activity = mysqli_fetch_assoc($result);

    if (!$activity) {
        die("Data aktivitas tidak ditemukan!");
    }

    $id_lansia = $activity['id_lansia'];

    // Prepare sample for prediction
    $sample = [
        $activity['aktivitas_fisik'],
        $activity['kondisi_emosional'],
        $activity['interaksi_sosial'],
        $activity['kehadiran_kegiatan'],
        $activity['pola_makan'],
        $activity['kesehatan_harian']
    ];

    // Get trained model and predict
    $rf = getTrainedModel();
    $hasil_prediksi = $rf->predict($sample);

    // Get category ID
    $cat_query = "SELECT id_kategori FROM kategori_perilaku WHERE nama_kategori = '$hasil_prediksi'";
    $cat_result = mysqli_query($koneksi, $cat_query);
    $category = mysqli_fetch_assoc($cat_result);
    $id_kategori = $category ? $category['id_kategori'] : 0;

    // Accuracy (Dummy for now, in real RF it could be voting ratio)
    $akurasi = 85.00; // Example accuracy

    // Save prediction result
    $insert = "INSERT INTO prediksi (id_lansia, id_aktivitas, id_kategori, akurasi, hasil_prediksi) 
               VALUES ('$id_lansia', '$id_aktivitas', '$id_kategori', '$akurasi', '$hasil_prediksi')";
    
    if (mysqli_query($koneksi, $insert)) {
        header("Location: ../admin/prediksi.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

if ($aksi == 'hapus') {
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM prediksi WHERE id_prediksi = '$id'");
    header("Location: ../admin/prediksi.php");
}
?>
