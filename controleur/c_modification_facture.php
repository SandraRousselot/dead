<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();

if(isset($_POST['id_facture'])){
$lesResultatsFactures = AffichageFacture($_POST['id_facture']);

// si l'utilisateur a suprimée un elements on transmet l'id de la facture en GET 
} else if(isset($_GET['id_facture'])){
    $lesResultatsFactures = AffichageFacture($_GET['id_facture']);
}


if(isset($_POST['action'])){
    if ($_POST["action"] == "delete"){
        SupprimerElementFacture($_POST['id_facture'], $_POST['id_production']);
        header('Location: ./?action=modification_facture&id_facture='.$_POST['id_facture']);
    }
}

include "./vue/v_modification_facture.php";
