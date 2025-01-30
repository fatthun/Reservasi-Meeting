<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proses Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .success {
            color: #4caf50;
            font-size: 20px;
            font-weight: bold;
        }
        .error {
            color: #f44336;
            font-size: 20px;
            font-weight: bold;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #5cb85c;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        a:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Koneksi ke database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "booking_system";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Periksa koneksi
        if ($conn->connect_error) {
            die("<p class='error'>Koneksi gagal: " . $conn->connect_error . "</p>");
        }

        // Ambil data dari form
        $nama = $_POST['nama'];
        $judul = $_POST['judul'];
        $room = $_POST['room'];
        $tanggal = $_POST['tanggal'];
        $jam_mulai = $_POST['jam_mulai'];
        $jam_selesai = $_POST['jam_selesai'];

        // Query untuk menyimpan data
        $sql = "INSERT INTO bookings (nama, judul, room, tanggal, jam_mulai, jam_selesai)
                VALUES ('$nama', '$judul', '$room', '$tanggal', '$jam_mulai', '$jam_selesai')";

        if ($conn->query($sql) === TRUE) {
            echo "<p class='success'>Booking berhasil disimpan!</p>";
        } else {
            echo "<p class='error'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }

        $conn->close();
        ?>
        <a href="index.php">Kembali ke Form</a>
        <a href="view_list_booking.php">Lihat Daftar Booking</a>
    </div>
</body>
</html>
