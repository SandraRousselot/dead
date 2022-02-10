<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();

if(isset($_POST['cf-transfert'])){
    $transferer = $_POST['transferer'];
    
    $conditionnement = RecupConditionnement($transferer);
    TransfererUneProduction($transferer, $_POST['id_produit'],  $_POST['quantite'], $_POST['id_transfert'], $conditionnement->conditionnement);
    header('Location: ./?action=catalogue');
}


include "./vue/v_confirmation_transfert.php";

?>
