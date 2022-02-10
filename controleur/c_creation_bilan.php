<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();


if(isset($_POST['date_debut'], $_POST['date_fin'])){
    $date_debut = date("Y-m-d", strtotime($_POST['date_debut']));
    $date_fin = date("Y-m-d", strtotime($_POST['date_fin']));
} else {
    $date_debut = date("Y-m-d", strtotime("01/01/2020"));
    $date_fin = date("Y-m-d", strtotime("01/01/2030"));
}

$boucherie = PrixParAtelier(1, $date_debut, $date_fin);
$charcuterieTraiteur = PrixParAtelier(2, $date_debut, $date_fin);
$CFA = PrixParAtelier(3, $date_debut, $date_fin);
$GRETA = PrixParAtelier(4, $date_debut, $date_fin);
$cuisineLycee = PrixParAtelier(5, $date_debut, $date_fin);
$emballages = PrixParAtelier(6, $date_debut, $date_fin);
$lyceePatisserie = PrixParAtelier(7, $date_debut, $date_fin);
$sousTotalLycee = $lyceePatisserie + $charcuterieTraiteur + $boucherie + $cuisineLycee + $emballages;
$totalVenteSemaineUn = $sousTotalLycee + $GRETA + $CFA;

$carteBleue = PrixParModePaiement(1, $date_debut, $date_fin);
$cheque = PrixParModePaiement(2, $date_debut, $date_fin);
$liquide = PrixParModePaiement(3, $date_debut, $date_fin);
$nonPaye = PrixParModePaiement(0, $date_debut, $date_fin);

$destruction = CalculDestruction($date_debut, $date_fin);
$atelier = CalculTransferts(1, $date_debut, $date_fin);
$self = CalculTransferts(2, $date_debut, $date_fin);
$totalVenteSemaineDeux = $carteBleue->prix_total + $cheque->prix_total + $liquide->prix_total + $nonPaye->prix_total + $destruction->prix_destruction + $atelier->prix_par_type_transfert + $self->prix_par_type_transfert;


include "./vue/v_creation_bilan.php";
?>
