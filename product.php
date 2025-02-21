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
        $description = $product['description'];

        $title = $product['title'] . " - " . $name;
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
                <img src="/uploads/img/<?php echo $product['id'] ?>/<?php echo $mainImage ?>" alt="<?php echo $prodcutTitle ?>" />
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