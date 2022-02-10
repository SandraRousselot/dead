<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();


$laClasseAModifier = AffichageClassesParId($_POST["id"]);

if(isset($_POST['id'], $_POST['nom'])){
    
    ModificationClasse($_POST['id'], $_POST['nom']);

    header('Location: ./?action=gestion_classes');
}

include "./vue/v_modification_classe.php";

?>
