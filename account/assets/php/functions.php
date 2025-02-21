<?php
require '../../../config.php';

require 'classes/users.php';
require 'classes/verification.php';

header('Content-Type: application/json');

$raw_post_data = file_get_contents('php://input');
$post_data = json_decode($raw_post_data, true);

if($post_data['function']){
    $function = $post_data['function'];

    if($function == "register" && isset($post_data['email']) && isset($post_data['confirmEmail']) && isset($post_data['password']) && isset($post_data['confirmPassword']) && isset($post_data['timezone'])){
        echo Users::register($post_data['email'], $post_data['confirmEmail'], $post_data['password'], $post_data['confirmPassword'], $post_data['timezone']);
    }elseif ($function == "login" && isset($post_data['email']) && isset($post_data['password']) && isset($post_data['timezone'])){
        echo Users::login($post_data['email'], $post_data['password'], $post_data['timezone']);
    }elseif ($function == "resendVerificationCode"){
        echo Verification::resendCode('../../../');
    }elseif($function == "verifyCode" && isset($post_data['code'])){
        echo Verification::verifyCode('../../../', $post_data['code']);
    }
    // elseif($function == 'logout'){
    //     echo Users::logout();
    // }else{
    //     echo json_encode(array("success" => false, "error" => "Function does not exist", "function" => $function));
    // }
}else{
    echo json_encode(array("success" => false, "error" => "No function provided"));
}
?>