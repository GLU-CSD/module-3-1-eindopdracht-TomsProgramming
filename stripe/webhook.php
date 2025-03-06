<?php
require '../config.php';

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
    $event = \Stripe\Webhook::constructEvent($payload, $sig_header, $stripeWebhookSecret);
} catch (\Exception $e) {
    http_response_code(400);
    exit();
}

function logPayment($conn, $orderId, $paymentIntentId, $status, $message = null) {
    $stmt = $conn->prepare("INSERT INTO paymentLogs (orderId, paymentIntentId, paymentStatus, logMessage) VALUES (?, ?, ?, ?)");
    $stmt->execute([$orderId, $paymentIntentId, $status, $message]);
}

if (isset($event->data->object->id)) {
    $stripePaymentIntentId = $event->data->object->id;
    $orderId = $event->data->object->metadata->order_id;

    if(!$orderId) {
        http_response_code(400);
        exit("No order ID provided");
    }

    if($event->type === 'payment_intent.created') {
        $stmt = $conn->prepare("UPDATE orders SET paymentStatus = 'created' WHERE id = ?");
        $stmt->execute([$orderId]);

        logPayment($conn, $orderId, $stripePaymentIntentId, 'created');
    }

    if($event->type === 'payment_intent.canceled') {
        $stmt = $conn->prepare("UPDATE orders SET paymentStatus = 'canceled' WHERE id = ?");
        $stmt->execute([$orderId]);

        logPayment($conn, $orderId, $stripePaymentIntentId, 'canceled');
    }

    if($event->type === 'payment_intent.processing') {
        $stmt = $conn->prepare("UPDATE orders SET paymentStatus = 'processing' WHERE id = ?");
        $stmt->execute([$orderId]);

        logPayment($conn, $orderId, $stripePaymentIntentId, 'processing');
    }

    if ($event->type === 'payment_intent.succeeded') {
        $charges = $event->data->object->charges->data[0] ?? null;
        $methodType = $charges->payment_method_details->type ?? 'unknown';
        $extraData = json_encode($charges->payment_method_details->{$methodType} ?? []);
    
        $stmt = $conn->prepare("UPDATE orders SET paid = 1, paymentStatus = 'succeeded', methodType = ?, extraData = ? WHERE id = ?");
        $stmt->execute([$methodType, $extraData, $orderId]);

        logPayment($conn, $orderId, $stripePaymentIntentId, 'succeeded');
    }    

    if ($event->type === 'payment_intent.payment_failed') {
        $failureMessage = $event->data->object->last_payment_error ? $event->data->object->last_payment_error->message : 'Onbekende fout';
        
        $stmt = $conn->prepare("UPDATE orders SET paymentStatus = 'failed' WHERE id = ?");
        $stmt->execute([$orderId]);

        logPayment($conn, $orderId, $stripePaymentIntentId, 'failed', "Betaling mislukt: $failureMessage");
    }

    if($event->type === 'payment_intent.requires_action') {
        $stmt = $conn->prepare("UPDATE orders SET paymentStatus = 'requires_action' WHERE id = ?");
        $stmt->execute([$orderId]);

        logPayment($conn, $orderId, $stripePaymentIntentId, 'requires_action', 'Betaling vereist actie');
    }


}

http_response_code(200);
?>
