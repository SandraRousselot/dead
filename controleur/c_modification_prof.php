<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();


$leProfAModifier = AffichageProfsParId($_POST["id"]);

if(isset($_POST['id'], $_POST['nom'], $_POST['prenom'])){
    
    ModificationProf($_POST['id'], $_POST['nom'], $_POST['prenom']);

    header('Location: ./?action=gestion_profs');
}

include "./vue/v_modification_prof.php";

?>
