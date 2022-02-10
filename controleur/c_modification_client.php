<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();


$lesResultatsCategories = RecuperationOccurences("categorie_client");

$leClientAModifier = AffichageClientsParId($_POST["id"]);

if(isset($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['categorie'], 
$_POST['ville'])){
    
    ModificationClient($_POST['id'], $_POST['nom'], $_POST['prenom'], $_POST['categorie'],
    $_POST['tel'], $_POST['mail'], $_POST['ville']);

    header('Location: ./?action=clients');
}

include "./vue/v_modification_client.php";

?>
