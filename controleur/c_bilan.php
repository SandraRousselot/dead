<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();

if (isset($_POST["action"])){
    if ($_POST["action"] == "bilanSemaine"){
        header('Location: ./?action=creation_bilan');
    }
    if ($_POST["action"] == "journalVente"){
        header('Location: ./?action=creation_journal_vente');
    }
    if ($_POST["action"] == "ordreRecette"){
        header('Location: ./?action=creation_ordre_recette');
    }
}

include "./vue/v_bilan.php";
?>
