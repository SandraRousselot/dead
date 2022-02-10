<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();



if(isset($_POST['id_facture'], $_POST['id_production'], $_POST['quantite'], $_POST['prix_unitaire'])){
    
    ModifierElementFacture($_POST['id_facture'], $_POST['id_production'], $_POST['quantite'], 
    $_POST['prix_unitaire']);

    header('Location: ./?action=clients');
}

include "./vue/v_modification_element_facture.php";

?>
