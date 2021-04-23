<?php

include 'essentials/header.php';
include 'essentials/menu.php';
$total_spend = get_the_total_spend();
$total_recipe = get_the_total_recipe();
$all_recipes = get_all_the_recipes();
$all_spends = get_all_the_spends();

?>


<main id="flex-container">
    <div>
        <h1>Bienvenue Utilisateur.</h1>
        <div id="dashboard-flex">

            <div class="chart-container">
                <canvas data-spend="<?= $total_spend[0][0] ?>" data-recipe="<?= $total_recipe[0][0] ?>" id="myChart"></canvas>
            </div>
            <div>
                <h2>Dernières dépenses :</h2>
                <table class="tg dashboard-table">
                    <thead>
                        <tr>
                            <th class="tg-0lax">Nom
                            </th>
                            <th class="tg-0lax">Quantité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($all_spends as $spend) {
                            $the_user_firstname = $spend[0];
                            $the_amount = $spend[1];
                        ?>
                            <tr>
                                <th class="tg-0lax"> <?= $the_user_firstname ?></th>
                                <th class="tg-0lax">- <?= $the_amount ?>€</th>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <h2>Dernières recettes :</h2>
                <table class="tg dashboard-table">
                    <thead>
                        <tr>
                            <th class="tg-0lax">Nom
                            </th>
                            <th class="tg-0lax">Quantité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($all_recipes as $recipe) {
                            $the_user_firstname = $recipe[0];
                            $the_amount = $recipe[1];
                        ?>
                            <tr>
                                <th class="tg-0lax"> <?= $the_user_firstname ?></th>
                                <th class="tg-0lax">+ <?= $the_amount ?>€</th>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <footer>
        <p> CONTROL€ est une application Koffi Cup, fabriqué au sein de La Manu. Merci à Becris pour les icônes, stories pour les illustrations.</p>
    </footer>
</main>
<!-- Script qui ne sert qu'ici je le charge que dans cette page -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.0/chart.min.js" integrity="sha512-RGbSeD/jDcZBWNsI1VCvdjcDULuSfWTtIva2ek5FtteXeSjLfXac4kqkDRHVGf1TwsXCAqPTF7/EYITD0/CTqw==" crossorigin="anonymous"></script>
<script src="assets\js\camembert.js"></script>

<?php

include 'essentials/footer.php';


?>