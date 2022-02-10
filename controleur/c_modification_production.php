<?php

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

$laProductionAModifier = AffichageProductionParId($_POST["id"]);

if(isset($_POST['id'], $_POST['nom'], $_POST['atelier'], $_POST['classe'], $_POST['prof'], $_POST['famille'], 
$_POST['temperature'], $_POST['date_fabric'], $_POST['date_peremption'], $_POST['quantite'], 
$_POST['stock'])){


$date_fabric_a = date_create($_POST['date_fabric']);
$date_fabric = date_format($date_fabric_a, 'd/m/Y');

$date_peremption_a = date_create($_POST['date_peremption']);
$date_peremption = date_format($date_peremption_a, 'd/m/Y');


// CALCUL DU NOUVEAU STOCK

$lesResultatsVentes = RecuperationVentesParIdProduction($_POST['id']);
foreach($lesResultatsVentes as $leResultatVente){ 
 
 $total_vente = $total_vente + $leResultatVente->quantite;
 } 


$stock = $_POST['stock'] + $total_vente;


    ModificationProduction($_POST['id'], $_POST['id_produit'], $_POST['nom'], $_POST['atelier'], $_POST['classe'], $_POST['prof'], 
    $_POST['famille'], $_POST['temperature'], $date_fabric, $date_peremption, $_POST['quantite'], 
    $stock);

    header('Location: ./?action=catalogue');
} 

include "./vue/v_modification_production.php";

?>
