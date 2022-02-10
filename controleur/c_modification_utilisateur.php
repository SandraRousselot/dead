<?php

//Fichier : liste.php
include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();


// L'utilisateur à cliqué sur le bouton de modification ?
if(isset($_POST['modifierMotdepasse'])){
    $ModificationApprouvee = ModificationUtilisateur($_SESSION['user']->nom, password_hash($_POST['mot_de_passe'],PASSWORD_BCRYPT));
}
if(isset($_POST['modifierNom'])){
    $ModificationApprouvee = ModificationUtilisateur($_POST['nom'], $_SESSION['user']->mot_de_passe);
}
include "./vue/v_modification_utilisateur.php";

?>