<?php

include 'essentials/header.php';
include 'essentials/menu.php';


// Récupération des données à afficher sur cette page :
$list_users = get_the_full_list_users();

?>


<main id="flex-container">
    <div>
        <h1>Liste des Users</h1>
        <table class="tg">
            <thead>
                <tr>
                    <th class="tg-0lax">ID</th>
                    <th class="tg-0lax">Nom</th>
                    <th class="tg-0lax">Prénom</th>
                    <th class="tg-0lax">Détails</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($list_users as $the_user) {
                    $the_user_id = $the_user[0];
                    $the_user_firstname = $the_user[1];
                    $the_user_lastname = $the_user[2];
                ?>
                    <tr>
                        <th class="tg-0lax"> <?= $the_user_id ?></th>
                        <th class="tg-0lax"><?= $the_user_lastname ?></th>
                        <th class="tg-0lax"><?= $the_user_firstname ?></th>
                        <th class="tg-0lax"><a class="button" href="user_details.php?id=<?= $the_user_id ?>"> Afficher</a></th>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <footer>
        <p> CONTROL€ est une application Koffi Cup, fabriqué au sein de La Manu. Merci à Becris pour les icônes, stories pour les illustrations.</p>
    </footer>
</main>
<?php

include 'essentials/footer.php';


?>