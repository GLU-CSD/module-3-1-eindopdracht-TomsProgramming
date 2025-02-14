<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
date_default_timezone_set("UTC");

$loggedIn = false;
$userData = [];
$deviceData = [];

$ipAddress = '';

try {
    $conn = new PDO("mysql:host=localhost;dbname=webshop", "tom", "ytz.HMW_pvn!yqv8kpr");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}   

function loadTemplate($templatePath, $variables) {
    $template = file_get_contents($templatePath);
    foreach ($variables as $key => $value) {
        $template = str_replace("{{ $key }}", $value, $template);
    }
    return $template;
}

function sendMail($templateHtmlPath, $templateAltPath, $variables, $email, $subject){
    global $conn, $userData, $deviceData;
    $variables['yearDate'] = date('Y');
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
?>