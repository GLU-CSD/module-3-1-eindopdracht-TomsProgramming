<?php
if(isset($_GET['category'])){
    require "config.php";

    $category = $_GET['category'];

    if($category != 'producten'){
        $selectCategory = $conn->prepare("SELECT * FROM categories WHERE name = :name");
        $selectCategory->bindParam(':name', $category);
        $selectCategory->execute();

        if($selectCategory->rowCount() == 0){
            echo '<script>location.href = "/";</script>';
            exit;
        }

        $categoryData = $selectCategory->fetch();
        $categoryTitle = $categoryData['title'];
    }else{
        $categoryTitle = "Producten";
    }

    $title = $categoryTitle . " - " . $name;

    if($category != 'producten'){
        $selectBrands = $conn->prepare("SELECT DISTINCT brand FROM products WHERE category = :category");
        $selectBrands->bindParam(':category', $category);
        $selectBrands->execute();
        $brands = $selectBrands->fetchAll();
    }

    $selectHighestPriceSql = "SELECT MAX(price) as highestPrice FROM products";
    $selectHighestPriceParams = [];

    if($category != 'producten'){
        $selectHighestPriceSql .= " WHERE category = :category";
        $selectHighestPriceParams[':category'] = $category;
    }

    $selectHighestPrice = $conn->prepare($selectHighestPriceSql);
    $selectHighestPrice->execute($selectHighestPriceParams);

    if($selectHighestPrice->rowCount() > 0){
        $highestPriceResult = $selectHighestPrice->fetch();
        $highestPrice = $highestPriceResult['highestPrice'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "includes/basePath.php"; ?>
    <?php include "includes/head.php"; ?>
    <link rel="stylesheet" href="assets/css/products.css?v=<?php echo filemtime('assets/css/products.css') ?>">
    <script src="assets/js/products.js?v=<?php echo filemtime('assets/js/products.js') ?>" defer></script>
</head>

<body>
    <?php include "includes/announcement.php"; ?>
    <?php include "includes/headNav.php"; ?>
    <div class="contentWrapper">
        <?php include "includes/sidebar.php"; ?>
        <main>
            <h2><?php echo $categoryTitle; ?></h2>
            <button class="filtersButton">Filters</button>
            <!-- de producten worden ingeladen vanuit de javascript -->
            <div class="productsContainer"></div>
        </main>
    </div>
</body>

</html>
<?php
    }else{
        echo '<script>location.href = "/";</script>';
    }
}else{
    echo '<script>location.href = "/";</script>';
}
?>