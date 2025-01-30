<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Meeting Room</title>
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
            max-width: 500px;
            margin: 20px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin: 10px 0 5px;
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
        button {
            background-color: #5cb85c;
            color: #fff;
            cursor: pointer;
        }
        button:hover {
            background-color: #4cae4c;
        }
        a {
            color: #007bff;
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Form Reservasi Meeting Room</h2>
        <form action="process_booking.php" method="POST">
            <label for="nama">Nama Requester:</label>
            <input type="text" id="nama" name="nama" required>

            <label for="judul">Judul Meeting:</label>
            <input type="text" id="judul" name="judul" required>

            <label for="room">Meeting Room:</label>
            <select id="room" name="room" required>
                <option value="Room 1">Meeting Room 1</option>
                <option value="Room 2">Meeting Room 2</option>
                <option value="Room 3">Meeting Room 3</option>
                <option value="Room 4">Meeting Room 4</option>
            </select>

            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" required>

            <label for="jam_mulai">Jam Mulai:</label>
            <input type="time" id="jam_mulai" name="jam_mulai" required>

            <label for="jam_selesai">Jam Selesai:</label>
            <input type="time" id="jam_selesai" name="jam_selesai" required>

            <button type="submit">Submit</button>
        </form>
        <a href="view_list_booking.php">Lihat Daftar Booking</a>
        <a href="admin_login.php" style="color: red; font-weight: bold;">Login Admin</a>
    </div>
</body>
</html>
