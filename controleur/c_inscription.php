<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

unlogged_only();
if(isset($_POST['nom'], $_POST['mot_de_passe'])){
    $inscription = InscriptionUtilisateur($_POST['nom'], $_POST['mot_de_passe']);
    if($inscription){
        header('Location: ./?action=connection');
    }
    
}



include_once "./vue/v_inscription.php";

?>