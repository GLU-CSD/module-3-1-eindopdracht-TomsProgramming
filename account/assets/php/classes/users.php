<?php
class Users
{
    static function createDevice($userId, $timezone)
    {
        global $conn, $ipAddress, $userAgent;

        $currentTime = date('Y-m-d H:i:s');

        $createDevice = $conn->prepare("INSERT INTO devices (userId, ipAddress, userAgent, timezone, createdAt, lastUpdatedAt) VALUES (:userId, :ipAddress, :userAgent, :timezone, :createdAt, :lastUpdatedAt)");
        $createDevice->bindParam(':userId', $userId);
        $createDevice->bindParam(':ipAddress', $ipAddress);
        $createDevice->bindParam(':userAgent', $userAgent);
        $createDevice->bindParam(':timezone', $timezone);
        $createDevice->bindParam(':createdAt', $currentTime);
        $createDevice->bindParam(':lastUpdatedAt', $currentTime);
        $createDevice->execute();

        $deviceId = $conn->lastInsertId();

        $token = '';

        while (true)
        {
            $token = $userId . $deviceId . bin2hex(random_bytes(32));
            
            $tokenCheck = $conn->prepare("SELECT * FROM devices WHERE token = :token");
            $tokenCheck->bindParam(':token', $token);
            $tokenCheck->execute();

            if($tokenCheck->rowCount() == 0){
                $currentTime = date('Y-m-d H:i:s');
                $updateToken = $conn->prepare("UPDATE devices SET token = :token, lastUpdatedAt = :lastUpdatedAt WHERE id = :id");
                $updateToken->bindParam(':token', $token);
                $updateToken->bindParam(':lastUpdatedAt', $currentTime);
                $updateToken->bindParam(':id', $deviceId);
                $updateToken->execute();
                break;
            }
        }
        
        setcookie("token", $token, time() + (86400 * 30), "/");
    }

    static function register($email, $confirmEmail, $password, $confirmPassword, $timezone)
    {
        global $redis, $conn, $ipAddress;

        if($redis->exists("webshop:register:limit:$ipAddress") && $redis->get("webshop:register:limit:$ipAddress") > 1){
            return json_encode(array("success" => false, "error" => "Per IP-adres kan slechts één account elke twee minuten worden aangemaakt."));
        }

        if ($email != $confirmEmail) {
            return json_encode(array("success" => false, "error" => "Emails komen niet overeen"));
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return json_encode(array("success" => false, "error" => "Email is niet geldig"));
        }

        if (strlen($email) > 254) {
            return json_encode(array("success" => false, "error" => "Email mag maximaal 254 tekens bevatten"));
        }

        if($password != $confirmPassword){
            return json_encode(array("success" => false, "error" => "Wachtwoorden komen niet overeen"));
        }

        if(strlen($password) < 8){
            return json_encode(array("success" => false, "error" => "Wachtwoord moet minimaal 8 tekens bevatten"));
        }

        if(empty($email) || empty($password) || empty($timezone)){
            return json_encode(array("success" => false, "error" => "Vul alle velden in"));
        }

        $emailCheck = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $emailCheck->bindParam(':email', $email);
        $emailCheck->execute();

        if($emailCheck->rowCount() > 0){
            return json_encode(array("success" => false, "error" => "Email bestaat al"));
        }

        if (!$redis->exists("webshop:register:limit:$ipAddress")) {
            $redis->setex("webshop:register:limit:$ipAddress", 120, 1);
        }else{
            $redis->incr("webshop:register:limit:$ipAddress");
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $registerUser = $conn->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        $registerUser->bindParam(':email', $email);
        $registerUser->bindParam(':password', $passwordHash);
        $registerUser->execute();

        $lastId = $conn->lastInsertId();
        self::createDevice($lastId, $timezone);
        return json_encode(array("success" => true));
    }

    static function login($email, $password, $timezone){
        global $redis, $conn, $ipAddress;

        if ($redis->exists("webshop:login:limit:$ipAddress") && $redis->get("webshop:login:limit:$ipAddress") > 5) {
            return json_encode(array("success" => false, "error" => "Per IP-adres kan slechts vijf keer per minuut proberen in te loggen."));
        }

        if (!$redis->exists("webshop:login:limit:$ipAddress")) {
            $redis->setex("webshop:login:limit:$ipAddress", 60, 1);
        }else{
            $redis->incr("webshop:login:limit:$ipAddress");
        }

        $userCheck = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $userCheck->bindParam(':email', $email);
        $userCheck->execute();

        $userCount = $userCheck->rowCount();

        if($userCount == 0){
            return json_encode(array("success" => false, "error" => "U heeft de email of wachtwoord verkeerd ingevoerd"));
        }

        $userData = $userCheck->fetch();
        if(!password_verify($password, $userData['password'])){
            return json_encode(array("success" => false, "error" => "U heeft de email of wachtwoord verkeerd ingevoerd"));

        }

        self::createDevice($userData['id'], $timezone);
        return json_encode(array("success" => true));
    }

    static function logout(){
        setcookie("token", "", time() - 3600, "/");
        echo json_encode(array("success" => true));
    }
}
?>