<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Statistiques</h1>

    <div style ="height:5vh;width:450px;" class="row align-items-center"> 

        <form action="" method="POST">

            <input class="col-4" name="date_debut" class="form-control" type="date" 
            value="<?= $date_debut; ?>">

            <input class="col-4" name="date_fin" class="form-control" type="date" 
            value="<?= $date_fin; ?>">
            
            <input width="25" height="25" type="image" src="image/chercherpardate.png">

        </form>
    </div>
</div>

<div class="card-group">
    <div class="col-sm-5" style="margin:1em 3em;">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Chiffre d'affaire par atelier</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Chiffre d'affaire</th>
                    </tr>
                </thead>
            <tbody>
            <?php $sommeCAParAtelier = 0;
            foreach($resultat as $recupOccur){ 
                $prix_total = round($recupOccur->prix_total, 2); 
                $sommeCAParAtelier = $sommeCAParAtelier + $prix_total; ?>
                <tr class="table-<?php date("d-m-Y"); ?>">
                    <td><?= $recupOccur->nom; ?></td>
                    <td><?= $prix_total; ?>€</td>
                </tr>
            <?php } ?>
            <tr>
                <td>Total</td>
                <td><?= $sommeCAParAtelier ?>€</td>
            </tr>
            </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-sm-5" style="margin:1em 3em;">
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Vente par atelier non reglées</h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Chiffre d'affaire</th>
                </tr>
            </thead>
        <tbody>
        <?php $sommeNOnPayeParAtelier = 0;
        foreach($resultatNonPaye as $recupOccurNonPaye){ 
            $prix_total = round($recupOccurNonPaye->prix_total, 2); 
            $sommeNOnPayeParAtelier = $sommeNOnPayeParAtelier + $prix_total; ?>
            <tr class="table-<?php date("d-m-Y"); ?>">
                <td><?= $recupOccurNonPaye->nom; ?></td>
                <td><?= $prix_total; ?>€</td>
            </tr>
        <?php } ?>
        <tr>
            <td>Total</td>
            <td><?= $sommeNOnPayeParAtelier ?>€</td>
        </tr>
        </tbody>
        </table>
    </div>
</div>
</div>
<div class="col-sm-5" style="margin:1em 3em;">
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Chiffre d'affaire par type de règlement</h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Chiffre d'affaire</th>
                </tr>
            </thead>
        <tbody>
        <?php foreach($resultatTypeReglement as $recupOccurTypeReglement){ 
            $prix_total = round($recupOccurTypeReglement->prix_total_par_mode_reglement, 2); ?>
            <tr class="table-<?php date("d-m-Y"); ?>">
                <td><?= $recupOccurTypeReglement->nom; ?></td>
                <td><?= $prix_total; ?>€</td>
            </tr>
        <?php } ?>
        </tbody>
        </table>
    </div>
</div>
</div>
<div class="col-sm-5" style="margin:1em 3em;">
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Chiffre d'affaire par classe</h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Chiffre d'affaire</th>
                </tr>
            </thead>
        <tbody>
        <?php foreach($resultatClasse as $recupOccurClasse){ 
            $prix_total = round($recupOccurClasse->prix_total_par_classe, 2); ?>
            <tr class="table-<?php date("d-m-Y"); ?>">
                <td><?= $recupOccurClasse->nom; ?></td>
                <td><?= $prix_total; ?>€</td>
            </tr>
        <?php } ?>
        </tbody>
        </table>
    </div>
</div>
</div>
<div class="col-sm-5" style="margin:1em 3em;">
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Destruction et transferts</h5>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Valeur</th>
                </tr>
            </thead>
        <tbody>
            <tr class="table-<?php date("d-m-Y"); ?>">
                <td>Destruction</td>
                <td><?= $leResultatDestruction->prix_destruction ?>€</td>
            </tr>
            <tr class="table-<?php date("d-m-Y"); ?>">
                <td>Transfert self</td>
                <td><?= $leResultatTransfertSelf->prix_par_type_transfert; ?>€</td>
            </tr>
            <tr class="table-<?php date("d-m-Y"); ?>">
                <td>Transfert atelier</td>
                <td><?= $leResultatTransfertAtelier->prix_par_type_transfert; ?>€</td>
            </tr>
        </tbody>
        </table>
    </div>
</div>
</div>
</div>

<p></p>
<?php include "./vue/v_footer.php"; ?>
<!--
//TRANSFERT
$RecupererLeNombreDeProduitsVendusetat_transfert= $cnx->prepare("SELECT DISTINCT produit.id 
as id_produit FROM vente INNER JOIN production ON production.id = vente.id_production INNER 
JOIN produit ON production.id_produit = produit.id INNER JOIN facture ON vente.id_facture = 
facture.id WHERE date_destruction IS NULL AND etat_transfert = 2 AND date_transfert BETWEEN 
? AND ?");

$RecupererLeNombreDeProduitsVendusetat_transfert->execute(array($date_debut, $date_fin));
$calculAtelier = 0;
while($resultat = $RecupererLeNombreDeProduitsVendusetat_transfert->fetch(PDO::FETCH_OBJ)){
// pour récupérer l'id du produit : $resultat->id_produit
$RecuperationConditionnementetat_transfert= $cnx->prepare("SELECT conditionnement FROM 
production INNER JOIN vente ON vente.id_production = production.id INNER JOIN facture ON 
vente.id_facture = facture.id WHERE id_produit = ? AND date_transfert BETWEEN ? AND ?");
$RecuperationConditionnementetat_transfert->execute(array($resultat->id_produit, $date_debut, 
$date_fin));
$RecuperationConditionnementResultatetat_transfert = $RecuperationConditionnementetat_transfert->fetch(PDO::FETCH_OBJ);

$CalculNbVentesetat_transfert= $cnx->prepare("SELECT SUM(vente.quantite) as quantite_vendue 
FROM vente INNER JOIN facture ON vente.id_facture = facture.id INNER JOIN production ON 
vente.id_production = production.id WHERE id_produit = ? AND date_transfert BETWEEN ? AND ?");
$CalculNbVentesetat_transfert->execute(array($resultat->id_produit, $date_debut, $date_fin));
$CalculNbVentesResulatetat_transfert = $CalculNbVentesetat_transfert->fetch(PDO::FETCH_OBJ);

$RecuperationPrixUnitaireetat_transfert= $cnx->prepare("SELECT prix FROM produit INNER JOIN 
production ON produit.id = production.id_produit INNER JOIN vente ON vente.id_production = 
production.id INNER JOIN facture ON vente.id_facture = facture.id WHERE produit.id = ? AND 
date_transfert BETWEEN ? AND ?");
$RecuperationPrixUnitaireetat_transfert->execute(array($resultat->id_produit, $date_debut, 
$date_fin));
$RecuperationPrixUnitaireResultatetat_transfert = $RecuperationPrixUnitaireetat_transfert->fetch(PDO::FETCH_OBJ);

$calculAtelier = $calculAtelier + (($RecuperationConditionnementResultatetat_transfert->conditionnement - $CalculNbVentesResulatetat_transfert->quantite_vendue) * $RecuperationPrixUnitaireResultatetat_transfert->prix);
}
//TRANSFRET FIN
-->