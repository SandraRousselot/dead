<?php

//Fichier : liste.php
include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();



if(isset($_POST['nom'])){
    
    AjoutClasse($_POST['nom']);

    header('Location: ./?action=gestion_classes');
}
include "./vue/v_ajout_classe.php";

?>

    