<?php

//Fichier : liste.php
include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();

$lesResultatsCategories = RecuperationOccurences("categorie_client");


if(isset($_POST['nom'], $_POST['prenom'], $_POST['categorie'], $_POST['tel'], $_POST['mail'], 
$_POST['ville'])){
    
    AjoutClient($_POST['nom'], $_POST['prenom'], $_POST['ville'],
    $_POST['tel'], $_POST['mail'], $_POST['categorie']);

    header('Location: ./?action=clients');
}
include "./vue/v_ajout_client.php";

?>

    