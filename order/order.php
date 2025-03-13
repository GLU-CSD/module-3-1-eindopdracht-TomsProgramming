<?php
require "../config.php";
$email = '';
$title = "Bestellen - " . $name;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/basePath.php"; ?>
    <?php include "../includes/head.php"; ?>
    <link rel="stylesheet" href="assets/css/order.css?v=<?php echo filemtime('assets/css/order.css') ?>">
    <script src="https://js.stripe.com/v3/" defer></script>
    <script>
    const stripePublicKey = '<?php echo $stripePublicKey; ?>';
    </script>
    <script src="assets/js/order.js?v=<?php echo filemtime('assets/js/order.js') ?>" defer></script>
</head>

<body>
    <?php include "../includes/announcement.php"; ?>
    <?php include "../includes/headNav.php"; ?>

    <main>
        <div class="extraInfo">
            <div class="container">
                <h3>Persoons gegevens</h3>
                <form class="orderForm">
                    <div class="gender">
                        <div class="radio">
                            <input type="radio" id="dhr" name="gender" value="Dhr." required>
                            <label for="dhr">Dhr.</label>
                        </div>
                        <div class="radio">
                            <input type="radio" id="mevr" name="gender" value="Mevr.">
                            <label for="mevr">Mevr.</label>
                        </div>
                        <div class="radio">
                            <input type="radio" id="other" name="gender" value="...">
                            <label for="other">...</label>
                        </div>
                    </div>

                    <div class="name">
                        <div class="input">
                            <input type="text" name="firstName" id="firstName" maxlength="50" placeholder required>
                            <span class="label">Voornaam</span>
                        </div>
                        <div class="input">
                            <input type="text" name="lastNamePrefix" id="lastNamePrefix" maxlength="20" placeholder>
                            <span class="label">Tussenvoegsel</span>
                        </div>
                        <div class="input">
                            <input type="text" name="lastName" id="lastName" maxlength="100" placeholder required>
                            <span class="label">Achternaam</span>
                        </div>
                    </div>

                    <div class="address">
                        <div class="input">
                            <select name="country" id="country" required>
                                <option value="" disabled selected>Kies een land</option>
                                <option value="netherlands">Nederland</option>
                                <option value="belgium">België</option>
                            </select>

                            <span class="label">Land</span>
                        </div>

                        <div class="input">
                            <input type="text" name="postalCode" id="postalCode" maxlength="10" placeholder required>
                            <span class="label">Postcode</span>
                        </div>

                        <div class="houseNumberDiv">
                            <div class="input houseNumberInput">
                                <input type="number" name="houseNumber" id="houseNumber" placeholder required>
                                <span class="label">Huisnummer</span>
                            </div>
                            <div class="input houseNumberSuffixInput">
                                <input type="text" name="houseNumberSuffix" id="houseNumberSuffix" maxlength="10"
                                    placeholder>
                                <span class="label">Toevoeging</span>
                            </div>
                        </div>

                        <div class="input">
                            <input type="text" name="street" id="street" maxlength="100" placeholder required>
                            <span class="label">Straatnaam</span>
                        </div>

                        <div class="input">
                            <input type="text" name="city" id="city" placeholder required>
                            <span class="label">Plaats</span>
                        </div>
                    </div>

                    <div class="contact">
                        <div class="input">
                            <input type="email" name="email" id="email" value="<?php echo $email; ?>" maxlength="320"
                                placeholder required>
                            <span class="label">E-mailadres</span>
                        </div>
                        <div class="input">
                            <input type="tel" name="phone" id="phone" maxlength="15" placeholder required>
                            <span class="label">Telefoonnummer</span>
                        </div>
                        <div class="input">
                            <input type="date" name="dateOfBirth" id="dateOfBirth" required>
                            <span class="label">Geboortedatum</span>
                        </div>
                    </div>

                    <div class="termsAndConditionsDiv">
                        <input type="checkbox" name="termsAndConditions" id="termsAndConditions" required>
                        <label for="termsAndConditions">Ik ga akkoord met de <a href="/algemene-voorwaarden"
                                target="_blank">algemene voorwaarden</a></label>
                    </div>

                    <button class="submitBtn" type="submit" disabled>Verder naar betalen</button>
                </form>

            </div>

        </div>
        <?php include "includes/cartSide.php"; ?>
    </main>
</body>

</html>