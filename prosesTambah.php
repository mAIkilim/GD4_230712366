
<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: tambahTiket.php");
    exit;
}

$nama = trim($_POST["nama"] ?? "");
$kategori = $_POST["kategori"] ?? "";
$harga = filter_var(
    $_POST["harga"] ?? null,
    FILTER_VALIDATE_INT,
    ["options" => ["min_range" => 1]]
);

if (
    $nama === "" ||
    !in_array($kategori, ["Festival", "VIP", "Reguler"], true) ||
    $harga === false
) {
    exit("Data tiket tidak valid.");
}

if (
    !isset($_FILES["bukti"]) ||
    $_FILES["bukti"]["error"] !== UPLOAD_ERR_OK
) {
    exit("Gagal menerima bukti tiket.");
}

if ($_FILES["bukti"]["size"] > 5 * 1024 * 1024) {
    exit("Ukuran gambar maksimal 5 MB.");
}

$tipeFile = mime_content_type(
    $_FILES["bukti"]["tmp_name"]
);

$tipeDiizinkan = [
    "image/jpeg" => "jpg",
    "image/png" => "png"
];

if (!isset($tipeDiizinkan[$tipeFile])) {
    exit("Hanya gambar JPG dan PNG yang diperbolehkan.");
}

$folderTujuan = __DIR__ . "/bukti_bayar/";

if (!is_dir($folderTujuan)) {
    if (!mkdir($folderTujuan, 0755, true)) {
        exit("Gagal membuat folder upload.");
    }
}

$namaFile = bin2hex(random_bytes(8))
    . "." . $tipeDiizinkan[$tipeFile];

$alamatFile = $folderTujuan . $namaFile;

if (!move_uploaded_file(
    $_FILES["bukti"]["tmp_name"],
    $alamatFile
)) {
    exit("Gagal menyimpan gambar.");
}

if (!isset($_SESSION["daftarWar"])) {
    $_SESSION["daftarWar"] = [];
}

$_SESSION["daftarWar"][] = [
    "nama" => $nama,
    "kategori" => $kategori,
    "harga" => $harga,
    "bukti" => "bukti_bayar/" . $namaFile
];

header("Location: dashboard.php");
exit;
