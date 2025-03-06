<?php
require "../config.php";

$title = "Betalen - " . $name;

if(isset($_SESSION['stripePaymentIntentId']) && isset($_SESSION['stripeClientSecret'])){
    $error = false;
    $paymentIntentId = $_SESSION['stripePaymentIntentId'];
    $stripeClientSecret = $_SESSION['stripeClientSecret'];
    try {
        $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);

        if($paymentIntent->status === "succeeded" || $paymentIntent->status === "canceled"){
            $error = true;
        }

        $orderId = $paymentIntent->metadata->order_id;
        $order = $conn->prepare("SELECT * FROM orders WHERE id = :id");
        $order->bindParam(':id', $orderId, PDO::PARAM_INT);
        $order->execute();

        if($order->rowCount() == 1){
            $order = $order->fetch(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="assets/css/pay.css?v=<?php echo filemtime('assets/css/pay.css') ?>">
    <script src="https://js.stripe.com/v3/" defer></script>
    <script>
    const stripePublicKey = '<?php echo $stripePublicKey; ?>';
    const stripeClientSecret = '<?php echo $stripeClientSecret; ?>';
    </script>
    <script src="assets/js/pay.js?v=<?php echo filemtime('assets/js/pay.js') ?>" defer></script>
</head>

<body>
    <?php include "../includes/announcement.php"; ?>
    <?php include "../includes/headNav.php"; ?>

    <main>
        <div class="container">
            <div class="paymentMethodsContainer">
                <h3>Betalingsmethoden</h3>
                <div class="paymentMethods">
                    <div id="ideal" class="method">
                        <div class="logo">
                            <i class="fa-brands fa-ideal"></i>
                        </div>
                        <div class="text">
                            <p>Betaal met IDEAL</p>
                        </div>
                    </div>
                </div>
                <button class="payButton" disabled>Betaal</button>
            </div>
        </div>
        <?php include "includes/cartSide.php"; ?>
    </main>
</body>

</html>
<?php
    }else{
        echo '<script>window.location.href = "/winkelwagen2";</script>';
    }
}else{
    echo '<script>window.location.href = "/winkelwagen1";</script>';
}
?>