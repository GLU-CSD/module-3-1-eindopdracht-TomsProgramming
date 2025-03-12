<aside class="sidebar">
    <h2>Filter Producten</h2>
    <form action="/producten" method="GET">
        <div class="filterGroup">
            <?php
            if(isset($brands)){
                echo "<h3>Merk</h3>";
                foreach($brands as $brand){
                    echo "<label><input type='checkbox' name='brand[]' value='" . $brand['brand'] . "'> " . $brand['brand'] . "</label><br>";
                }
            }else{
                echo "<h3>Categorie</h3>";
                echo "<label><input type='checkbox' name='category[]' value='smartphones'> Smartphones</label><br>";
                echo "<label><input type='checkbox' name='category[]' value='tablets'> Tablets</label><br>";
            }
            ?>
        </div>

        <div class="filterGroup">
            <h3>Prijs</h3>
            <div class="range">
                <div class="rangeSlider">
                    <span class="rangeSelected"></span>
                </div>
                <div class="rangeInput">
                    <input type="range" class="min" min="0" max="<?php echo intval($highestPrice) ?>" value="0" step="1">
                    <input type="range" class="max" min="0" max="<?php echo intval($highestPrice) ?>" value="<?php echo intval($highestPrice) ?>" step="1">
                </div>
                <div class="rangePrice">
                    <label for="min">Min</label>
                    <input type="number" id="min" name="min" value="0">
                    <label for="max">Max</label>
                    <input type="number" id="max" name="max" value="<?php echo intval($highestPrice) ?>">
                </div>
            </div>
        </div>

        <!-- <div class="filterGroup">
            <h3>Kleur</h3>
            <label><input type="checkbox" name="kleur[]" value="rood"> Rood</label><br>
            <label><input type="checkbox" name="kleur[]" value="blauw"> Blauw</label><br>
            <label><input type="checkbox" name="kleur[]" value="zwart"> Zwart</label><br>
        </div> -->

        <button type="submit">Toon Producten</button>
    </form>
</aside>
<div class="sidebarOverlay"></div>