
<?php
session_start();

if (isset($_SESSION["admin"])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - TiketWar</title>
</head>
<body>

    <h1>Login Admin TiketWar</h1>

    <?php if (isset($_SESSION["error"])) { ?>
        <p style="color: red;">
            <?php
            echo htmlspecialchars($_SESSION["error"]);
            unset($_SESSION["error"]);
            ?>
        </p>
    <?php } ?>

    <form action="prosesLogin.php" method="post">

        <p>
            <input type="text"
                   name="username"
                   placeholder="Username"
                   required>
        </p>

        <p>
            <input type="password"
                   name="password"
                   placeholder="Password"
                   required>
        </p>

        <button type="submit">Login</button>

    </form>

</body>
</html>
