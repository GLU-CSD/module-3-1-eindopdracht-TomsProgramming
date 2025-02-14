<?php
$title = 'SimpelWinkelen - iPhone 16 Pro';
?>
<!doctype html>
<html class="noJs" lang="nl">

<head>
    <?php include "includes/basePath.php"; ?>
    <?php include "includes/head.php"; ?>
    <link rel="stylesheet" href="assets/css/product.css?v=<?php echo filemtime('assets/css/product.css') ?>" />
    <script src="assets/js/product.js?v=<?php echo filemtime('assets/js/product.js') ?>" defer></script>
</head>

<body>
    <?php include "includes/announcement.php"; ?>
    <?php include "includes/headNav.php"; ?>

    <main>
        <section class="productDetail">
            <div class="productImage">
                <img src="/assets/img/iphone-16-pro.png" alt="iPhone 16 Pro" />
            </div>
            <div class="productInfo">
                <h1 class="productName">iPhone 16 Pro</h1>
                <p class="productBrand">Apple</p>
                <p class="price">€ 999,99</p>
                <button onclick="cart.setItemInCart(1)" class="ctaButton">Voeg toe aan winkelwagen</button>
                <div class="productShortDescription">
                    <p>
                        Ervaar de nieuwste technologie met de iPhone 16 Pro. Geniet van een verbluffende camera,
                        krachtige prestaties en een elegant design.
                    </p>
                </div>
            </div>
        </section>

        <section class="productDescription">
            <h2>Productbeschrijving</h2>
            <p>
                De iPhone 16 Pro combineert baanbrekende technologie met een strak en modern design. Met de nieuwste A16
                Bionic-chip en geavanceerde camerasystemen is deze smartphone ontworpen voor zowel professionele als
                persoonlijke toepassingen.
            </p>
        </section>

        <section class="productSpecifications">
            <h2>Specificaties</h2>
            <ul>
                <li>Scherm: 6.1 inch Super Retina XDR</li>
                <li>Processor: A16 Bionic</li>
                <li>Opslag: 128GB / 256GB / 512GB</li>
                <li>Camera: Triple 12MP camerasysteem</li>
                <li>Batterijduur: Tot 18 uur video afspelen</li>
            </ul>
        </section>
    </main>

    <?php include "includes/footer.php"; ?>
</body>

</html>