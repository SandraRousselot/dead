<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();
if(isset($_SESSION["user"])){    
    if($_SESSION["user"]->role>1){ 
        if (isset($_POST["action"])){
            if ($_POST["action"] == "deleteClients"){
                header('Location: ./?action=confirmation_suppression_clients');
            }
        }
    }else{
        header('Location: ./?action=#');
    }
}


include "./vue/v_suppression_clients.php";
?>

