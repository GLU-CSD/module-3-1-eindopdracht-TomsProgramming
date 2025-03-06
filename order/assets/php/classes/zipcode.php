<?php
\Stripe\Stripe::setApiKey($stripeSecretKey);

class Zipcode {
    static function get($zipcode, $number){
        global $postcodeApiKey;
        $url = "https://json.api-postcode.nl?postcode=$zipcode&number=$number";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "token: $postcodeApiKey"
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_encode(array("success" => true, "data" => json_decode($response)));
    }
}
?>