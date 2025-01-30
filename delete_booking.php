<?php
// Koneksi database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'booking_system';
$conn = new mysqli($host, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID booking dari URL
$id = $_GET['id'];

// Hapus booking jika dikonfirmasi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: list_booking.php");
    } else {
        echo "<p class='error'>Gagal menghapus booking: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Ambil detail booking untuk ditampilkan
$result = $conn->query("SELECT * FROM bookings WHERE id = $id");
$data = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 500px;
            width: 100%;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        p {
            font-size: 16px;
            color: #555;
            margin-bottom: 30px;
        }
        .details {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: left;
            color: #333;
        }
        .details strong {
            display: block;
            color: #555;
        }
        button, .cancel-btn {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            text-align: center;
            width: calc(50% - 5px);
            box-sizing: border-box;
        }
        .delete-btn {
            background-color: #f44336;
            color: white;
        }
        .delete-btn:hover {
            background-color: #d32f2f;
        }
        .cancel-btn {
            background-color: #5cb85c;
            color: white;
            text-decoration: none;
        }
        .cancel-btn:hover {
            background-color: #4cae4c;
        }
        a {
            text-decoration: none;
            font-size: 14px;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hapus Booking</h2>
        <?php if ($data): ?>
            <p>Apakah Anda yakin ingin menghapus booking berikut?</p>
            <div class="details">
                <strong>Nama:</strong> <?php echo htmlspecialchars($data['nama']); ?>
                <strong>Judul Meeting:</strong> <?php echo htmlspecialchars($data['judul']); ?>
                <strong>Room:</strong> <?php echo htmlspecialchars($data['room']); ?>
                <strong>Tanggal:</strong> <?php echo htmlspecialchars($data['tanggal']); ?>
                <strong>Jam Mulai:</strong> <?php echo htmlspecialchars($data['jam_mulai']); ?>
                <strong>Jam Selesai:</strong> <?php echo htmlspecialchars($data['jam_selesai']); ?>
            </div>
            <form method="POST">
                <button type="submit" class="delete-btn">Hapus</button>
                <a href="list_booking.php" class="cancel-btn">Batal</a>
            </form>
        <?php else: ?>
            <p>Booking tidak ditemukan.</p>
            <a href="list_booking.php">Kembali ke Daftar Booking</a>
        <?php endif; ?>
    </div>
</body>
</html>
