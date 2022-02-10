<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();

if(isset($_SESSION["user"])){    
    if($_SESSION["user"]->role==3){ 
        if (isset($_POST["action"])){
            if ($_POST["action"] == "deleteBD"){
                MiseAJourBaseDonnees();
                header('Location: ./?action=suppression_base_donnees');
            }
        }
    }else{
        header('Location: ./?action=#');
    }
}


include "./vue/v_confirmation_suppression_base_donnees.php";
?>

