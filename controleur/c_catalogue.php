<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();

if(isset($_POST['filtre'])){
    $lesResultatsProductions = AffichageProductions($_POST['filtre']);
}else{
    $lesResultatsProductions = AffichageProductions();
}

if(isset($_POST['congelateur'])){

    MettreAuCongelateur($_POST['congelateur'], $_POST['date_fabrication']);
    
    header('Location: ./?action=catalogue');
}

if(isset($_POST['destruire'])){

    $destruire = $_POST['destruire'];
    $conditionnement = RecupConditionnement($destruire);
    DetruireUneProduction($_POST['destruire'], $_POST['id_produit'], $conditionnement->conditionnement);

    header('Location: ./?action=catalogue');
}

if(isset($_POST['transferer'])){
    //TransfererUneProduction($_POST['transfert'], $_POST['id_produit'], $_POST['transfert_ou'], $_POST['quantite']);
    
    header('Location: ./?action=confirmation_transfert');
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
     header('Location: ?action=catalogue');
   }

}
//  FIN
include "./vue/v_catalogue.php";
?>