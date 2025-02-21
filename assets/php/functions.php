<?php
require '../../config.php';

require 'classes/products.php';

header('Content-Type: application/json');
$raw_post_data = file_get_contents('php://input');
$post_data = json_decode($raw_post_data, true);

if($post_data['function']){
    $function = $post_data['function'];

    if($function === 'getProducts' && isset($post_data['category'])){
        echo Products::get($post_data['category'], $post_data['brand'], $post_data['limit']);
    }else if($function === 'get5ProductsFromAllCategory'){
        echo Products::get5ProductsFromAllCategory();
    }else if($function === 'getProductFromId' && isset($post_data['id'])){
        echo Products::getProductFromId($post_data['id']);
    }
}else{
    echo json_encode(array("success" => false, "error" => "No function provided"));
}
?>