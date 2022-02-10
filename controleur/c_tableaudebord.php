<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();

// Affichage des factures non réglées
if(isset($_POST['filtre'])){
  $lesResultatsFacturations = AffichageFacturationsNonReglees($filtre);
  $lesResultatsFacturationsEnReservation = AffichageFacturationsNonRegleesEnReservation($filtre);

}else{
  $lesResultatsFacturations = AffichageFacturationsNonReglees();
  $lesResultatsFacturationsEnReservation = AffichageFacturationsNonRegleesEnReservation();
}

$LesResultatsClientsFideles = ClientsLesPlusFideles();

// Affichage des produits en DLC et des produits périmés
$lesResultatsProductions = AffichageProductionsTableauDeBord();

if(isset($_POST['congelateur'])){

    MettreAuCongelateur($_POST['congelateur'], $_POST['date_fabrication']);
    
    header('Location: ./?action=tableaudebord');
}

if(isset($_POST['destruire'])){

    DetruireUneProduction($_POST['destruire'], $_POST['id_produit']);

    header('Location: ./?action=tableaudebord');
}


// PARCOURS DES VENTES
foreach($lesResultatsProductions as $leResultatProduction){

$lesResultatsVentes = RecuperationVentesParIdProduction($leResultatProduction->id_production);
$conditionnement = $leResultatProduction->conditionnement;
foreach($lesResultatsVentes as $leResultatVente){ 
 
 $conditionnement = $conditionnement - $leResultatVente->quantite;
 } 

// controle du stock 
   if($conditionnement <= 0){
     ProduitAZeroStock($leResultatProduction->id_production, $leResultatProduction->id_produit);
     header('Location: ?action=tableaudebord');
   }

}


include "./vue/v_tableaudebord.php";
?>