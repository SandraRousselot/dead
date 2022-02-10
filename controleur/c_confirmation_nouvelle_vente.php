<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();


if(isset($_POST['tags'])){
$produits = json_decode($_POST['tags']);
}


if(isset($_POST['prixtotal'])){
header('Location: ./?action=catalogue');
}


include "./vue/v_confirmation_nouvelle_vente.php";

?>
