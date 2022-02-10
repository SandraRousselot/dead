<?php

//Fichier : liste.php
include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();



if(isset($_POST['nom'], $_POST['prenom'])){
    
    AjoutProfesseur($_POST['nom'], $_POST['prenom']);

    header('Location: ./?action=gestion_profs');
}
include "./vue/v_ajout_prof.php";

?>

    