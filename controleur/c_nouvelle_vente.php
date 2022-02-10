<?php

//Fichier : liste.php
include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();


$lesResultatsProduits = AffichageProduits();
$lesResultatsClients = AffichageClients();

$stack = array();

$clients = array();

foreach($lesResultatsProduits as $leResultatProduit){ 
array_push($stack, $leResultatProduit->denomination);
}

foreach($lesResultatsClients as $leResultatClient){ 
array_push($clients, $leResultatClient->nom . " " . $leResultatClient->prenom);
}
include "./vue/v_nouvelle_vente.php";

?>

    