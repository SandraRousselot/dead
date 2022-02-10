<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();

$lesResultatsVentes = AffichageVentes();

include "./vue/v_ventes.php";
?>