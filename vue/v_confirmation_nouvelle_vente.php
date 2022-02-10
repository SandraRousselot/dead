<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Confirmation nouvelle vente</h1>
    </div>
<script>
window.onload = calculate;

function calculate() {
// on re-calcule tout à chaque saisie
 
 // nbre d'élément atant la class "quantite_produit"
 // chaque quantité i est en couple avec un prix i
var nbligne = document.getElementsByClassName('quantite_produit').length; 
var prixtotalproduit = document.getElementById(prixtotal);

for (let i = 0; i < nbligne; i++) {
 var letotal=0;

 var x = document.getElementsByClassName('quantite_produit')[i].value;
 var y = document.getElementsByClassName('prix_produit_de_base')[i].value;
 prix_produit = document.getElementsByClassName('prix_produit')[i];
 
 //si pas de quantité on ne fait pas de calcul
 if (x=="") {
    prix_produit.value="";
    continue; // on passe au suivant
 }
 
 letotal = letotal + ((x * 10 * y * 10) / 100); i // x will be 0.3
 prixtotalproduit = prixtotalproduit + letotal;
 prix_produit.value = letotal;

}
prixtotal.value = prixtotalproduit;

 
}
</script>




<form action="./?action=creation_facture" method="POST">
<div class="card text-center">
  <div class="card-header">
  Récapitulatif de la commande de <?= $_POST['client']; ?>
  </div>
  <div class="card-body">
    <h5 class="card-title">Compositions</h5>
    <p class="card-text">

    <?php foreach($produits as $leproduit => $valeur){ ?>
    <!-- Début des modifications de prix -->
<div class="input-group mb-2">
    <div class="input-group-prepend" style="width:37%">
        <span class="input-group-text"><?= $valeur->value; ?></span>
    </div>
    <?php if(isset($_POST['reservation'])){
        $reservation = 1;
    }else{
        $reservation = 0;
    } ?>
    <input name="reservation" class="form-check-input" type="hidden" value="<?= $reservation; ?>">
    <input name="produits[]" type="hidden" class="form-control" value="<?= RecuperationProduit($valeur->value)->id_produit; ?>">
    <input name="nomprenom" type="hidden" class="form-control" value="<?= $_POST['client'] ?>"/>

    <?php
    $resultat_production = AffichageProductionAvecIdProduit(RecuperationProduit($valeur->value)->id_produit);

    $lesResultatsVentes = RecuperationVentesParIdProduction($resultat_production->id_production);
    $conditionnement = $resultat_production->conditionnement;
     foreach($lesResultatsVentes as $leResultatVente){ 
      $conditionnement = $conditionnement - $leResultatVente->quantite;

      } 

  ?>
    <input id="quantite_produit" min="0" max="<?= $conditionnement?>"  name="quantite_produit[]" step="any" type="number" class="quantite_produit form-control" value="1" oninput="calculate()">
    <div class="input-group-append">
        <span class="input-group-text"><?= RecuperationProduit($valeur->value)->nom_unite ?></span>
    </div>
    <input id="prix_produit_de_base" type="number" step="any" name="prix_produit_de_base[]" class="prix_produit_de_base form-control" oninput="calculate()" value="<?= RecuperationProduit($valeur->value)->prix;?>"/>
    <div class="input-group-append">
        <span class="input-group-text">Prix Unitaire</span>
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    <input id="prix_produit" step="any" name="prix_produit[]" class="prix_produit form-control" value="0" readonly/>
    <div class="input-group-append">
        <span class="input-group-text">€</span>
    </div>

</div>
<!-- Fin des modifications de prix -->
<?php } ?>
<!-- Affichage prix total -->
<br />
<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Prix total : </span>
  </div>
  <input type="text" class="form-control" id="prixtotal" name="prixtotal" readonly>
  <div class="input-group-append">
        <span class="input-group-text">€</span>
    </div>
</div>
    </p>
  </div>
  <div class="card-footer text-muted">
  <input class="btn btn-primary btn-lg btn-block" type="submit" name="cf-production" value="Confirmer" />
  </div>
</div>
</form>
</main>

<?php include "./vue/v_footer.php"; ?>