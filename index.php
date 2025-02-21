<?php
require 'config.php';

$selectNewestProducts = $conn->prepare("SELECT * FROM products ORDER BY createdAt DESC LIMIT 2");
$selectNewestProducts->execute();
$newestProducts = $selectNewestProducts->fetchAll();

$title = "Betaalbare Elektronica - " . $name;
?>
<!doctype html>
<html class="no-js" lang="nl">

<head>
    <?php include "includes/basePath.php"; ?>
    <?php include "includes/head.php"; ?>

    <link rel="stylesheet" href="assets/css/index.css?v=<?php echo filemtime('assets/css/index.css') ?>">
    <script src="assets/js/index.js?v=<?php echo filemtime('assets/js/index.js') ?>" defer></script>
</head>

<body>
    <?php include "includes/announcement.php"; ?>
    <?php include "includes/headNav.php"; ?>
    <main>
        <section class="hero">
            <div class="heroContent">
                <h1>Betaalbare Elektronica <span> </span> voor Iedereen</h1>
                <p>Ontdek de beste deals voor laptops, smartphones en accessoires.<br> Bestel eenvoudig online!</p>
                <a href="/producten" class="cta-button">Bekijk Producten</a>
            </div>
            <?php 
            foreach($newestProducts as $product){
                echo '
                <div class="heroItem">
                    <img src="./uploads/img/'.$product['id'].'/'.$product['mainImage'].'" alt="'.$product['title'].'" loading="lazy">
                    <div class="productInfo">
                        <p class="brand">'.$product['brand'].'</p>
                        <h3>'.$product['title'].'</h3>
                        <p class="price">&euro; '.str_replace('.', ',', $product['price']).'</p>
                        <a href="/'.$product['category'].'/'.$product['brand'].'/'.$product['name'].'" class="product-button">Bekijken</a>
                    </div>
                </div>
                ';
            }
            ?>
        </section>
        <div class="productsContainer"></div>
    </main>
    <?php include "includes/footer.php"; ?>
</body>

</html>