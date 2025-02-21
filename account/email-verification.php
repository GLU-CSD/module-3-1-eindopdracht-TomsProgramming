<?php
require "../config.php";
require 'assets/php/classes/verification.php';

if($loggedIn){
    if ($deviceData['emailVerified'] === 1){
        echo '<script>location.href = "/mijn-account";</script>';
    }
}else{
    echo '<script>location.href = "/inloggen";</script>';
}

$verificationSentStatus = verification::hasCodeBeenSent();
if($verificationSentStatus === 1){
    echo '<script> window.location.href = "../index.php"; </script>';
    exit;
}elseif($verificationSentStatus == false){
    verification::createAndSendCode('../');
}

$title = "Email Verificatie - SimpelWinkelen";
?>
<!doctype html>
<html lang="nl">

<head>
    <?php include "includes/basePath.php"; ?>
    <?php include "../includes/head.php"; ?>
    <link rel="stylesheet" href="assets/css/main.css?v=<?php echo filemtime('assets/css/main.css') ?>">
    <script src="assets/js/email-verification.js?v=<?php echo filemtime('assets/js/email-verification.js') ?>" defer></script>
</head>

<body>
    <?php include "../includes/announcement.php"; ?>
    <?php include "../includes/headNav.php"; ?>
    <main class="authMain">
        <div class="authContainer">
            <h2>Email Verificatie</h2>
            <p class="commentation">Er is een code naar je e-mailadres gestuurd. Vul de code hieronder in om je account te verifiëren.</p>
            <?php include "includes/notifications.php"; ?>
            <form id="verifyCodeForm" method="post">
                <label for="code">Code</label>
                <input type="text" id="code" name="code" inputmode="numeric" pattern="\d*" required>

                <button type="submit" class="authButton">Verifiëren</button>
            </form>
            <p>Heb je geen code ontvangen? <a class="resendMail">Klik hier</a></p>
            <p>Zit u in het verkeerde account? <a href="/uitloggen">Uitloggen</a></p>
        </div>
    </main>


    <?php include "../includes/footer.php"; ?>
</body>

</html>