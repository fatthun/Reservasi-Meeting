<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        table th {
            background-color: #5cb85c;
            color: #fff;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Reservasi Meeting Room</h2>
        <?php
        // Koneksi database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "booking_system";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Query data booking
        $sql = "SELECT * FROM bookings ORDER BY room, tanggal, jam_mulai";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $currentRoom = '';
            $no = 1;

            while ($row = $result->fetch_assoc()) {
                if ($row['room'] !== $currentRoom) {
                    if ($currentRoom !== '') {
                        echo '</tbody></table>';
                    }
                    $currentRoom = $row['room'];
                    echo "<h3>Meeting " . htmlspecialchars($currentRoom) . "</h3>";
                    echo "<table>
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Requester</th>
                                    <th>Judul Meeting</th>
                                    <th>Tanggal</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                </tr>
                            </thead>
                            <tbody>";
                    $no = 1; // Reset numbering for each room
                }
                echo "<tr>
                        <td>{$no}</td>
                        <td>" . htmlspecialchars($row['nama']) . "</td>
                        <td>" . htmlspecialchars($row['judul']) . "</td>
                        <td>" . date("d-m-Y", strtotime($row['tanggal'])) . "</td>
                        <td>" . htmlspecialchars($row['jam_mulai']) . "</td>
                        <td>" . htmlspecialchars($row['jam_selesai']) . "</td>
                    </tr>";
                $no++;
            }
            echo '</tbody></table>';
        } else {
            echo "<p>Tidak ada data booking.</p>";
        }

        $conn->close();
        ?>
        <a href="index.php">Kembali ke Form Booking</a>
    </div>
</body>
</html>
