<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Confirmation nouvelle production</h1>
    </div>

    <script>
window.onload = calculate;

function calculate() {
// on re-calcule tout à chaque saisie
 
 // nbre d'élément atant la class "quantite_produit"
 // chaque quantité i est en couple avec un prix i
var nbligne = document.getElementsByClassName('quantite_type_produit').length; 
var prixtotaltypeproduit = document.getElementById(prixtotal);

for (let i = 0; i < nbligne; i++) {
 var letotal=0;

 var x = document.getElementsByClassName('quantite_type_produit')[i].value;
 var y = document.getElementsByClassName('prix_type_produit_de_base')[i].value;
 prix_produit = document.getElementsByClassName('prix_produit')[i];
 
 //si pas de quantité on ne fait pas de calcul
 if (x=="") {
    prix_produit.value="";
    continue; // on passe au suivant
 }
 
 letotal = letotal + ((x * 10 * y * 10) / 100); i // x will be 0.3
 prixtotaltypeproduit = prixtotaltypeproduit + letotal;
 prix_produit.value = letotal;

}
prixtotal.value = prixtotaltypeproduit;

 
}
</script>


<form action="" method="POST">
<div class="card text-center">
  <div class="card-header">
  <?= $_POST['nom'] ?>
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
    <input id="quantite_type_produit" name="quantite_type_produit[]" step="any" type="number" class="quantite_type_produit form-control" value="1" oninput="calculate()">
    <div class="input-group-append">
        <span class="input-group-text"><?= RecherchePrixParTypeProduit($valeur->value)->nom_unite ?></span>
    </div>
    <input id="prix_type_produit_de_base" type="number" step="any" name="prix_type_produit_de_base[]" class="prix_type_produit_de_base form-control" oninput="calculate()" value="<?= RecherchePrixParTypeProduit($valeur->value)->prix?>"/>
    <div class="input-group-append">
        <span class="input-group-text">Prix Unitaire</span>
    </div>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    <input id="prix_produit" type="" step="any" name="prix_produit[]" class="prix_produit form-control" value="0" readonly/>
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

    
 <input type="hidden"name="nom"value="<?=$_POST['nom']?>">
 <input type="hidden"name="atelier"value="<?=$_POST['atelier']?>">
 <input type="hidden"name="date_fabric"value="<?=$_POST['date_fabric']?>">
 <input type="hidden"name="dateFin"value="<?=$dateFin?>">
 <input type="hidden"name="temperature"value="<?=$_POST['temperature']?>">
 <input type="hidden"name="quantite"value="<?=$_POST['quantite']?>">
 <input type="hidden"name="stock"value="<?=$_POST['stock']?>">
 <input type="hidden"name="classe"value="<?=$_POST['classe']?>">
 <input type="hidden"name="prof"value="<?=$_POST['prof']?>">
 <input type="hidden"name="unite"value="<?=$_POST['unite']?>">
 <input type="hidden"name="famille"value="<?=$_POST['famille']?>">


</form>
</main>

<?php include "./vue/v_footer.php"; ?>