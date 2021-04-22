<?php

include 'essentials/header.php';
include 'essentials/menu.php';

// Récupération des données à afficher sur cette page :
$spend_users = get_the_short_list_users();
$recipe_category = get_the_recipe_category();
$recipe_users = get_the_short_list_users();
$user_id = $_GET["user_id"];
$transaction_id = $_GET["transaction_id"];
$transaction_type = $_GET["transaction_type"];
if ($transaction_type == "spend") {
    $spend = get_the_precise_spend($user_id, $transaction_id);
    if ($spend) {
        $the_amount = $spend[0][0];
        $the_reason = $spend[0][1];
        $the_user_id = $spend[0][2];
    }
} else if ($transaction_type == "recipe") {
    $recipe = get_the_precise_recipes($user_id, $transaction_id);
    if ($recipe) {
        $the_amount = $recipe[0][0];
        $the_category_id = $recipe[0][1];
        $the_user_id = $recipe[0][2];
    }
};
?>


<main id="flex-container">
    <?php if ($transaction_type == "spend" && $spend) { ?>
        <div id="edit_spend">
            <h1>Editer une dépense</h1>
            <form method="POST" class="the_form">
                <div class="input-container">
                    <label for="money_spend">Argent dépensé (en €)</label>
                    <input required type="number" name="spend_amount" id="money_spend" placeholder="50" step="10" min="0" value="<?= $the_amount ?>">
                    <label class="help error_help"><?= $spend_amountErr ?></label>
                </div>
                <div class="input-container">
                    <label for="motif">Motif de la dépense</label>
                    <input required type="text" name="spend_reason" id="motif" placeholder="..." value="<?= $the_reason ?>">
                    <label class="help error_help"><?= $spend_reasonErr ?></label>
                </div>
                <div class="input-container">
                    <label for="user_selector_spend">Utilisateur</label>
                    <select required name="spend_user" id="user_selector_spend">
                        <option value="<?= $the_user_id ?>">Ne pas changer l'utilisateur</option>
                        <?php
                        foreach ($spend_users as $the_user) {
                            $the_user_id = $the_user[0];
                            $the_user_name = $the_user[1];
                        ?>
                            <option <?php if ($the_user_id == $user_id) {
                                        echo "selected";
                                    } ?> value="<?= $the_user_id ?>"><?= $the_user_name ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <label class="help">Qui vient de dépenser ?</label>
                    <label class="help error_help"><?= $spend_userErr ?></label>
                </div>
                <input type="submit" class="submit_button">
                <?php if ($err === false) { ?>
                    <label class="help success_help">La dépense à été édité.</label>
                <?php } ?>
            </form>
        </div>
    <?php } else if ($transaction_type == "recipe" && $recipe) { ?>
        <div id="edit_recipe">
            <h1>Editer une recette</h1>
            <form method="POST" class="the_form">
                <div class="input-container">
                    <label for="money_receive">Argent reçu (en €)</label>
                    <input required type="number" name="receive_amount" id="money_receive" placeholder="50" step="10" min="0" value="<?= $the_amount ?>">
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
                            <option <?php if ($the_id == $the_category_id) {
                                        echo "selected";
                                    } ?> value="<?= $the_id ?>"><?= $the_category_name ?></option>
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
                            <option <?php if ($the_user_id == $user_id) {
                                        echo "selected";
                                    } ?> value="<?= $the_user_id ?>"><?= $the_user_name ?></option>
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
    <?php } else { ?>
        <div class="lds-dual-ring large-load"></div>
    <?php } ?>
    <footer>
        <p> CONTROL€ est une application Koffi Cup, fabriqué au sein de La Manu. Merci à Becris pour les icônes, stories pour les illustrations.</p>
    </footer>
</main>
<?php

include 'essentials/footer.php';


?>