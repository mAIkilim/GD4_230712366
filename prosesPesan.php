<?php

$nama = $_POST["namaPembeli"];
$konser = $_POST["pilihKonser"];
$jumlah = $_POST["jumlahTiket"];

$folderTujuan = "bukti_bayar/";

$namaFile = basename($_FILES["buktiBayar"]["name"]);

$alamatFile = $folderTujuan . $namaFile;

if (move_uploaded_file(
    $_FILES["buktiBayar"]["tmp_name"],
    $alamatFile
)) {
    $pesanUpload = "Bukti pembayaran berhasil diupload.";
} else {
    $pesanUpload = "Gagal upload bukti pembayaran.";
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Pemesanan - TiketWar</title>
</head>

<body>

    <h1>Pesanan Berhasil!</h1>

    <p>Nama:
        <?php echo htmlspecialchars($nama); ?>
    </p>

    <p>Konser:
        <?php echo htmlspecialchars($konser); ?>
    </p>

    <p>Jumlah tiket:
        <?php echo htmlspecialchars($jumlah); ?>
    </p>

    <p>
        <?php echo $pesanUpload; ?>
    </p>

    <p>
        <a href="pesan.php">Kembali ke Form</a>
    </p>

</body>

</html>