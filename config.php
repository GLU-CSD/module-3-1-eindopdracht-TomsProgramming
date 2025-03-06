<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
date_default_timezone_set("UTC");

require 'vendor/autoload.php';
use Predis\Client as PredisClient;
use Detection\MobileDetect;

$name = "SimpelWinkelen";

$stripeData = [
    "testPublicKey" => "pk_test_51KTQwKA4T29zbjnhx7k3NCSQsp3t7yu1SPLpnodkLgADhLeWGQCJX2AsYCsT1lNnFKQmavlMJzQoTEhwgJqoIm6m00ZnynhWG5",
    "testSecretKey" => "sk_test_51KTQwKA4T29zbjnhc7rDRn3fLBcwtN5ETRiDoPwLR9hUkvPcyJgl1urc6IrpaKpG3S04ytZ6urFLNiN6sGfqiK9T002HuRFqrP",
    "testWebhookSecret" => "whsec_JinMUW3luIUmQLIOCAYe1jzZUf9Z7qGt",

    "publicKey" => "pk_live_51KTQwKA4T29zbjnhWqDiT7rxgzP2WVJhdBv6ZSMXNmYRmwpHQeE0orz3qgmanHKTqJRMWbXyjeuX9e54B9bJZaEv00guL31wgC",
    "secretKey" => "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",
    "webhookSecret" => "whsec_bbbYmJxFmnvzMGa0ynlcvlWkkImvlRY8"
];

$stripeTest = false;

$stripePublicKey = $stripeTest ? $stripeData['testPublicKey'] : $stripeData['publicKey'];
$stripeSecretKey = $stripeTest ? $stripeData['testSecretKey'] : $stripeData['secretKey'];
$stripeWebhookSecret = $stripeTest ? $stripeData['testWebhookSecret'] : $stripeData['webhookSecret'];

\Stripe\Stripe::setApiKey($stripeSecretKey);

$postcodeApiKey = "559426e5-a309-4854-9202-76b28d40a49e";

$loggedIn = false;
$userData = [];
$deviceData = [];

$ipAddress = "";
$userAgent = "";

try {
    $conn = new PDO("mysql:host=localhost;dbname=webshop", "tom", "ytz.HMW_pvn!yqv8kpr");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}   

$redis = new PredisClient([
    'scheme' => 'tcp',
    'host'   => '127.0.0.1',
    'port'   => 6379,
]);

$deviceDetect = new MobileDetect;

function loadTemplate($templatePath, $variables) {
    $template = file_get_contents($templatePath);
    foreach ($variables as $key => $value) {
        $template = str_replace("{{ $key }}", $value, $template);
    }
    return $template;
}

function sendMail($templateHtmlPath, $templateAltPath, $variables, $email, $subject){
    global $conn, $userData, $deviceData;
    $variables['year'] = date('Y');
    $htmlBody = loadTemplate($templateHtmlPath, $variables);
    $altBody = loadTemplate($templateAltPath, $variables);
    $addedTime = date("Y-m-d H:i:s");

    $insertNewMail = $conn->prepare("INSERT INTO emailQueue (userId, deviceId, email, subject, htmlBody, altBody, addedTime) VALUES (:userId, :deviceId, :email, :subject, :htmlBody, :altBody, :addedTime)");
    $insertNewMail->bindParam(':userId', $userData['id'], PDO::PARAM_INT);
    $insertNewMail->bindParam(':deviceId', $deviceData['id'], PDO::PARAM_INT);
    $insertNewMail->bindParam(':email', $email, PDO::PARAM_STR);
    $insertNewMail->bindParam(':subject', $subject, PDO::PARAM_STR);
    $insertNewMail->bindParam(':htmlBody', $htmlBody, PDO::PARAM_STR);
    $insertNewMail->bindParam(':altBody', $altBody, PDO::PARAM_STR);
    $insertNewMail->bindParam(':addedTime', $addedTime, PDO::PARAM_STR);
    $insertNewMail->execute();
}

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ipAddress = $_SERVER['REMOTE_ADDR'];
}

if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
}

if(isset($_COOKIE['token'])){
    $token = $_COOKIE['token'];

    $deviceCheck = $conn->prepare("SELECT * FROM devices WHERE token = :token");
    $deviceCheck->bindParam(':token', $token);
    $deviceCheck->execute();

    if($deviceCheck->rowCount() > 0){
        $deviceData = $deviceCheck->fetch();

        $userCheck = $conn->prepare("SELECT * FROM users WHERE id = :id");
        $userCheck->bindParam(':id', $deviceData['userId']);
        $userCheck->execute();

        if($userCheck->rowCount() > 0){
            $userData = $userCheck->fetch();
            $loggedIn = true;
        }
    }
}
?>