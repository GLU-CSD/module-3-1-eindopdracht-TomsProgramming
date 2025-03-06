<?php
require "../config.php";

$title = "Bedankt - " . $name;

if(isset($_SESSION['stripePaymentIntentId'])){
    $error = false;
    $paymentIntentId = $_SESSION['stripePaymentIntentId'];
    try {
        $order = $conn->prepare("SELECT * FROM orders WHERE stripePaymentIntentId = :stripePaymentIntentId");
        $order->bindParam(':stripePaymentIntentId', $paymentIntentId, PDO::PARAM_STR);

        $order->execute();

        if($order->rowCount() == 1){
            $order = $order->fetch(PDO::FETCH_ASSOC);

            if($order['paid'] != 1){
                $error = true;
            }
        }else {
            $error = true;
        }
    } catch (Exception $e) {
        $error = true;
    }

    if(!$error){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/basePath.php"; ?>
    <?php include "../includes/head.php"; ?>
    <link rel="stylesheet" href="assets/css/success.css?v=<?php echo filemtime('assets/css/success.css') ?>">
    <script src="assets/js/success.js?v=<?php echo filemtime('assets/js/success.js') ?>" defer></script>
</head>

<body>
    <?php include "../includes/announcement.php"; ?>
    <?php include "../includes/headNav.php"; ?>

    <main>
        <div class="container">
            <h3>Bedankt voor uw bestelling!</h3>
            <p>Uw bestelling is succesvol geplaatst. U ontvangt een bevestiging per e-mail.</p>
            <p>Uw ordernummer is: <span class="order-id">#<?php echo $order['id']; ?></span></p>
            <a href="/" class="button">Bekijk producten</a>
        </div>
    </main>
</body>

</html>
<?php
    } else {
        echo '<script>window.location.href = "/winkelwagen";</script>';
        exit;
    }
} else {
    echo '<script>window.location.href = "/winkelwagen";</script>';
    exit;
}
?>