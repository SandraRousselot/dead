<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();

if(isset($_POST['nom'], $_POST['atelier'], $_POST['famille'], $_POST['tags'], $_POST['date_fabric'], 
$_POST['temperature'], $_POST['conserv'], $_POST['quantite'], $_POST['stock'], $_POST['classe'], $_POST['prof'], $_POST['unite'])){

$produits = json_decode($_POST['tags']);

//on calcule la date de fin
$dateFin = date('Y-m-d', strtotime('+'.$_POST['conserv'].' days', strtotime($_POST['date_fabric'])));

} 

if(isset($_POST['prix_produit'])){
    $prix_total = 0;
    foreach($_POST['prix_produit'] as $leproduit => $valeur){
        $prix_total+=$valeur;
    }


$nom = DetectionDoublonNomProduit($_POST['nom'], RecuperationNomClassParId($_POST['classe'])->nom);


AjoutProduit($_POST['famille'], $_POST['unite'], $nom, $prix_total);
$id_produit = RecuperationProduit($nom)->id_produit;

$date = date_create($_POST['date_fabric']);

$date_fabric = date_format($date, 'd/m/Y');

$date2 = date_create($_POST['dateFin']);
$date_peremption = date_format($date2, 'd/m/Y');

AjoutProduction($_POST['classe'], $id_produit, $_POST['atelier'], $_POST['prof'], $_POST['temperature'], 
$date_fabric, $date_peremption, $_POST['quantite'], $_POST['stock']);

   header('Location: ./?action=catalogue');
}

include "./vue/v_confirmation_nouvelle_production.php";

?>
