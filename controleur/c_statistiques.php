<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();

if(isset($_SESSION["user"])){    
    if($_SESSION["user"]->role==3){ 

        
if(isset($_POST['date_debut'], $_POST['date_fin'])){
    $date_debut = date("Y-m-d", strtotime($_POST['date_debut']));
    $date_fin = date("Y-m-d", strtotime($_POST['date_fin']));
} else {
    $date_debut = date("Y-m-d", strtotime("01/01/1970"));
    $date_fin = date("Y-m-d", strtotime("01/01/2200"));
}

    // DEBUT GRAPHIQUE CHIFFRE D'AFFAIRE PAR ATELIER
$cnx = connexionPDO();
$RecuperationOccurences= $cnx->prepare("SELECT * FROM atelier");
$RecuperationOccurences->execute();
$json = [];
while($row = $RecuperationOccurences->fetch(PDO::FETCH_ASSOC)){
    extract($row);
    $json[]= $nom;
} 
$json[]= "Total";
//$json[]= "Transfert Atelier";
//$json[]= "Transfert Self";
$test = json_encode($json);
$RecuperationOccurencesPrix= $cnx->prepare("SELECT SUM(prix_total) AS prix_total_par_atelier, 
nom AS nom_atelier FROM total_atelier INNER JOIN facture ON total_atelier.id_facture = facture.id WHERE date_reglement>= ? AND date_reglement<= ? GROUP BY total_atelier.id ORDER BY total_atelier.id ");
$RecuperationOccurencesPrix->execute(array($date_debut, $date_fin));
$jsonprix = [];
while($rows = $RecuperationOccurencesPrix->fetch(PDO::FETCH_ASSOC)){
    extract($rows);
    $jsonprix[] = $prix_total_par_atelier;
}
    //TOTAL
$RecuperationOccurencesPrixTotal= $cnx->prepare("SELECT SUM(prix_total) AS prix_total, 
nom AS nom_atelier FROM total_atelier");
$RecuperationOccurencesPrixTotal->execute(array($date_debut, $date_fin));
while($rowsTotal = $RecuperationOccurencesPrixTotal->fetch(PDO::FETCH_ASSOC)){
    extract($rowsTotal);
    $jsonprix[] = $prix_total;
}
$result = json_encode($jsonprix);
    // FIN GRAPHIQUE CHIFFRE D'AFFAIRE PAR ATELIER


    // DEBUT RAPHIQUE CHIFFRE D'AFFAIRE PAR TYPE DE REGLEMENT
$RecuperationOccurencesTypeReglement= $cnx->prepare("SELECT * FROM mode_reglement");
$RecuperationOccurencesTypeReglement->execute();
$jsonTypeReglement = [];
while($rowTypeReglement = $RecuperationOccurencesTypeReglement->fetch(PDO::FETCH_ASSOC)){
    extract($rowTypeReglement);
    $jsonTypeReglement[]= $nom;
} 
$essai = json_encode($jsonTypeReglement);
$RecuperationOccurencesTypeReglement= $cnx->prepare("SELECT mode_reglement.id as 
id_mode_reglement, SUM(vente.prix_total) AS prix_total_par_mode_reglement FROM vente 
RIGHT JOIN facture ON vente.id_facture = facture.id RIGHT JOIN mode_reglement ON 
facture.id_moyen_reglement = mode_reglement.id WHERE date_reglement>= ? AND date_reglement<= ? GROUP BY id_mode_reglement ORDER BY 
id_mode_reglement");
$RecuperationOccurencesTypeReglement->execute(array($date_debut, $date_fin));
$jsonTypeReglement = [];
while($rowsTypeReglement = $RecuperationOccurencesTypeReglement->fetch(PDO::FETCH_ASSOC)){
    extract($rowsTypeReglement);
    $jsonTypeReglement[] = $prix_total_par_mode_reglement;
}
$resultat = json_encode($jsonTypeReglement);
    // FIN RAPHIQUE CHIFFRE D'AFFAIRE PAR TYPE DE REGLEMENT

// DEBUT GRAPHIQUE CHIFFRE D'AFFAIRE PAR ATELIER NON PAYE
$cnx = connexionPDO();
$RecuperationOccurencesNonPayee= $cnx->prepare("SELECT * FROM atelier");
$RecuperationOccurencesNonPayee->execute();
$jsonNonPayee = [];
while($rowNonPayee = $RecuperationOccurencesNonPayee->fetch(PDO::FETCH_ASSOC)){
    extract($rowNonPayee);
    $jsonNonPayee[]= $nom;
} 
$jsonNonPayee[]= "Total";
//$jsonNonPayee[]= "Transfert Atelier";
//$jsonNonPayee[]= "Transfert Self";
$suite = json_encode($jsonNonPayee);
$RecuperationOccurencesNonPayeePrix= $cnx->prepare("SELECT SUM(prix_total) AS total_par_atelier, 
nom AS nom_atelier FROM total_atelier GROUP BY id ORDER BY id ");
$RecuperationOccurencesNonPayeePrix->execute(array($date_debut, $date_fin));
$jsonNonPayee = [];
while($rowsNonPayee = $RecuperationOccurencesNonPayeePrix->fetch(PDO::FETCH_ASSOC)){
    extract($rowsNonPayee);
    $jsonNonPayee[] = $total_par_atelier;
}
//TOTAL
$RecuperationOccurencesPrixTotalNonPayee= $cnx->prepare("SELECT SUM(prix_total) AS prix_total, 
nom AS nom_atelier FROM total_atelier");
$RecuperationOccurencesPrixTotalNonPayee->execute(array($date_debut, $date_fin));
while($rowsTotalNonPayee = $RecuperationOccurencesPrixTotalNonPayee->fetch(PDO::FETCH_ASSOC)){
    extract($rowsTotalNonPayee);
    $jsonprix[] = $prix_total;
}
$results = json_encode($jsonNonPayee);
        // FIN GRAPHIQUE CHIFFRE D'AFFAIRE PAR ATELIER NON PAYE
    


    }else{
        header('Location: ./?action=#');
    }
}
 


include "./vue/v_statistiques.php";
?>
