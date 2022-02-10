<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();

if(isset($_POST['date_debut'], $_POST['date_fin'])){
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];


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


} 



 /* 
if(isset($_POST['boucherie'], $_POST['charcuterieTraiteur'], $_POST['cfa'], $_POST['greta'], 
$_POST['cuisineLycee'], $_POST['emballages'], $_POST['lyceePatisserie'], $_POST['sousTotalLycee'],
$_POST['cb'], $_POST['cheque'], $_POST['espece'], $_POST['nonRegle'], $_POST['destruction'], 
$_POST['transfertA'], $_POST['transfertS'], $_POST['totalVenteSemaineUn'], $_POST['totalVenteSemaineDeux'])){
    $boucherie = $_POST['boucherie'];
    $charcuterieTraiteur = $_POST['charcuterieTraiteur'];
    $CFA = $_POST['cfa'];
    $GRETA = $_POST['greta'];
    $cuisineLycee = $_POST['cuisineLycee'];
    $emballages = $_POST['emballages'];
    $lyceePatisserie = $_POST['lyceePatisserie'];
    $totalLycee = $_POST['sousTotalLycee'];

    $carteBleue = $_POST['cb'];
    $cheque = $_POST['cheque'];
    $liquide = $_POST['espece'];
    $nonPaye = $_POST['nonRegle'];

    $destruction = $_POST['destruction'];
    $atelier = $_POST['transfertA'];
    $self = $_POST['transfertS'];

    $totalUn = $_POST['totalVenteSemaineUn'];
    $totalDeux = $_POST['totalVenteSemaineDeux'];
}
*/



include "./vue/v_bilan_semaine_pdf.php";
?>
