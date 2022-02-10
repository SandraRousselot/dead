<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();

if(isset($_SESSION["user"])){    
    if($_SESSION["user"]->role>1){ 
        $LesResultatsProfs = AfficherProfesseur();
        if (isset($_POST["action"])){
            if ($_POST["action"] == "deleteProf"){
                SupprimerProf($_POST["id"]);
        
                header('Location: ./?action=gestion_profs');
            }
        }
    }else{
        header('Location: ./?action=#');
    }
}

include "./vue/v_gestion_profs.php";
?>
