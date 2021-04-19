<?php

include 'essentials/header.php';
include 'essentials/menu.php';


// Récupération des données à afficher sur cette page :
$recipe_category = get_the_recipe_category();
$recipe_users = get_the_short_list_users();
?>


<main id="flex-container">
    <div>
        <h1>Ajouter une recette</h1>
        <form method="POST" class="the_form">
            <div class="input-container">
                <label for="money_receive">Argent reçu (en €)</label>
                <input required type="number" name="receive_amount" id="money_receive" placeholder="50" step="10" min="0">
                <label class="help error_help"><?= $receive_amountErr ?></label>
            </div>
            <div class="input-container">
                <label for="recipe_category">Catégorie</label>
                <select required name="receive_category" id="recipe_category">
                    <?php
                    foreach ($recipe_category as $the_category) {
                        $the_id = $the_category[0];
                        $the_category_name = $the_category[1];
                    ?>
                        <option value="<?= $the_id ?>"><?= $the_category_name ?></option>
                    <?php
                    }
                    ?>
                </select>
                <label class="help">D'ou provient l'argent reçu ?</label>
                <label class="help error_help"><?= $receive_categoryErr ?></label>
            </div>
            <div class="input-container">
                <label for="user_selector_recipe">Utilisateur</label>
                <select required name="receive_user" id="user_selector_recipe">
                    <?php
                    foreach ($recipe_users as $the_user) {
                        $the_user_id = $the_user[0];
                        $the_user_name = $the_user[1];
                    ?>
                        <option value="<?= $the_user_id ?>"><?= $the_user_name ?></option>
                    <?php
                    }
                    ?>
                </select>
                <label class="help">Qui vient de recevoir l'argent ?</label>
                <label class="help error_help"><?= $receive_userErr ?></label>
            </div>
            <input type="submit" class="submit_button">
            <?php if ($err === false) { ?>
                <label class="help success_help">La recette à été ajouté.</label>
            <?php } ?>


        </form>
    </div>
    <footer>
        <p> CONTROL€ est une application Koffi Cup, fabriqué au sein de La Manu. Merci à Becris pour les icônes, stories pour les illustrations.</p>
    </footer>
</main>
<?php

include 'essentials/footer.php';


?>