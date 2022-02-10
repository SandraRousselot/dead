<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();

if(isset($_POST['filtre'], $_POST['id_client'])){
$lesResultatsFacturationsParClient = AffichageFacturationsParIdClient($_POST['id_client'], $filtre);
}else{
$lesResultatsFacturationsParClient = AffichageFacturationsParIdClient($_POST['id_client']);

}


include "./vue/v_factures_client.php";
?>