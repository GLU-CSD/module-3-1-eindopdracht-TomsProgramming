<?php
require "../config.php";
require "includes/loggedInCheck.php";

$title = "Mijn account - " . $name;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "includes/basePath.php"; ?>
    <?php include "../includes/head.php"; ?>
    <link rel="stylesheet" href="./assets/css/index.css?v=<?php echo filemtime('./assets/css/index.css') ?>" />
</head>
<body>
    <?php include "../includes/announcement.php"; ?>
    <?php include "../includes/headNav.php"; ?>

    <?php include "includes/sidebar.php"; ?>

    <?php include "../includes/footer.php"; ?>
</body>
</html>