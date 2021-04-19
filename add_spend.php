<?php

include 'essentials/header.php';
include 'essentials/menu.php';

// Récupération des données à afficher sur cette page :
$spend_users = get_the_short_list_users();
?>


<main id="flex-container">
    <div>
        <h1>Ajouter une dépense</h1>
        <form method="POST" class="the_form">
            <div class="input-container">
                <label for="money_spend">Argent dépensé (en €)</label>
                <input required type="number" name="spend_amount" id="money_spend" placeholder="50" step="10" min="0">
                <label class="help error_help"><?= $spend_amountErr ?></label>
            </div>
            <div class="input-container">
                <label for="motif">Motif de la dépense</label>
                <input required type="text" name="spend_reason" id="motif" placeholder="Tacos 3 viandes">
                <label class="help error_help"><?= $spend_reasonErr ?></label>
            </div>
            <div class="input-container">
                <label for="user_selector_spend">Utilisateur</label>
                <select required name="spend_user" id="user_selector_spend">
                    <?php
                    foreach ($spend_users as $the_user) {
                        $the_user_id = $the_user[0];
                        $the_user_name = $the_user[1];
                    ?>
                        <option value="<?= $the_user_id ?>"><?= $the_user_name ?></option>
                    <?php
                    }
                    ?>
                </select>
                <label class="help">Qui vient de dépenser ?</label>
                <label class="help error_help"><?= $spend_userErr ?></label>
            </div>
            <input type="submit" class="submit_button">
            <?php if ($err === false) { ?>
                <label class="help success_help">La dépense à été ajouté.</label>
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