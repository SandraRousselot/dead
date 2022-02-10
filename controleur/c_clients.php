<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();

if(isset($_POST['filtre'])){
$lesResultatsClients = AffichageClients($_POST['filtre']);
} else {
 $lesResultatsClients = AffichageClients();
}

if (isset($_POST["action"])){
    if ($_POST["action"] == "delete"){
        SupprimerClient($_POST["id"]);

        header('Location: ./?action=clients');
    }
}



include "./vue/v_clients.php";
?>