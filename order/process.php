<?php
require "../config.php";

if (isset($_SESSION['stripePaymentIntentId'])) {
    $stripePaymentIntentId = $_SESSION['stripePaymentIntentId'];
    try {
        $paymentIntent = \Stripe\PaymentIntent::retrieve($stripePaymentIntentId);

        if ($paymentIntent->status === "succeeded") {
            echo '<script>localStorage.removeItem("cart");</script>';
            echo '<script>window.location.href = "/bestellen/bedankt";</script>';
            exit;
        } elseif ($paymentIntent->status != "canceled" && $paymentIntent->status !== "succeeded") {
            echo '<script>window.location.href = "/bestellen/betalen";</script>';
            exit;
        } else {
            echo '<script>window.location.href = "/winkelwagen";</script>';
            exit;
        }
    } catch (Exception $e) {
        echo '<script>window.location.href = "/winkelwagen";</script>';
        exit;
    }
} else {
    echo '<script>window.location.href = "/winkelwagen";</script>';
    exit;
}
?>