<?php
require 'config.php';

$selectNewestProducts = $conn->prepare("SELECT * FROM products ORDER BY createdAt DESC LIMIT 2");
$selectNewestProducts->execute();
$newestProducts = $selectNewestProducts->fetchAll();

$title = "Betaalbare Smartphones & Accessoires - " . $name;

$selectCategories = $conn->prepare("SELECT name, title FROM categories");
$selectCategories->execute();
$categories = $selectCategories->fetchAll(PDO::FETCH_ASSOC);
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
        <div class="productsContainer">
            <?php
            $selectProducts = $conn->prepare("SELECT id, category, brand, name, title, price, mainImage FROM products WHERE category = :category ORDER BY createdAt DESC LIMIT 5");
            foreach ($categories as $category) {
                $selectProducts->bindParam(':category', $category['name']);
                $selectProducts->execute();
                $products = $selectProducts->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($products)) {
                    ?>
                    <div class="category">
                        <h2><?php echo $category['title']; ?></h2>
                        <?php
                        foreach ($products as $product) {
                            ?>
                            <div class="product">
                                <img src="./uploads/img/<?php echo $product['id']; ?>/<?php echo $product['mainImage']; ?>" alt="<?php echo $product['title']; ?>" loading="lazy">
                                <div class="productInfo">
                                    <p class="brand"><?php echo $product['brand']; ?></p>
                                    <h3><?php echo $product['title']; ?></h3>
                                    <p class="price">&euro; <?php echo str_replace('.', ',', $product['price']); ?></p>
                                    <a href="/<?php echo $product['category']; ?>/<?php echo $product['brand']; ?>/<?php echo $product['name']; ?>" class="product-button">Bekijken</a>
                                </div>
                            </div>
                        <?php
                    }
                    ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </main>
    <?php include "includes/footer.php"; ?>
</body>

</html>