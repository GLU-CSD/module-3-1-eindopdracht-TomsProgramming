<?php
require "../config.php";

if($loggedIn){
    if ($deviceData['emailVerified'] === 1){
        echo '<script>location.href = "/mijn-account";</script>';
    }else{
        echo '<script>location.href = "/email-verificatie";</script>';
    }
}

$title = "Login - SimpelWinkelen";
?>
<!doctype html>
<html lang="nl">

<head>
    <?php include "includes/basePath.php"; ?>
    <?php include "../includes/head.php"; ?>
    <link rel="stylesheet" href="assets/css/main.css?v=<?php echo filemtime('assets/css/main.css') ?>">
    <script src="assets/js/login.js?v=<?php echo filemtime('assets/js/login.js') ?>" defer></script>
</head>

<body>
    <?php include "../includes/announcement.php"; ?>
    <?php include "../includes/headNav.php"; ?>
    <main class="authMain">
        <div class="authContainer">
            <h2>Login</h2>
            <?php include "includes/notifications.php"; ?>
            <form id="loginForm" method="post">
                <label for="email">E-mailadres</label>
                <input type="email" id="email" name="email" required>

                <label for="password">Wachtwoord</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="authButton">Inloggen</button>
            </form>
            <p>Nog geen account? <a href="../registreren">Registreer hier</a></p>
        </div>
    </main>


    <?php include "../includes/footer.php"; ?>
</body>

</html>