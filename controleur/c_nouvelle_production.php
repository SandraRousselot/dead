<?php

//Fichier : liste.php
include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();


$lesResultatsAteliers = RecuperationOccurences("atelier");
$lesResultatsFamillesProduits = RecuperationOccurences("famille_produit");
$lesResultatsTypesProduits = RecuperationOccurences("type_produit");
$lesResultatsDates = RecuperationOccurences("production");
$lesResultatsUnites = RecuperationOccurences("unite");
$lesResultatsClasses = RecuperationOccurences("classe");
$lesResultatsProfesseurs = RecuperationOccurences("professeur");

$stack = array();

foreach($lesResultatsTypesProduits as $leResultatTypeProduit){ 
array_push($stack, $leResultatTypeProduit->nom);
}

include "./vue/v_nouvelle_production.php";


?>

    