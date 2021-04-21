<?php
// Définition des variables
$first_name = $last_name = $birthdate = $receive_amount = $receive_category = $receive_user = $spend_amount = $spend_reason = $spend_user = "";
$err = "";

$first_nameErr = $last_nameErr = $birthdateErr = $receive_amountErr = $receive_categoryErr = $receive_userErr = $spend_amountErr = $spend_reasonErr = $spend_userErr = "";

$the_date = date('Y-m-d') . ' 00:00:00';

if ($_SERVER["REQUEST_METHOD"] == "POST" && basename($_SERVER['PHP_SELF']) == "add_user.php") {
    if (empty($_POST["add_firstname"])) {
        $first_nameErr = "Veuillez indiquer un prénom.";
        $err = true;
    } else {
        $first_name = test_input($_POST["add_firstname"]);
        $err = false;
        if (check_if_name($first_name) == 1) {
            $first_nameErr = "Seules les lettres sont autorisées !";
            $err = true;
        }
    }
    if (empty($_POST["add_lastname"])) {
        $last_nameErr = "Veuillez indiquer un nom.";
        $err = true;
    } else {
        $last_name = test_input($_POST["add_lastname"]);
        $err = false;
        if (check_if_name($last_name) == 1) {
            $last_nameErr = "Seules les lettres sont autorisées !";
            $err = true;
        }
    }
    if (empty($_POST["add_birthdate"])) {
        $birthdateErr = "Veuillez indiquer une date de naissance";
        $err = true;
    } else {
        $birthdate = test_input($_POST["add_birthdate"]);
        if (check_if_date($birthdate) == 1) {
            $birthdateErr = "Seules les dates sont autorisés.";
            $err = true;
        }
        // echo $birthdate . ' 00:00:00';
    }
    if ($err === false) {
        add_user($birthdate . ' 00:00:00', $first_name, $last_name);
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && basename($_SERVER['PHP_SELF']) == "add_recipe.php") {
    if (empty($_POST["receive_amount"])) {
        $receive_amountErr = "Veuillez indiquer une quantité.";
        $err = true;
    } else {
        $receive_amount = test_input($_POST["receive_amount"]);
        $err = false;
        if (check_if_number($receive_amount) == 1) {
            $receive_amountErr = "Seules les nombres sont autorisés.";
            $err = true;
        }
    }
    if (empty($_POST["receive_category"])) {
        $receive_categoryErr = "Veuillez choisir une catégorie.";
        $err = true;
    } else {
        $receive_category = test_input($_POST["receive_category"]);
        $err = false;
    }
    if (empty($_POST["receive_user"])) {
        $receive_userErr = "Veuillez choisir un utilisateur.";
        $err = true;
    } else {
        $receive_user = test_input($_POST["receive_user"]);
        $err = false;
        if (check_if_number($receive_user) == 1) {
            $receive_userErr = "La valeur est incorrecte.";
            $err = true;
        }
    }
    if ($err === false) {
        add_recipe($the_date, $receive_amount, $receive_category, $receive_user);
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && basename($_SERVER['PHP_SELF']) == "add_spend.php") {
    if (empty($_POST["spend_amount"])) {
        $spend_amountErr = "Veuillez indiquer une quantité.";
        $err = true;
    } else {
        $spend_amount = test_input($_POST["spend_amount"]);
        $err = false;
        if (check_if_number($spend_amount) == 1) {
            $spend_amountErr = "Seules les nombres sont autorisés.";
            $err = true;
        }
    }
    if (empty($_POST["spend_reason"])) {
        $spend_reasonErr = "Veuillez indiquer une raison.";
        $err = true;
    } else {
        $spend_reason = test_input($_POST["spend_reason"]);
        $err = false;
    }
    if (empty($_POST["spend_user"])) {
        $spend_userErr = "Veuillez choisir un utilisateur.";
        $err = true;
    } else {
        $spend_user = test_input($_POST["spend_user"]);
        $err = false;
        if (check_if_number($spend_user) == 1) {
            $spend_userErr = "La valeur est incorrecte.";
            $err = true;
        }
    }

    if ($err === false) {
        add_expense($the_date, $spend_amount, $spend_reason, $spend_user);
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && basename($_SERVER['PHP_SELF']) == "edit_transaction.php") {
    if ($_GET["transaction_type"] == "spend") {
        if (empty($_POST["spend_amount"])) {
            $spend_amountErr = "Veuillez indiquer une quantité.";
            $err = true;
        } else {
            $spend_amount = test_input($_POST["spend_amount"]);
            $err = false;
            if (check_if_number($spend_amount) == 1) {
                $spend_amountErr = "Seules les nombres sont autorisés.";
                $err = true;
            }
        }
        if (empty($_POST["spend_reason"])) {
            $spend_reasonErr = "Veuillez indiquer une raison.";
            $err = true;
        } else {
            $spend_reason = test_input($_POST["spend_reason"]);
            $err = false;
        }
        if (empty($_POST["spend_user"])) {
            $spend_userErr = "Veuillez choisir un utilisateur.";
            $err = true;
        } else {
            $spend_user = test_input($_POST["spend_user"]);
            $err = false;
            if (check_if_number($spend_user) == 1) {
                $spend_userErr = "La valeur est incorrecte.";
                $err = true;
            }
        }
        if ($err === false) {
            edit_expense($spend_amount, $spend_reason, $spend_user, $_GET["transaction_id"]);
            $user_id = $_GET["user_id"];
            header("Refresh: 0; url=user_details.php?id=$user_id");
        }
    }
    if ($_GET["transaction_type"] == "recipe") {
        if (empty($_POST["receive_amount"])) {
            $receive_amountErr = "Veuillez indiquer une quantité.";
            $err = true;
        } else {
            $receive_amount = test_input($_POST["receive_amount"]);
            $err = false;
            if (check_if_number($receive_amount) == 1) {
                $receive_amountErr = "Seules les nombres sont autorisés.";
                $err = true;
            }
        }
        if (empty($_POST["receive_category"])) {
            $receive_categoryErr = "Veuillez choisir une catégorie.";
            $err = true;
        } else {
            $receive_category = test_input($_POST["receive_category"]);
            $err = false;
        }
        if (empty($_POST["receive_user"])) {
            $receive_userErr = "Veuillez choisir un utilisateur.";
            $err = true;
        } else {
            $receive_user = test_input($_POST["receive_user"]);
            $err = false;
            if (check_if_number($receive_user) == 1) {
                $receive_userErr = "La valeur est incorrecte.";
                $err = true;
            }
        }
        if ($err === false) {
            edit_recipe($receive_amount, $receive_category, $receive_user, $_GET["transaction_id"]);
            $user_id = $_GET["user_id"];
            header("Refresh: 0; url=user_details.php?id=$user_id");
        }
    }
}







function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function check_if_name($value)
{
    return !preg_match("/^[A-Za-z]+$/", $value);
}
function check_if_date($birthdate)
{
    return !preg_match("/^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/", $birthdate);
}
function check_if_number($value)
{
    return !preg_match("/^[0-9]*$/", $value);
}
