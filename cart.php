<?php
$title = "Winkelwagen - SimpelWinkelen";
?>
<!doctype html>
<html class="no-js" lang="nl">

<head>
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
            <div class="cartItem">
                <img src="./assets/img/iphone-16-pro.png" alt="Iphone 16 Pro">
                <div class="productInfo">
                    <p class="brand">Apple</p>
                    <h3>iPhone 16 Pro</h3>
                    <p class="price">€ 999,99</p>
                    <!-- <div class="quantity">
                        <button>-</button>
                        <input type="number" value="1">
                        <button>+</button>
                    </div> -->
                    <button class="remove">Verwijderen</button>
                </div>
            </div>
            <!-- 
            <div class="cartItem">
                <img src="./assets/img/galaxy-s25-ultra.png" alt="Samsung Galaxy S25 Ultra">
                <div class="productInfo">
                    <p class="brand">Samsung</p>
                    <h3>Galaxy S25 Ultra</h3>
                    <p class="price">€ 999,99</p>
                    <div class="quantity">
                        <button>-</button>
                        <input type="number" value="1">
                        <button>+</button>
                    </div>
                    <button class="remove">Verwijderen</button>
                </div>
            </div> -->
        </div>
    </main>
    <?php include "includes/footer.php"; ?>
</body>

</html>