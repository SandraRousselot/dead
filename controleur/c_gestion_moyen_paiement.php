<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();

if(isset($_SESSION["user"])){    
    if($_SESSION["user"]->role>1){ 
        $lesResultatsMoyenPaiement = AfficherMoyenPaiement();
    }else{
        header('Location: ./?action=#');
    }
}

include "./vue/v_gestion_moyen_paiement.php";
?>
