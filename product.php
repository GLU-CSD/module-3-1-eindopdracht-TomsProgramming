<?php


if(isset($_GET['category'], $_GET['brand'], $_GET['model'])){
    require "config.php";

    $category = $_GET['category'];
    $brand = $_GET['brand'];
    $model = $_GET['model'];

    $selectProduct = $conn->prepare("SELECT * FROM products WHERE category = :category AND brand = :brand AND name = :name");
    $selectProduct->bindParam(':category', $category);
    $selectProduct->bindParam(':brand', $brand);
    $selectProduct->bindParam(':name', $model);
    $selectProduct->execute();

    if($selectProduct->rowCount() > 0){
        $product = $selectProduct->fetch();

        $id = $product['id'];
        $mainImage = $product['mainImage'];
        $prodcutTitle = $product['title'];
        $price = str_replace('.', ',', $product['price']);
        $description = str_replace('\u0027', "'", $product['description']);

        $title = $product['title'] . " - " . $name;

        $get5Products = $conn->prepare("SELECT * FROM products WHERE category = :category AND name != :name LIMIT 5");
        $get5Products->bindParam(':category', $category);
        $get5Products->bindParam(':name', $model);
        $get5Products->execute();
        $randomProducts = $get5Products->fetchAll();
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
        <div class="addedToCard">
            <div class="head">
                <svg width="32" height="32" viewBox="0 0 24 24">
                    <path
                        d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2m0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8m3.82-11.51a.5.5 0 0 0-.7 0l-4.74 4.74-1.5-1.49a.48.48 0 0 0-.7 0l-.53.53a.5.5 0 0 0 0 .71L10 15.35a.48.48 0 0 0 .7 0l5.62-5.62a.5.5 0 0 0 0-.71Z">
                    </path>
                </svg>
                <p>Het artikel is succesvol toegevoegd aan je winkelwagen</p>
                <button class="close"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="scroll">
                <div class="product">
                    <img src="/uploads/img/<?php echo $product['id'] ?>/<?php echo $mainImage ?>"
                        alt="<?php echo $prodcutTitle ?>" />
                    <div class="info">
                        <p class="name"><?php echo $prodcutTitle ?></p>
                        <p class="price">€ <?php echo $price ?></p>
                    </div>
                </div>
                <div class="otherProducts">
                    <p class="headText">Misschien ben je ook geïnteresseerd in</p>
                    <div class="productsContainer">
                        <?php foreach($randomProducts as $randomProduct){ ?>
                        <a class="product"
                            href="/product/<?php echo $category ?>/<?php echo $brand ?>/<?php echo $randomProduct['name'] ?>">
                            <img src="/uploads/img/<?php echo $randomProduct['id'] ?>/<?php echo $randomProduct['mainImage'] ?>"
                                alt="<?php echo $randomProduct['title'] ?>" />
                            <div class="info">
                                <p class="name"><?php echo $randomProduct['title'] ?></p>
                                <p class="price">€ <?php echo str_replace('.', ',', $randomProduct['price']) ?></p>
                            </div>
                        </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="buttons">
                <a href="/winkelwagen" class="ctaButton">Bekijk winkelwagen</a>
                <button class="ctaButton close">Verder winkelen</button>
            </div>
        </div>
        <div class="addedToCardOverlay"></div>
        <section class="productDetail">
            <div class="productImage">
                <img src="/uploads/img/<?php echo $product['id'] ?>/<?php echo $mainImage ?>"
                    alt="<?php echo $prodcutTitle ?>" />
            </div>
            <div class="productInfo">
                <h1 class="productName"><?php echo $prodcutTitle ?></h1>
                <p class="productBrand"><?php echo $brand ?></p>
                <p class="price">€ <?php echo $price ?></p>
                <button onclick="cart.addItem(<?php echo $id ?>)" class="ctaButton">Voeg toe aan winkelwagen</button>
                <div class="productShortDescription">
                    <p><?php echo $description ?></p>
                </div>
            </div>
        </section>

        <!-- <section class="productDescription">
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
        </section> -->
    </main>

    <?php include "includes/footer.php"; ?>
</body>

</html>
<?php
    }else{
        echo '<script>window.location.href = "/";</script>';
    }
}else{
    echo '<script>window.location.href = "/";</script>';
}
?>