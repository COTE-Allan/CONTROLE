<?php
include 'config.php';
// Appel de la DB CONTROLE
function call_to_db()
{
    try {
        $options = [
            // Permet à PDO de lever des exceptions en cas d'erreur SQL
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];
        // data source name
        $dsn = "mysql:host=" . HOST . ";dbname=" . DB_NAME . ";charset=utf8";
        // instance de la base de données (pdo)
        $dbh = new PDO($dsn, USER, PWD, $options);
        // echo 'connecté !';
        return $dbh;
    } catch (PDOException $ex) {
        // message d'erreur
        printf("La connexion à la base de donnée à échouer avec le code %s", $ex->getCode());
        // arrêter l'exécution du script
        die();
    }
}


// LES REQUETES 

// ========
// LECTURE
// ========
// Obtenir la liste des motifs de recettes.
function get_the_recipe_category()
{
    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        SELECT * FROM incomes_categories LIMIT 9;
EOD;
    // Exécuter la requête
    $categoryStmt = $the_db->query($sql);
    // Récuperer les données :
    $category = $categoryStmt->fetchAll();
    return $category;
}
// Obtenir les users avec Prénom et ID.
function get_the_short_list_users()
{
    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        SELECT user_id, first_name FROM users;
EOD;
    // Exécuter la requête
    $usersStmt = $the_db->query($sql);
    // Récuperer les données :
    $users = $usersStmt->fetchAll();
    return $users;
}
// Obtenir les users avec tout les détails.
function get_the_full_list_users()
{
    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        SELECT * FROM users;
EOD;
    // Exécuter la requête
    $usersStmt = $the_db->query($sql);
    // Récuperer les données :
    $users = $usersStmt->fetchAll();
    return $users;
}
// Obtenir les users avec tout les détails.
function get_precise_user($id)
{
    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        SELECT first_name, last_name, birth_date FROM users WHERE user_id = :id;
EOD;
    // Exécuter la requête
    $userStmt = $the_db->prepare($sql);
    $userStmt->bindValue(':id', $id);
    $userStmt->execute();
    // Récuperer les données :
    $user = $userStmt->fetchAll();
    return $user;
}
// Obtenir tout les recettes du user
function get_the_recipes($id)
{

    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        SELECT inc_amount, inc_cat_name, inc_receipt_date, inc_id FROM incomes NATURAL JOIN incomes_categories WHERE user_id = :id;
EOD;
    // Exécuter la requête
    $user_recipeStmt = $the_db->prepare($sql);
    $user_recipeStmt->bindValue(':id', $id);
    $user_recipeStmt->execute();
    // Récuperer les données :
    $user_recipe = $user_recipeStmt->fetchAll();
    return $user_recipe;
}
// Obtenir tout les dépenses du user
function get_the_spend($id)
{

    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        SELECT exp_date, exp_amount, exp_label, exp_id FROM expenses WHERE user_id = :id;
EOD;
    // Exécuter la requête
    $user_recipeStmt = $the_db->prepare($sql);
    $user_recipeStmt->bindValue(':id', $id);
    $user_recipeStmt->execute();
    // Récuperer les données :
    $user_recipe = $user_recipeStmt->fetchAll();
    return $user_recipe;
}
// Obtenir une dépense précise
function get_the_precise_spend($user_id, $exp_id)
{
    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        SELECT exp_amount, exp_label, user_id FROM expenses WHERE user_id = :user_id AND exp_id = :exp_id;
EOD;
    // Exécuter la requête
    $userStmt = $the_db->prepare($sql);
    $userStmt->bindValue(':user_id', $user_id);
    $userStmt->bindValue(':exp_id', $exp_id);
    $userStmt->execute();
    // Récuperer les données :
    $user = $userStmt->fetchAll();
    return $user;
}
// Obtenir une recette précise
function get_the_precise_recipes($user_id, $inc_id)
{
    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        SELECT inc_amount, inc_cat_id, user_id FROM incomes NATURAL JOIN incomes_categories WHERE user_id = :user_id AND inc_id = :inc_id;
EOD;
    // Exécuter la requête
    $userStmt = $the_db->prepare($sql);
    $userStmt->bindValue(':user_id', $user_id);
    $userStmt->bindValue(':inc_id', $inc_id);
    $userStmt->execute();
    // Récuperer les données :
    $user = $userStmt->fetchAll();
    return $user;
}
// Dépenses total de tout les users
function get_the_total_spend()
{

    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        SELECT SUM(exp_amount) AS total_expenses FROM expenses;
EOD;
    // Exécuter la requête
    $total_expenses_Stmt = $the_db->query($sql);
    // Récuperer les données :
    $total = $total_expenses_Stmt->fetchAll();
    return $total;
}
// Recette total de tout les users
function get_the_total_recipe()
{

    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        SELECT SUM(inc_amount) AS total_recipe FROM incomes;
EOD;
    // Exécuter la requête
    $total_expenses_Stmt = $the_db->query($sql);
    // Récuperer les données :
    $total = $total_expenses_Stmt->fetchAll();
    return $total;
}
// Obtenir toutes les dépenses DASHBOARD
function get_all_the_recipes()
{

    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        SELECT first_name, inc_amount, inc_cat_name, inc_receipt_date FROM incomes NATURAL JOIN users NATURAL JOIN incomes_categories WHERE user_id = user_id AND inc_id = inc_id  ORDER BY inc_receipt_date DESC LIMIT 4;
EOD;
    // Exécuter la requête
    $total_recipes_Stmt = $the_db->query($sql);
    // Récuperer les données :
    $total = $total_recipes_Stmt->fetchAll();
    return $total;
}
// Obtenir toutes les dépenses DASHBOARD
function get_all_the_spends()
{

    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        SELECT first_name, exp_amount, exp_label, exp_date FROM expenses NATURAL JOIN users WHERE user_id = user_id ORDER BY exp_date DESC LIMIT 4;
EOD;
    // Exécuter la requête
    $total_recipes_Stmt = $the_db->query($sql);
    // Récuperer les données :
    $total = $total_recipes_Stmt->fetchAll();
    return $total;
}
// Obtenir toutes les dépenses DASHBOARD
function get_all_the_recipes_full()
{

    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        SELECT first_name, inc_amount, inc_cat_name, inc_receipt_date FROM incomes NATURAL JOIN users NATURAL JOIN incomes_categories WHERE user_id = user_id AND inc_id = inc_id  ORDER BY inc_receipt_date DESC LIMIT 15;
EOD;
    // Exécuter la requête
    $total_recipes_Stmt = $the_db->query($sql);
    // Récuperer les données :
    $total = $total_recipes_Stmt->fetchAll();
    return $total;
}
// Obtenir toutes les dépenses DASHBOARD
function get_all_the_spends_full()
{

    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        SELECT first_name, exp_amount, exp_label, exp_date FROM expenses NATURAL JOIN users WHERE user_id = user_id ORDER BY exp_date DESC LIMIT 15;
EOD;
    // Exécuter la requête
    $total_recipes_Stmt = $the_db->query($sql);
    // Récuperer les données :
    $total = $total_recipes_Stmt->fetchAll();
    return $total;
}
// ========
// ECRITURE
// ========
// Ajouter une dépense
function add_expense($date, $amount, $reason, $user)
{
    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        INSERT INTO expenses (exp_date, exp_amount, exp_label, user_id) VALUES (:date, :amount, :reason, :user);
EOD;
    // Exécuter la requête
    $expenseStmt = $the_db->prepare($sql);
    $expenseStmt->bindValue(':date', $date);
    $expenseStmt->bindValue(':amount', $amount);
    $expenseStmt->bindValue(':reason', $reason);
    $expenseStmt->bindValue(':user', $user);
    $expenseStmt->execute();
}
// Ajouter une recette
function add_recipe($date, $amount, $category, $user)
{
    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        INSERT INTO incomes (inc_amount, inc_receipt_date, inc_cat_id, user_id) VALUES (:amount, :date, :category, :user);
EOD;
    // Exécuter la requête
    $recipeStmt = $the_db->prepare($sql);
    $recipeStmt->bindValue(':date', $date);
    $recipeStmt->bindValue(':amount', $amount);
    $recipeStmt->bindValue(':category', $category);
    $recipeStmt->bindValue(':user', $user);
    $recipeStmt->execute();
}

// Ajouter un user
function add_user($date, $first_name, $last_name)
{
    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        INSERT INTO users (first_name, last_name, birth_date) VALUES (:first_name, :last_name, :date);
EOD;
    // Exécuter la requête
    $recipeStmt = $the_db->prepare($sql);
    $recipeStmt->bindValue(':date', $date);
    $recipeStmt->bindValue(':first_name', $first_name);
    $recipeStmt->bindValue(':last_name', $last_name);
    $recipeStmt->execute();
}

// ============
// DESTRUCTION
// ============
// Détruire l'income cible
function remove_income($user_id, $inc_id)
{
    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        DELETE FROM incomes WHERE inc_id = :inc_id AND user_id = :user_id;
EOD;
    // Exécuter la requête
    $incomeStmt = $the_db->prepare($sql);
    $incomeStmt->bindValue(':user_id', $user_id);
    $incomeStmt->bindValue(':inc_id', $inc_id);
    $incomeStmt->execute();
}
// Détruire l'expense cible
function remove_expense($user_id, $exp_id)
{
    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        DELETE FROM expenses WHERE exp_id = :exp_id AND user_id = :user_id;
EOD;
    // Exécuter la requête
    $incomeStmt = $the_db->prepare($sql);
    $incomeStmt->bindValue(':user_id', $user_id);
    $incomeStmt->bindValue(':exp_id', $exp_id);
    $incomeStmt->execute();
}


// =======
// EDITION
// =======
// Détruire l'expense cible
function edit_expense($amount, $reason, $user_id, $exp_id)
{
    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        UPDATE expenses SET exp_amount = :amount, exp_label = :reason, user_id = :user_id WHERE exp_id = :exp_id;
EOD;
    // Exécuter la requête
    $incomeStmt = $the_db->prepare($sql);
    $incomeStmt->bindValue(':reason', $reason);
    $incomeStmt->bindValue(':amount', $amount);
    $incomeStmt->bindValue(':user_id', $user_id);
    $incomeStmt->bindValue(':exp_id', $exp_id);
    $incomeStmt->execute();
}
// Editer la recette
function edit_recipe($amount, $category, $user_id, $inc_id)
{
    $the_db = call_to_db();
    // Requête SQL
    $sql =
        <<<'EOD'
        UPDATE incomes SET inc_amount = :amount, inc_cat_id = :category, user_id = :user_id WHERE inc_id = :inc_id;
EOD;
    // Exécuter la requête
    $Stmt = $the_db->prepare($sql);
    $Stmt->bindValue(':category', $category);
    $Stmt->bindValue(':amount', $amount);
    $Stmt->bindValue(':user_id', $user_id);
    $Stmt->bindValue(':inc_id', $inc_id);
    $Stmt->execute();
}
