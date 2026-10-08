
<?php
session_start();

if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: dashboard.php");
    exit;
}

$index = filter_var(
    $_POST["hapus"] ?? null,
    FILTER_VALIDATE_INT
);

if (
    $index !== false &&
    $index >= 0 &&
    isset($_SESSION["daftarWar"][$index])
) {
    array_splice($_SESSION["daftarWar"], $index, 1);
}

header("Location: dashboard.php");
exit;
