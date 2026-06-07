-- Database schema for Sistem Prediksi Pola Perilaku Lansia

CREATE DATABASE IF NOT EXISTS db_prediksi_lansia;
USE db_prediksi_lansia;

-- 1. Tabel Users
CREATE TABLE IF NOT EXISTS users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'petugas', 'kepala_uptd') NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- 2. Tabel Lansia
CREATE TABLE IF NOT EXISTS lansia (
    id_lansia INT AUTO_INCREMENT PRIMARY KEY,
    nama_lansia VARCHAR(100) NOT NULL,
    umur INT NOT NULL,
    jenis_kelamin ENUM('L', 'P') NOT NULL,
    kondisi_health VARCHAR(100),
    status_sosial VARCHAR(100),
    foto TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- 3. Tabel Aktivitas Lansia
CREATE TABLE IF NOT EXISTS aktivitas_lansia (
    id_aktivitas INT AUTO_INCREMENT PRIMARY KEY,
    id_lansia INT NOT NULL,
    aktivitas_fisik VARCHAR(100),
    kondisi_emosional VARCHAR(100),
    interaksi_sosial VARCHAR(100),
    kehadiran_kegiatan VARCHAR(100),
    pola_makan VARCHAR(100),
    kesehatan_harian VARCHAR(100),
    tanggal DATE NOT NULL,
    created_by INT NOT NULL,
    FOREIGN KEY (id_lansia) REFERENCES lansia(id_lansia) ON DELETE CASCADE,
    FOREIGN KEY (created_by) REFERENCES users(id_user)
);

-- 4. Tabel Kategori Perilaku
CREATE TABLE IF NOT EXISTS kategori_perilaku (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL,
    keterangan TEXT
);

-- 5. Tabel Prediksi
CREATE TABLE IF NOT EXISTS prediksi (
    id_prediksi INT AUTO_INCREMENT PRIMARY KEY,
    id_lansia INT NOT NULL,
    id_aktivitas INT NOT NULL,
    id_kategori INT NOT NULL,
    akurasi DECIMAL(5, 2),
    hasil_prediksi VARCHAR(100),
    tanggal_prediksi DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_lansia) REFERENCES lansia(id_lansia) ON DELETE CASCADE,
    FOREIGN KEY (id_aktivitas) REFERENCES aktivitas_lansia(id_aktivitas) ON DELETE CASCADE,
    FOREIGN KEY (id_kategori) REFERENCES kategori_perilaku(id_kategori)
);

-- Seed Data Default
INSERT INTO kategori_perilaku (nama_kategori, keterangan) VALUES
('Stabil', 'Perilaku lansia dalam kondisi normal dan konsisten.'),
('Perlu Perhatian', 'Lansia menunjukkan gejala yang memerlukan pengawasan lebih lanjut.'),
('Kurang Aktif', 'Lansia jarang berpartisipasi dalam aktivitas harian.'),
('Berisiko Mengalami Perubahan Perilaku', 'Kondisi yang menunjukkan potensi penurunan kesehatan mental atau fisik.');

-- Seed Admin User (password: admin123)
INSERT INTO users (nama, username, password, role) VALUES
('Administrator', 'admin', '$2y$10$YHUS4kLjhFsUTTcTj8/ep.61oVPQnmU/skxIe03mxrbVHWX1hwSV2', 'admin');
