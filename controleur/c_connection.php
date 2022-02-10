<?php

//Fichier : liste.php
include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

unlogged_only();

// L'utilisateur à cliqué sur le bouton de connection ?
 if(isset($_POST['seConnecter'])){

  $connectionApprouvee = ConnectionUtilisateur($_POST['nom'], $_POST['mot_de_passe']);

  if($connectionApprouvee == true){
     header('Location: ./?action=default');
  }
}

include "./vue/v_connection.php";


?>