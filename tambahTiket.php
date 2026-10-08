<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Tiket - TiketWar</title>
</head>

<body>

    <h1>Tambah Tiket War</h1>

    <form action="prosesTambah.php"
        method="post"
        enctype="multipart/form-data">

        <p>
            <label>Nama Konser:</label><br>
            <input type="text" name="nama" required>
        </p>

        <p>
            <label>Kategori Tiket:</label><br>
            <select name="kategori" required>
                <option value="Festival">Festival</option>
                <option value="VIP">VIP</option>
                <option value="Reguler">Reguler</option>
            </select>
        </p>

        <p>
            <label>Harga Tiket:</label><br>
            <input type="number"
                name="harga"
                min="1"
                required>
        </p>

        <p>
            <label>Upload Bukti:</label><br>
            <input type="file"
                name="bukti"
                accept=".jpg,.jpeg,.png"
                required>
        </p>

        <button type="submit">Tambah Tiket</button>

    </form>

    <p>
        <a href="dashboard.php">Kembali ke Dashboard</a>
    </p>

</body>

</html>