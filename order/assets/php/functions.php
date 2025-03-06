<?php
require '../../../config.php';

require 'classes/orders.php';
require 'classes/zipcode.php';

header('Content-Type: application/json');
$raw_post_data = file_get_contents('php://input');
$post_data = json_decode($raw_post_data, true);

if(isset($post_data['function'])){
    $function = $post_data['function'];

    if($function === 'createOrder'){
        $requiredFields = [
            'products', 'gender', 'firstName', 'lastName', 'country',
            'postalCode', 'houseNumber', 'street', 'city',
            'email', 'phone', 'dateOfBirth'
        ];
    
        $allRequiredFilled = true;
        foreach ($requiredFields as $field) {
            if (empty($post_data[$field])) {
                echo json_encode(array("success" => false, "error" => "Not all required fields are filled", "field" => $field));
                $allRequiredFilled = false;
                break;
            }
        }

        if ($allRequiredFilled) {
            echo Orders::create(
                $post_data['products'], 
                $post_data['gender'], 
                $post_data['firstName'], 
                $post_data['lastNamePrefix'],
                $post_data['lastName'], 
                $post_data['country'],  
                $post_data['postalCode'], 
                $post_data['houseNumber'], 
                $post_data['houseNumberSuffix'],
                $post_data['street'],
                $post_data['city'], 
                $post_data['email'], 
                $post_data['phone'],
                $post_data['dateOfBirth']
            );
        }
    }

    if($function === 'getZipcodeData' && isset($post_data['zipcode']) && isset($post_data['number'])){
        echo Zipcode::get($post_data['zipcode'], $post_data['number']);
    }
}else{
    echo json_encode(array("success" => false, "error" => "No function provided"));
}
?>