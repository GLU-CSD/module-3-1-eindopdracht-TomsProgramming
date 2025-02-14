<?php
$title = "Login - SimpelWinkelen";
?>
<!doctype html>
<html lang="nl">

<head>
    <?php include "includes/basePath.php"; ?>
    <?php include "../includes/head.php"; ?>
    <link rel="stylesheet" href="assets/css/main.css?v=<?php echo filemtime('assets/css/main.css') ?>">
</head>

<body>
    <?php include "../includes/announcement.php"; ?>
    <?php include "../includes/headNav.php"; ?>
    <main class="auth-main">
        <div class="auth-container">
            <h2>Login</h2>
            <form action="login_process.php" method="post">
                <label for="username">Gebruikersnaam</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Wachtwoord</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="auth-button">Inloggen</button>
            </form>
            <p>Nog geen account? <a href="register.php">Registreer hier</a></p>
        </div>
    </main>

    <?php include "../includes/footer.php"; ?>
</body>

</html>