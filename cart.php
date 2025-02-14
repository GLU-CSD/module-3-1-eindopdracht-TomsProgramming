<?php
require "config.php";

$title = "Winkelwagen - SimpelWinkelen";
?>
<!doctype html>
<html class="no-js" lang="nl">

<head>
    <?php include "includes/basePath.php"; ?>
    <?php include "includes/head.php"; ?>

    <link rel="stylesheet" href="assets/css/cart.css">
    <script src="https://kit.fontawesome.com/0fa38cfac4.js" crossorigin="anonymous" defer></script>
    <script src="assets/js/cart.js" defer></script>
</head>

<body>
    <?php include "includes/announcement.php"; ?>
    <?php include "includes/headNav.php"; ?>
    <main>
        <h1>Winkelwagen</h1>
        <!-- <div class="emptyCartContainer">
            <div class="empty">
                <p>Je winkelwagen is leeg.</p>
                <a href="/categorie/alle-producten" class="cta-button">Bekijk producten</a>
            </div>
        </div> -->
        <div class="cartContainer">
            <div class="cartItems">
                <div class="cartItem">
                    <img src="./assets/img/iphone-16-pro.png" alt="Iphone 16 Pro">
                    <div class="productInfo">
                        <p class="brand">Apple</p>
                        <h3>iPhone 16 Pro</h3>
                        <p class="price">€ 999,99</p>
                        <div class="actions">
                            <div class="quantity">
                                <select name="quantitySelect" id="quantitySelect">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="more">Meer</option>
                                </select>
                            </div>
                            <button class="remove"><i class="fa-regular fa-trash-can"></i></button>
                        </div>
                    </div>
                </div>
                <div class="cartItem">
                    <img src="./assets/img/iphone-16-pro.png" alt="Iphone 16 Pro">
                    <div class="productInfo">
                        <p class="brand">Apple</p>
                        <h3>iPhone 16 Proddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd</h3>
                        <p class="price">€ 999,99</p>
                        <div class="actions">
                            <div class="quantity">
                                <select name="quantitySelect" id="quantitySelect">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="more">Meer</option>
                                </select>
                            </div>
                            <button class="remove"><i class="fa-regular fa-trash-can"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cartCheckout">
                <h2>Overzicht</h2>
                <div class="cost">
                    <table>
                        <tr>
                            <td class="costName">Artikelen (2)</td>
                            <td class="costPrice">€ 36,91</td>
                        </tr>
                        <tr>
                            <td class="costName">Verzendkosten</td>
                            <td class="costPrice">€ 0,00</td>
                        </tr>
                        <tr>
                            <td colspan="2"><hr></td>
                        </tr>
                        <tr>
                            <td class="costName">Totaal</td>
                            <td class="costPrice totalPrice">€ 36,91</td>
                        </tr>
                    </table>
                </div>
                <a href="/bestellen">Verder naar bestellen</a>
            </div>
        </div>
    </main>
    <?php include "includes/footer.php"; ?>
</body>

</html>