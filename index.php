<?php
include "./controleur/c_principal.php";

if (isset($_GET["action"])){
    $action = $_GET["action"];
}
else{
    
    $action = "defaut";
}



$fichier = controleurPrincipal($action);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "./controleur/$fichier";

?>
     
