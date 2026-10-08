<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION["daftarWar"])) {
    $_SESSION["daftarWar"] = [];
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - TiketWar</title>
</head>

<body>

    <h1>Dashboard Admin</h1>

    <h2>
        Halo,
        <?php
        echo htmlspecialchars($_SESSION["admin"]["username"]);
        ?>
    </h2>

    <p>
        <a href="tambahTiket.php">+ Tambah Tiket War</a>
        |
        <a href="prosesLogout.php">Logout</a>
    </p>

    <hr>

    <h2>Daftar Tiket War</h2>

    <?php if (empty($_SESSION["daftarWar"])) { ?>
        <p>Belum ada tiket yang ditambahkan.</p>
    <?php } ?>

    <?php foreach ($_SESSION["daftarWar"] as $i => $tiket) { ?>

        <div style="border:1px solid #ccc;
                    padding:15px;
                    margin-bottom:10px;">

            <h3>
                <?php echo htmlspecialchars($tiket["nama"]); ?>
            </h3>

            <p>
                Kategori:
                <?php echo htmlspecialchars($tiket["kategori"]); ?>
            </p>

            <p>
                Harga: Rp
                <?php
                echo number_format($tiket["harga"], 0, ",", ".");
                ?>
            </p>

            <p>Bukti:</p>

            <img src="<?php echo htmlspecialchars($tiket["bukti"]); ?>"
                width="150"
                alt="Bukti tiket">

            <form action="prosesHapus.php" method="post">
                <input type="hidden"
                    name="hapus"
                    value="<?php echo $i; ?>">

                <button type="submit">Hapus</button>
            </form>

        </div>

    <?php } ?>

</body>

</html>