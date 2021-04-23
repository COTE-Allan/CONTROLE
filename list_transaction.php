<?php

include 'essentials/header.php';


// Récupération des données à afficher sur cette page :
$all_recipes = get_all_the_recipes_full();
$all_spends = get_all_the_spends_full();

include 'essentials/menu.php';

?>


<main id="flex-container">
    <h1>Registre des transactions</h1>
    <div>
        <h2>Dépenses :</h2>
        <?php if (!empty($all_spends)) { ?>
            <table class="tg dashboard-table">
                <thead>
                    <tr>
                        <th class="tg-0lax">
                            Nom
                        </th>
                        <th class="tg-0lax">
                            Quantité
                        </th>
                        <th class="tg-0lax">
                            Raison
                        </th>
                        <th class="tg-0lax">
                            Date
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($all_spends as $spend) {
                        $the_user_firstname = $spend[0];
                        $the_amount = $spend[1];
                        $the_reason = $spend[2];
                        $the_date = $spend[3];
                        $the_date = explode(' ', $the_date);
                        $the_date = $the_date[0];
                    ?>
                        <tr>
                            <th class="tg-0lax">
                                <?= $the_user_firstname ?>
                            </th>
                            <th class="tg-0lax">
                                - <?= $the_amount ?>€
                            </th>
                            <th class="tg-0lax">
                                <?= $the_reason ?>
                            </th>
                            <th class="tg-0lax">
                                <?= $the_date ?>
                            </th>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="detail_label">
                Aucune dépenses !
            </p>
        <?php } ?>
        <h2>Recettes :</h2>
        <?php if (!empty($all_recipes)) { ?>
            <table class="tg dashboard-table">
                <thead>
                    <tr>
                        <th class="tg-0lax">
                            Nom
                        </th>
                        <th class="tg-0lax">
                            Quantité
                        </th>
                        <th class="tg-0lax">
                            Raison
                        </th>
                        <th class="tg-0lax">
                            Date
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($all_recipes as $recipe) {
                        $the_user_firstname = $recipe[0];
                        $the_amount = $recipe[1];
                        $the_reason = $recipe[2];
                        $the_date = $recipe[3];
                        $the_date = explode(' ', $the_date);
                        $the_date = $the_date[0];
                    ?>
                        <tr>
                            <th class="tg-0lax">
                                <?= $the_user_firstname ?>
                            </th>
                            <th class="tg-0lax">
                                + <?= $the_amount ?>€
                            </th>
                            <th class="tg-0lax">
                                <?= $the_reason ?>
                            </th>
                            <th class="tg-0lax">
                                <?= $the_date ?>
                            </th>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="detail_label">
                Aucune dépenses !
            </p>
        <?php } ?>
    </div>
    <footer>
        <p> CONTROL€ est une application Koffi Cup, fabriqué au sein de La Manu. Merci à Becris pour les icônes, stories pour les illustrations.</p>
    </footer>
</main>
<?php

include 'essentials/footer.php';


?>