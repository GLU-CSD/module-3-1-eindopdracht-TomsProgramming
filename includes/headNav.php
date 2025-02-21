<nav class="headNav" aria-label="Hoofdmenu">
    <div class="top">
        <button class="burger" aria-label="Toggle menu"><i class="fa fa-bars"></i></button>

        <a href="/" class="logo">
            <p><?php echo $name ?></p>
        </a>
        <form class="search" action="/zoeken" method="get">
            <input type="text" id="searchInput" name="q" placeholder="Waar ben je naar op zoek?">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
        <button onclick="window.location = '/account';" class="rightSideBtn user"><i
                class="fa-regular fa-user"></i></button>
        <button onclick="window.location = '/winkelwagen';" class="rightSideBtn cart"><i
                class="fa fa-shopping-cart"></i></button>
    </div>

    <div class="bottom">
        <ul>
            <li><a href="/producten">Alle producten</a></li>
            <li><a href="/smartphones">Smartphones</a></li>
            <li><a href="/tablets">Tablets</a></li>
            <!-- <li><a href="/accessoires">Accessoires</a></li>
            <li><a href="/over-ons">Over ons</a></li> -->
        </ul>
    </div>
</nav>