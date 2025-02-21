<?php
require "../config.php";

if($loggedIn){
    if ($deviceData['emailVerified'] === 1){
        echo '<script>location.href = "/mijn-account";</script>';
    }else{
        echo '<script>location.href = "/email-verificatie";</script>';
    }
}

$title = "Registratie - SimpelWinkelen";
?>
<!doctype html>
<html lang="nl">

<head>
    <?php include "includes/basePath.php"; ?>
    <?php include "../includes/head.php"; ?>
    <link rel="stylesheet" href="assets/css/main.css?v=<?php echo filemtime('assets/css/main.css') ?>">
    <script src="assets/js/register.js?v=<?php echo filemtime('assets/js/register.js') ?>" defer></script>
</head>

<body>
    <?php include "../includes/announcement.php"; ?>
    <?php include "../includes/headNav.php"; ?>
    <main class="authMain">
        <div class="authContainer">
            <h2>Registreren</h2>
            <?php include "includes/notifications.php"; ?>
            <form id="registerForm" method="post">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" onpaste="return false;" ondrop="return false;" autocomplete="off" required>

                <label for="confirmEmail">Bevestig e-mail</label>
                <input type="email" id="confirmEmail" name="confirmEmail" onpaste="return false;" ondrop="return false;" autocomplete="off" required>

                <label for="password">Wachtwoord</label>
                <input type="password" id="password" name="password" required>

                <label for="confirmPassword">Bevestig wachtwoord</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>

                <button type="submit" class="authButton">Registreren</button>
            </form>
            <p>Heb je al een account? <a href="../inloggen">Login hier</a></p>
        </div>
    </main>


    <?php include "../includes/footer.php"; ?>
</body>

</html>