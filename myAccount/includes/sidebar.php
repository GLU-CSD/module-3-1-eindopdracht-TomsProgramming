<?php 
$currentPage = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
?>

<aside>
    <ul>
        <li><a href="/mijn-account" class="<?php echo $currentPage == '/mijn-account' ? 'active' : ''; ?>">Home</a></li>
        <li><a href="/mijn-account/account-detials" class="<?php echo $currentPage == '/mijn-account/account-detials' ? 'active' : '' ?>">Mijn account</a></li>
        <li><a href="/mijn-account/bestellingen" class="<?php echo $currentPage == '/mijn-account/bestellingen' ? 'active' : '' ?>">Bestellingen</a></li>
        <li><a href="/mijn-account/uitloggen" class="<?php echo $currentPage == '/mijn-account/uitloggen' ? 'active' : '' ?>">Uitloggen</a></li>
    </ul>

    <h2>Website Beheer</h2>
    <ul>
        <li><a href="/admin/index.php" class="<?php echo $currentPage == '/admin/index.php' ? 'active' : '' ?>">Admin Home</a></li>
        <li><a href="/admin/products.php" class="<?php echo $currentPage == '/admin/products.php' ? 'active' : '' ?>">Producten</a></li>
        <li><a href="/admin/orders.php" class="<?php echo $currentPage == '/admin/orders.php' ? 'active' : '' ?>">Bestellingen</a></li>
        <li><a href="/admin/users.php" class="<?php echo $currentPage == '/admin/users.php' ? 'active' : '' ?>">Gebruikers</a></li>
        <li><a href="" class="<?php echo empty($currentPage) ? 'active' : '' ?>">Footer</a></li>
    </ul>
</aside>