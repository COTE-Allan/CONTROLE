<?php
// Faut t'il supprimer ?
if (isset($_GET["transaction_id"]) && isset($_GET["transaction_type"]) && basename($_SERVER['PHP_SELF']) == "user_details.php") {
    if ($_GET["transaction_type"] == "spend") {
        echo $_GET["id"];
        echo $_GET["transaction_type"];
        remove_expense($_GET["id"], $_GET["transaction_id"]);
        header("Refresh: 0; url=user_details.php?id=$user_id");
    } else if ($_GET["transaction_type"] == "recipe") {
        remove_income($_GET["id"], $_GET["transaction_id"]);
        header("Refresh: 0; url=user_details.php?id=$user_id");
    }
};
