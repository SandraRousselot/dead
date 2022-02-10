<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();

if(isset($_POST['quantite_produit'][0])){
$resultat_id_facture = NouvelleVente($_POST['nomprenom'], $_POST['quantite_produit'], $_POST['produits'], 
$_POST['prix_produit_de_base'], $_POST['prix_produit'], $_POST['prixtotal'], $_POST['reservation']);

$lesResultatsFactures = AffichageFacture($resultat_id_facture);

} else {
$lesResultatsFactures = AffichageFacture($_POST['id_facture']);

}

if(isset($_POST['moyen_paiement'])){
    ModificationModeReglement($_POST['moyen_paiement'], $_POST['id_facture']);
    header('Location: ./?action=facturation');
}

if(isset($_POST['annuler'])){
    AnnulerUneFacture($_POST['annuler']);
    header('Location: ./?action=facturation');
}

/* if(isset($_POST['modifier'])){
    header('Location: ./?action=modification_facture');
} */



include "./vue/v_creation_facture.php";
?>
