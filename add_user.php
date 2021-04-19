<?php

include 'essentials/header.php';
include 'essentials/menu.php';

?>


<main id="flex-container">
    <div>
        <h1>Ajouter un User</h1>
        <form method="POST" class="the_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="input-container">
                <label for="user_firstname">Prénom</label>
                <input required type="text" name="add_firstname" id="user_firstname" placeholder="John">
                <label class="help error_help"><?= $first_nameErr ?></label>
            </div>
            <div class="input-container">
                <label for="user_lastname">Nom</label>
                <input required type="text" name="add_lastname" id="user_lastname" placeholder="Doe">
                <label class="help error_help"><?= $last_nameErr ?></label>
            </div>
            <div class="input-container">
                <label for="user_birthdate">Date d'anniversaire</label>
                <input required type="date" name="add_birthdate" id="user_birthdate">
                <label class="help error_help"><?= $birthdateErr ?></label>
            </div>
            <input type="submit" class="submit_button">
            <?php if ($err === false) { ?>
                <label class="help success_help">L'utilisateur à été ajouté.</label>
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