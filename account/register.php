<?php
$title = "Registratie - SimpelWinkelen";
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
            <h2>Registreren</h2>
            <form action="register_process.php" method="post">
                <label for="username">Gebruikersnaam</label>
                <input type="text" id="username" name="username" required>

                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Wachtwoord</label>
                <input type="password" id="password" name="password" required>

                <label for="confirm_password">Bevestig wachtwoord</label>
                <input type="password" id="confirm_password" name="confirm_password" required>

                <button type="submit" class="auth-button">Registreren</button>
            </form>
            <p>Heb je al een account? <a href="login.php">Login hier</a></p>
        </div>
    </main>

    <?php include "../includes/footer.php"; ?>
</body>

</html>