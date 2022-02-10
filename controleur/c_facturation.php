<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();

if(isset($_POST['filtre'])){
$lesResultatsFacturations = AffichageFacturations($_POST['filtre']);
}else{
$lesResultatsFacturations = AffichageFacturations();

}


include "./vue/v_facturation.php";
?>