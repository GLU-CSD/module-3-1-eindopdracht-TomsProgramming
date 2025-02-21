<?php

class Verification
{
    static function hasCodeBeenSent()
    {
        global $conn, $userData, $deviceData;
        if($deviceData['id'] == null){
            return 1;
        }

        $deviceVerificationExpiresDateTime = ($deviceData['verificationExpiresAt'] != null) ? new DateTime($deviceData['verificationExpiresAt']) : new DateTime('now');
        $now = new DateTime('now');

        if($deviceVerificationExpiresDateTime > $now){
            return true;
        }else{
            return false;
        }
    }

    static function createAndSendCode($mainPath){
        global $conn, $redis, $verificationValidityDuration, $deviceData, $userData;
        $userId = $deviceData['userId'];

        if (!$redis->exists("webshop:verification:$userId")) {
            $redis->setex("webshop:verification:$userId", 60, 1);
        }else{
            $redis->incr("webshop:verification:$userId");
        }

        $code = rand(100000, 999999);
        $expiresAt = date('Y-m-d H:i:s', strtotime('+600 seconds'));
        $currentTime = date('Y-m-d H:i:s');

        $updateDevice = $conn->prepare("UPDATE devices SET verificationCode = :code, verificationExpiresAt = :expiresAt, lastUpdatedAt = :lastUpdatedAt WHERE id = :deviceId");
        $updateDevice->bindParam(':code', $code, PDO::PARAM_INT);
        $updateDevice->bindParam(':expiresAt', $expiresAt, PDO::PARAM_STR);
        $updateDevice->bindParam(':lastUpdatedAt', $currentTime, PDO::PARAM_STR);
        $updateDevice->bindParam(':deviceId', $deviceData['id'], PDO::PARAM_INT);
        $updateDevice->execute();

        $utcTime = new DateTime($expiresAt, new DateTimeZone('UTC'));
        $userTime = $utcTime->setTimezone(new DateTimeZone($deviceData['timezone']));
        $expiresAtUserTime = $userTime->format('Y-m-d H:i:s');

        $variables = array(
            "code" => $code,
            "expireDate" => $expiresAtUserTime
        );

        sendMail(''.$mainPath.'emailTemplates/verificationCode.html', ''.$mainPath.'emailTemplates/verificationCode.txt', $variables, $userData['email'], '2-staps verificatie code');
    }

    static function resendCode($mainPath){
        global $conn, $redis, $verificationValidityDuration, $deviceData, $userData;

        $userId = $deviceData['userId'];

        if ($redis->exists("webshop:verification:$userId") && $redis->get("webshop:verification:$userId") > 5) {
            return json_encode(array("success" => false, "error" => "Wacht minimaal één minuut voordat u de e-mail opnieuw probeert te versturen."));
        }

        if (!$redis->exists("webshop:verification:$userId")) {
            $redis->setex("webshop:verification:$userId", 60, 1);
        }else{
            $redis->incr("webshop:verification:$userId");
        }

        $verificationSentStatus = verification::hasCodeBeenSent();
        if($verificationSentStatus === 1){
            return false;
        }else if ($verificationSentStatus == false){
            verification::createAndSendCode($mainPath);
        }else{

            if($deviceData['id'] == null){
                return json_encode(array("success" => false, "error" => "Er is geen verificatiecode gevonden."));
            }

            $code = $deviceData['verificationCode'];
            $expiresAt = $deviceData['verificationExpiresAt'];

            $utcTime = new DateTime($expiresAt, new DateTimeZone('UTC'));
            $userTime = $utcTime->setTimezone(new DateTimeZone($deviceData['timezone']));
            $expiresAtUserTime = $userTime->format('Y-m-d H:i:s');

            $variables = array(
                "code" => $code,
                "expireDate" => $expiresAtUserTime
            );
    
            sendMail(''.$mainPath.'emailTemplates/verificationCode.html', ''.$mainPath.'emailTemplates/verificationCode.txt', $variables, $userData['email'], '2-staps verificatie code');
            return json_encode(array("success" => true));
        }
    }

    static function verifyCode($mainPath, $code){
        global $conn, $redis, $deviceDetect, $ipAddress, $deviceData, $userData;
        $userId = $deviceData['userId'];

        if ($redis->exists("webshop:verification:verifyCode:$userId") && $redis->get("webshop:verification:verifyCode:$userId") > 5) {
            return json_encode(array("success" => false, "error" => "U heeft te vaak geprobeerd de code te verifiëren."));
        }

        if (!$redis->exists("webshop:verification:verifyCode:$userId")) {
            $redis->setex("webshop:verification:verifyCode:$userId", 60, 1);
        }else{
            $redis->incr("webshop:verification:verifyCode:$userId");
        }

        if($deviceData['id'] == null){
            return json_encode(array("success" => false, "error" => "Er is geen verificatiecode gevonden."));
        }

        $verificationCode = $deviceData['verificationCode'];

        if($verificationCode != $code){
            return json_encode(array("success" => false, "error" => "De code is onjuist"));
        }

        $verificationExpiresAt = new DateTime($deviceData['verificationExpiresAt']);
        $now = new DateTime('now');

        if ($verificationExpiresAt < $now) {
            return json_encode(array("success" => false, "error" => "De code is verlopen"));
        }

        $currentTime = date('Y-m-d H:i:s');
        $updateDevice = $conn->prepare("UPDATE devices SET emailVerified = 1, lastUpdatedAt = :lastUpdatedAt WHERE id = :deviceId");
        $updateDevice->bindParam(':lastUpdatedAt', $currentTime, PDO::PARAM_STR);
        $updateDevice->bindParam(':deviceId', $deviceData['id'], PDO::PARAM_INT);
        $updateDevice->execute();

        $utcTime = new DateTime('now', new DateTimeZone('UTC'));
        $userTime = $utcTime->setTimezone(new DateTimeZone($deviceData['timezone']));
        $currentTime = $userTime->format('Y-m-d H:i:s');

        $device = $deviceDetect->isTablet() ? 'Tablet' : ($deviceDetect->isMobile() ? 'Mobile' : 'Desktop');
        if($deviceDetect->isiOS()){
            $device .= ' (iOS)';
        } elseif($deviceDetect->isAndroidOS()){
            $device .= ' (Android)';
        }
        
        $variables = array(
            "loginTime" => $currentTime,
            "ipAddress" => $ipAddress,
            "device" => $device,
        );

        sendMail(''.$mainPath.'emailTemplates/newLogin.html', ''.$mainPath.'emailTemplates/newLogin.txt', $variables, $userData['email'], 'Bevestiging van nieuwe login');
        return json_encode(array("success" => true));
    }
} 
?>