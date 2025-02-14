<nav class="headNav" aria-label="Hoofdmenu">
    <div class="top">
        <a href="/" class="logo">
            <p>SimpelWinkelen</p>
        </a>
        <form class="search" action="/zoeken" method="get">
            <input type="text" id="searchInput" name="q" placeholder="Waar ben je naar op zoek?">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
        <button onclick="window.location = '';" class="rightSideBtn user"><i class="fa-regular fa-user"></i></button>
        <button onclick="window.location = 'cart.php';" class="rightSideBtn cart"><i class="fa fa-shopping-cart"></i></button>
    </div>
    <div class="bottom">
        <ul>
            <li><a href="/categorie/alle-producten">Alle producten</a></li>
            <li><a href="/categorie/smartphones">Smartphones</a></li>
            <li><a href="/categorie/tablets">Tablets</a></li>
            <li><a href="/categorie/accessoires">Accessoires</a></li>
            <li><a href="/categorie/over-ons">Over ons</a></li>
        </ul>
    </div>
</nav>