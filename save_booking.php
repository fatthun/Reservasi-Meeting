<?php
// Koneksi ke database
$host = 'localhost';
$username = 'root'; // Default XAMPP
$password = ''; // Default XAMPP
$dbname = 'booking_system';

$conn = new mysqli($host, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $judul = $_POST['judul'];
    $room = $_POST['room'];
    $tanggal = $_POST['tanggal'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];

    // Simpan data ke database
    $stmt = $conn->prepare("INSERT INTO bookings (nama, judul, room, tanggal, jam_mulai, jam_selesai) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nama, $judul, $room, $tanggal, $jam_mulai, $jam_selesai);

    if ($stmt->execute()) {
        echo "<p>Booking berhasil disimpan! <a href='calendar.php'>Lihat Kalender</a></p>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
