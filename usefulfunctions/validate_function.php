<?php
// Définition des variables
$first_name = $last_name = $birthdate = $receive_amount = $receive_category = $receive_user = $spend_amount = $spend_reason = $spend_user = "";
$err = "";

$first_nameErr = $last_nameErr = $birthdateErr = $receive_amountErr = $receive_categoryErr = $receive_userErr = $spend_amountErr = $spend_reasonErr = $spend_userErr = "";



if ($_SERVER["REQUEST_METHOD"] == "POST" && basename($_SERVER['PHP_SELF']) == "add_user.php") {
    if (empty($_POST["add_firstname"])) {
        $first_nameErr = "Veuillez indiquer un prénom.";
        $err = true;
    } else {
        $first_name = test_input($_POST["add_firstname"]);
        $err = false;
        if (!preg_match("/^[A-Za-z]+$/", $first_name)) {
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
        if (!preg_match("/^[A-Za-z]+$/", $last_name)) {
            $last_nameErr = "Seules les lettres sont autorisées !";
            $err = true;
        }
    }
    if (empty($_POST["add_birthdate"])) {
        $birthdateErr = "Veuillez indiquer une date de naissance";
        $err = true;
    } else {
        $birthdate = test_input($_POST["add_birthdate"]);
        if (!preg_match("/^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/", $birthdate)) {
            $birthdateErr = "Seules les dates au format dd/mm/YYYY sont autorisés.";
            $err = true;
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && basename($_SERVER['PHP_SELF']) == "add_recipe.php") {
    if (empty($_POST["receive_amount"])) {
        $receive_amountErr = "Veuillez indiquer une quantité.";
        $err = true;
    } else {
        $receive_amount = test_input($_POST["receive_amount"]);
        $err = false;
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
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && basename($_SERVER['PHP_SELF']) == "add_spend.php") {
    if (empty($_POST["spend_amount"])) {
        $spend_amountErr = "Veuillez indiquer une quantité.";
        $err = true;
    } else {
        $spend_amount = test_input($_POST["spend_amount"]);
        $err = false;
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
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
