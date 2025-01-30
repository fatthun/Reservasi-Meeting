<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "booking_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Inisialisasi variabel $data
$data = null;

// Periksa apakah ID dikirim melalui URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Ambil data booking berdasarkan ID
    $sql = "SELECT * FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Jika data ditemukan, simpan ke dalam $data
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        echo "<p>Data tidak ditemukan.</p>";
    }

    $stmt->close();
}

// Perbarui data booking jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $nama = $_POST['nama'];
    $judul = $_POST['judul'];
    $room = $_POST['room'];
    $tanggal = $_POST['tanggal'];
    $jam_mulai = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];

    $sql = "UPDATE bookings SET nama = ?, judul = ?, room = ?, tanggal = ?, jam_mulai = ?, jam_selesai = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $nama, $judul, $room, $tanggal, $jam_mulai, $jam_selesai, $id);

    if ($stmt->execute()) {
        // Redirect ke halaman list_booking setelah update berhasil
        header("Location: list_booking.php");
        exit(); // Pastikan script berhenti di sini
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <style>
        /* Gaya tampilan sama seperti sebelumnya */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #4caf50;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 15px 0 5px;
            font-weight: bold;
            color: #555;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        input:focus, select:focus {
            border-color: #4caf50;
            outline: none;
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.3);
        }
        button {
            background-color: #4caf50;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
        a {
            text-decoration: none;
            color: #4caf50;
            font-weight: bold;
            display: block;
            text-align: center;
            margin-top: 20px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Booking</h2>
        <?php if ($data): ?>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required>

                <label for="judul">Judul Meeting:</label>
                <input type="text" id="judul" name="judul" value="<?php echo htmlspecialchars($data['judul']); ?>" required>

                <label for="room">Room:</label>
                <select id="room" name="room" required>
                    <option value="Room 1" <?php echo $data['room'] === 'Room 1' ? 'selected' : ''; ?>>Room 1</option>
                    <option value="Room 2" <?php echo $data['room'] === 'Room 2' ? 'selected' : ''; ?>>Room 2</option>
                    <option value="Room 3" <?php echo $data['room'] === 'Room 3' ? 'selected' : ''; ?>>Room 3</option>
                    <option value="Room 4" <?php echo $data['room'] === 'Room 4' ? 'selected' : ''; ?>>Room 4</option>
                </select>

                <label for="tanggal">Tanggal:</label>
                <input type="date" id="tanggal" name="tanggal" value="<?php echo $data['tanggal']; ?>" required>

                <label for="jam_mulai">Jam Mulai:</label>
                <input type="time" id="jam_mulai" name="jam_mulai" value="<?php echo $data['jam_mulai']; ?>" required>

                <label for="jam_selesai">Jam Selesai:</label>
                <input type="time" id="jam_selesai" name="jam_selesai" value="<?php echo $data['jam_selesai']; ?>" required>

                <button type="submit">Update Booking</button>
            </form>
            <a href="list_booking.php">Batal</a>
        <?php else: ?>
            <p>Data tidak ditemukan!</p>
            <a href="list_booking.php">Kembali</a>
        <?php endif; ?>
    </div>
</body>
</html>
