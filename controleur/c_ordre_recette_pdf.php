<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();


if(isset($_POST['date_debut'], $_POST['date_fin'])){
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
} else {
    $date_debut = date("Y-m-d", strtotime("01/01/2020"));
    $date_fin = date("Y-m-d", strtotime("01/01/2030"));


}

$LesResultatsOrdreRecette = OrdreRecette($date_debut, $date_fin);
$LesResultatsOrdreRecetteDestruction = OrdreRecetteDestruction($date_debut, $date_fin);
$LesResultatsOrdreRecetteTransfert = OrdreRecetteTransfert($date_debut, $date_fin);


include "./vue/v_ordre_recette_pdf.php";
?>