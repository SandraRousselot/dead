<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();

$lesResultatsFactures = AffichageFacture($_GET['id_facture']);

include "./vue/v_facture_pdf.php";
?>
