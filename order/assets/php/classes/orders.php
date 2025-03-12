<?php
\Stripe\Stripe::setApiKey($stripeSecretKey);

class Orders {
    static function create($products, $gender, $firstName, $lastNamePrefix, $lastName, $country, $postalCode, $houseNumber, $houseNumberSuffix, $street, $city, $email, $phone, $dateOfBirth){
        global $conn;
        
        $error = false;
        
        if (!isset($gender) || empty($gender) || strlen($gender) > 10) {
            $error = true;
        }

        if (empty($firstName) || strlen($firstName) > 50) {
            $error = true;
        }

        if($lastNamePrefix && strlen($lastNamePrefix) > 20){
            $error = true;
        }

        if (empty($lastName) || strlen($lastName) > 100) {
            $error = true;
        }

        if (empty($country) || $country === 'country' || strlen($country) > 50) {
            $error = true;
        }

        if (empty($postalCode) || strlen($postalCode) > 10 || !preg_match('/^[1-9][0-9]{3}[A-Z]{2}$/i', $postalCode)) {
            $error = true;
        }

        if (empty($houseNumber) || strlen($houseNumber) > 10 || !filter_var($houseNumber, FILTER_VALIDATE_INT)) {
            $error = true;
        }

        if($houseNumberSuffix && strlen($houseNumberSuffix) > 10){
            $error = true;
        }

        if (empty($street) || strlen($street) > 100) {
            $error = true;
        }

        if (empty($city) || strlen($city) > 100) {
            $error = true;
        }

        if (empty($email) || strlen($email) > 320 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = true;
        }

        if (empty($phone) || strlen($phone) > 15 || !preg_match('/^[0-9\+\-\s]{8,15}$/', $phone)) {
            $error = true;
        }

        if($dateOfBirth && !preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/', $dateOfBirth)){
            $error = true;
        }

        if($error){
            return json_encode(array("success" => false, "message" => "Er is een fout opgetreden. Controleer of alle velden correct zijn ingevuld."));
        }

        $gender = htmlspecialchars($gender);
        $firstName = htmlspecialchars($firstName);
        $lastNamePrefix = htmlspecialchars($lastNamePrefix);
        $lastName = htmlspecialchars($lastName);
        $country = htmlspecialchars($country);
        $postalCode = htmlspecialchars($postalCode);
        $houseNumber = htmlspecialchars($houseNumber);
        $houseNumberSuffix = htmlspecialchars($houseNumberSuffix);
        $street = htmlspecialchars($street);
        $city = htmlspecialchars($city);
        $email = htmlspecialchars($email);
        $phone = htmlspecialchars($phone);

        $productsArray = json_decode($products, true);
        $totalPrice = 0;

        $productsData = [];

        if (!empty($productsArray)) {
            foreach ($productsArray as $productId => $aantal) {
                $selectProduct = $conn->prepare("SELECT * FROM products WHERE id = :id");
                $selectProduct->bindParam(':id', $productId);
                $selectProduct->execute();
                
                if($selectProduct->rowCount() == 0){
                    return;
                }

                $product = $selectProduct->fetch();
                $productData = [
                    "quantity" => $aantal, 
                    "product_data" => [
                        "id" => $product['id'], 
                        "name" => $product['name'], 
                        "brand" => $product['brand'],
                        "price" => $product['price'], 
                        "title" => $product['title'], 
                        "mainImage" => $product['mainImage'], 
                        "description" => $product['description']
                    ]
                ];    
                
                array_push($productsData, $productData);
                $totalPrice += $product['price'] * $aantal;
            }
        }

        if($totalPrice == 0){
            return json_encode(array("success" => false, "message" => "Er is een fout opgetreden. Controleer of alle velden correct zijn ingevuld.1"));
        }

        $encodedProducts = json_encode($productsData);

        $order = $conn->prepare("INSERT INTO orders (products, totalPrice, gender, firstName, lastNamePrefix, lastName, country, postalCode, houseNumber, houseNumberSuffix, street, city, email, phone, dateOfBirth) VALUES
        (:products, :totalPrice, :gender, :firstName, :lastNamePrefix, :lastName, :country, :postalCode, :houseNumber, :houseNumberSuffix, :street, :city, :email, :phone, :dateOfBirth)");

        $order->bindParam(':products', $encodedProducts);
        $order->bindParam(':totalPrice', $totalPrice);
        $order->bindParam(':gender', $gender);
        $order->bindParam(':firstName', $firstName);
        $order->bindParam(':lastNamePrefix', $lastNamePrefix);
        $order->bindParam(':lastName', $lastName);
        $order->bindParam(':country', $country);
        $order->bindParam(':postalCode', $postalCode);
        $order->bindParam(':houseNumber', $houseNumber);
        $order->bindParam(':houseNumberSuffix', $houseNumberSuffix);
        $order->bindParam(':street', $street);
        $order->bindParam(':city', $city);
        $order->bindParam(':email', $email);
        $order->bindParam(':phone', $phone);
        $order->bindParam(':dateOfBirth', $dateOfBirth);
        
        if(!$order->execute()){
            return json_encode(array("success" => false, "message" => "Er is een fout opgetreden. Controleer of alle velden correct zijn ingevuld.0"));
        }

        $orderId = $conn->lastInsertId();

        $stripePayementIntent = \Stripe\PaymentIntent::create([
            'amount' => $totalPrice * 100,
            'currency' => 'eur',
            'metadata' => [
                'order_id' => $orderId
            ]
        ]);

        $updateOrder = $conn->prepare("UPDATE orders SET stripePaymentIntentId = :stripePaymentIntentId, stripeClientSecret = :stripeClientSecret WHERE id = :id");
        $updateOrder->bindParam(':stripePaymentIntentId', $stripePayementIntent->id);
        $updateOrder->bindParam(':stripeClientSecret', $stripePayementIntent->client_secret);
        $updateOrder->bindParam(':id', $orderId);
        $updateOrder->execute();

        $_SESSION['stripePaymentIntentId'] = $stripePayementIntent->id;
        $_SESSION['stripeClientSecret'] = $stripePayementIntent->client_secret;

        return json_encode(array("success" => true));
    }
}
?>  