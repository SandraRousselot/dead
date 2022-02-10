<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();

if(isset($_SESSION["user"])){    
    if($_SESSION["user"]->role==3){ 

        if(isset($_POST['date_debut'], $_POST['date_fin'])){
            $date_debut = date("Y-m-d", strtotime($_POST['date_debut']));
            $date_fin = date("Y-m-d", strtotime($_POST['date_fin']));
        } else {
            $date_debut = date("Y-m-d", strtotime("01/01/2020"));
            $date_fin = date("Y-m-d", strtotime("01/01/2030"));
        }

        $resultat = ChiffreAffaireParAtelier($date_debut, $date_fin);
        $resultatNonPaye = ChiffreAffaireParAtelierNonRegle($date_debut, $date_fin);
        $resultatTypeReglement = ChiffreAffaireParTypeReglement($date_debut, $date_fin);
        $resultatClasse = ChiffreAffaireParClasse($date_debut, $date_fin);
        $leResultatDestruction = CalculDestruction($date_debut, $date_fin);
        $leResultatTransfertAtelier = CalculTransferts(1, $date_debut, $date_fin);
        $leResultatTransfertSelf = CalculTransferts(2, $date_debut, $date_fin);

    }else{
        header('Location: ./?action=#');
    }
}
 


include "./vue/v_statistiques_alternative.php";
?>
