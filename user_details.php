<?php

include 'essentials/header.php';

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

include 'usefulfunctions/delete_transaction.php';
include 'essentials/menu.php';

?>


<main id="flex-container">
    <div class="modale_confirmation" style="display: none">
        <h2>Êtes-vous sur de vouloir supprimer cette ligne ?</h2>
        <div>
            <a id="confirm_delete_accept" href="?id=<?= $user_id ?>?remove=1"><button class="button">OUI</button></a>
            <button class="button" id="confirm_delete_refuse">NON</button>
        </div>
    </div>
    <div id="shield" style="display: none"></div>
    <div>
        <h1>Détails sur <?= $the_user_firstname ?></h1>
        <div>

            <p class="detail_label">
                <?= $the_user_firstname . ' ' . $the_user_lastname . ', né le ' . $the_user_birthday . '.' ?>
            </p>
            <h2>Dernières dépenses</h2>
            <?php if (!empty($spends)) { ?>
                <table class="tg">
                    <thead>
                        <tr>
                            <th class="tg-0lax">Date</th>
                            <th class="tg-0lax">Quantité</th>
                            <th class="tg-0lax">Raison</th>
                            <th class="tg-0lax">Edition</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($spends as $the_spend) {
                            $the_date = $the_spend[0];
                            $the_amount = $the_spend[1];
                            $the_reason = $the_spend[2];
                            $the_id = $the_spend[3];
                            $the_date = explode(' ', $the_date);
                            $the_date = $the_date[0];
                        ?>
                            <tr data-transaction_id=<?= $the_id ?> data-user_id="<?= $user_id ?>" data-transaction_type="spend">
                                <th class="tg-0lax"> <?= $the_date ?></th>
                                <th class="tg-0lax">- <?= $the_amount ?>€</th>
                                <th class="tg-0lax"><?= $the_reason ?></th>
                                <th class="tg-0lax">
                                    <a href=<?= "edit_transaction.php?user_id=" . $user_id . "&transaction_type=spend&transaction_id=" . $the_id ?>><i class=" las la-pen edit"></i></a>
                                    <i class="las la-trash remove"></i>
                                </th>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p class="detail_label">
                    Aucune dépense ici !
                </p>
            <?php } ?>
            <h2>Dernières recettes</h2>
            <?php if (!empty($recipes)) { ?>
                <table class="tg">
                    <thead>
                        <tr>
                            <th class="tg-0lax">Date</th>
                            <th class="tg-0lax">Quantité</th>
                            <th class="tg-0lax">Raison</th>
                            <th class="tg-0lax">Edition</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($recipes as $the_recipe) {
                            $the_date = $the_recipe[2];
                            $the_amount = $the_recipe[0];
                            $the_reason = $the_recipe[1];
                            $the_id = $the_recipe[3];
                            $the_date = explode(' ', $the_date);
                            $the_date = $the_date[0];
                        ?>
                            <tr data-transaction_id=<?= $the_id ?> data-user_id="<?= $user_id ?>" data-transaction_type="recipe">
                                <th class="tg-0lax"> <?= $the_date ?></th>
                                <th class="tg-0lax">+ <?= $the_amount ?>€</th>
                                <th class="tg-0lax"><?= $the_reason ?></th>
                                <th class="tg-0lax">
                                    <a href=<?= "edit_transaction.php?user_id=" . $user_id . "&transaction_type=recipe&transaction_id=" . $the_id ?>><i class=" las la-pen edit"></i></a>
                                    <i class="las la-trash remove"></i>
                                </th>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p class="detail_label">
                    Aucune recette ici !
                </p>
            <?php } ?>

        </div>
    </div>
    <footer>
        <p> CONTROL€ est une application Koffi Cup, fabriqué au sein de La Manu. Merci à Becris pour les icônes, stories pour les illustrations.</p>
    </footer>
</main>
<?php

include 'essentials/footer.php';


?>