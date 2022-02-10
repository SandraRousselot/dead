<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Transfert</h1>
    </div>
<script>
//window.onload = calculate;

//function calculate() {
// on re-calcule tout à chaque saisie
 
 // éléments ayant la class "quantite"
//var element = document.getElementsByClassName('quantite'); 
//}
</script>




<form action="" method="POST">
<div class="card text-center">
  <div class="card-header">
  Récapitulatif du transfert
  </div>
  <div class="card-body">
    <p class="card-text">


<!-- Affichage prix total -->

<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Quantité à transférer : </span>
  </div>
  
    <input name="id_produit" type="hidden" value="<?= $_POST['id_produit']; ?>"></input>
    <input name="transferer" type="hidden" value="<?= $_POST['transferer']; ?>"></input>
    <input type="number" class="quantite form-control" id="quantite" name="quantite" value="1" >
    <select name="id_transfert" class="form-control">
            <option value="2">Self</option>
            <option value="1">Atelier</option>
    </select>
    
</div>
    </p>
  </div>
  <div class="card-footer text-muted">
  <input id="cf-transfert" class="btn btn-primary btn-lg btn-block" type="submit" name="cf-transfert" value="Confirmer" />
  </div>
</div>
</form>
</main>

<?php include "./vue/v_footer.php"; ?>