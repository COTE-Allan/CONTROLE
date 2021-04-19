<?php

include 'essentials/header.php';
include 'essentials/menu.php';

// Récupération des données à afficher sur cette page :
$user_id = $_GET['id'];
$the_user = get_precise_user($user_id);
$recipes = get_the_recipes($user_id);
$spends = get_the_spend($user_id);
$the_user_firstname = $the_user[0][0];
$the_user_lastname = $the_user[0][1];
$the_user_birthday = $the_user[0][2];
$the_user_birthday = explode(' ', $the_user_birthday);
$the_user_birthday = $the_user_birthday[0];
?>


<main id="flex-container">
    <div>
        <h1>Détails sur <?= $the_user_firstname ?></h1>
        <div>

            <p id="detail_label">
                <?= $the_user_firstname . ' ' . $the_user_lastname . ', né le ' . $the_user_birthday . '.' ?>
            </p>
            <h2>Dernières dépenses</h2>
            <table class="tg">
                <thead>
                    <tr>
                        <th class="tg-0lax">Date</th>
                        <th class="tg-0lax">Quantité</th>
                        <th class="tg-0lax">Raison</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($spends as $the_spend) {
                        $the_date = $the_spend[0];
                        $the_amount = $the_spend[1];
                        $the_reason = $the_spend[2];
                        $the_date = explode(' ', $the_date);
                        $the_date = $the_date[0];
                    ?>
                        <tr>
                            <th class="tg-0lax"> <?= $the_date ?></th>
                            <th class="tg-0lax"><?= $the_amount ?>€</th>
                            <th class="tg-0lax"><?= $the_reason ?></th>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <h2>Dernières recettes</h2>
            <table class="tg">
                <thead>
                    <tr>
                        <th class="tg-0lax">Date</th>
                        <th class="tg-0lax">Quantité</th>
                        <th class="tg-0lax">Raison</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($recipes as $the_recipe) {
                        $the_date = $the_recipe[2];
                        $the_amount = $the_recipe[0];
                        $the_reason = $the_recipe[1];
                        $the_date = explode(' ', $the_date);
                        $the_date = $the_date[0];
                    ?>
                        <tr>
                            <th class="tg-0lax"> <?= $the_date ?></th>
                            <th class="tg-0lax"><?= $the_amount ?>€</th>
                            <th class="tg-0lax"><?= $the_reason ?></th>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <footer>
        <p> CONTROL€ est une application Koffi Cup, fabriqué au sein de La Manu. Merci à Becris pour les icônes, stories pour les illustrations.</p>
    </footer>
</main>
<?php

include 'essentials/footer.php';


?>