<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();

if(isset($_SESSION["user"])){    
    if($_SESSION["user"]->role>1){ 
        if (isset($_POST["action"])){
            if ($_POST["action"] == "deleteClients"){
                header('Location: ./?action=suppression_clients');
            }
            if ($_POST["action"] == "profs"){
                header('Location: ./?action=gestion_profs');
            }
            if ($_POST["action"] == "classes"){
                header('Location: ./?action=gestion_classes');
            }
        }
    }else{
        header('Location: ./?action=#');
    }
}

include "./vue/v_gestion_globale.php";
?>
