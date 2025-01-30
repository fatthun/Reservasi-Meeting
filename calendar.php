<?php
// Koneksi ke database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'booking_system';

$conn = new mysqli($host, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari database
$result = $conn->query("SELECT * FROM bookings ORDER BY tanggal, jam_mulai");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Booking</title>
</head>
<body>
    <h2>Kalender Booking</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Judul</th>
                <th>Room</th>
                <th>Tanggal</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['judul']) ?></td>
                    <td><?= htmlspecialchars($row['room']) ?></td>
                    <td><?= htmlspecialchars(date("d-m-Y", strtotime($row['tanggal']))) ?></td>
                    <td><?= htmlspecialchars($row['jam_mulai']) ?></td>
                    <td><?= htmlspecialchars($row['jam_selesai']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="index.php">Tambah Booking Baru</a>
</body>
</html>
<?php
$conn->close();
?>
