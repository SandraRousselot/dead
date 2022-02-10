<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Ordre de recette</h1>
        <div style ="height:5vh;width:450px;" class="row align-items-center"> 

        <form action="" method="POST">

            <input class="col-4" name="date_debut" class="form-control" type="date" 
            value="<?= $date_debut; ?>">

            <input class="col-4" name="date_fin" class="form-control" type="date" 
            value="<?= $date_fin; ?>">
            
            <input width="25" height="25" type="image" src="image/chercherpardate.png">

        </form>
    </div>
    <form action="./?action=ordre_recette_pdf" method="POST">
    <input formtarget="_blank" type="image" src="./image/imprimer.png" alt="Submit" width="40" height="40" >
        <input type="hidden" name="date_debut" value=<?= $date_debut ?>/>
        <input type="hidden" name="date_fin" value=<?= $date_fin ?>/>
    </div>
</form>
<h5 class="card-title">Ordre de recette du <?= $date_debut; ?> au <?= $date_fin; ?></h5>

      <table class="table">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Facture</th>
      <th scope="col">Client</th>
      <th scope="col">Ville</th>
      <th scope="col">Montant</th>
      <!--<th scope="col">Prix</th> -->
      <th scope="col">Réglé le</th>
      <th scope="col">Par</th>
    </tr>
  </thead>
  <tbody>
  <?php $sommeRegle = 0;
  $somme = 0;
   foreach($LesResultatsOrdreRecette as $LeResultatOrdreRecette){ 
       $somme += $LeResultatOrdreRecette->total; ?>
<tr class="table-<?php date("d-m-Y"); ?>">
      <td><?= $LeResultatOrdreRecette->date; ?></td>
      <td><?= $LeResultatOrdreRecette->id_facture; ?></td>
      <td><?= $LeResultatOrdreRecette->nom; ?> <?= $LeResultatOrdreRecette->prenom; ?></td>
      <td><?= $LeResultatOrdreRecette->ville; ?></td>
      <td><?= $LeResultatOrdreRecette->total; ?>€</td>
      <?php if($LeResultatOrdreRecette->date_reglement == NULL){ ?>
      <td></td>
      <?php }else{ ?>
      <td><?= $LeResultatOrdreRecette->date_reglement; ?></td>
      <?php $sommeRegle += $LeResultatOrdreRecette->total;;
     } ?>
     <td><?= $LeResultatOrdreRecette->moyen_reglement; ?></td>
    </tr>
    <?php } 
    foreach($LesResultatsOrdreRecetteDestruction as $LeResultatOrdreRecetteDestruction){ 
        $somme += $LeResultatOrdreRecetteDestruction->total;  ?>
    <tr>
        <td><?= $LeResultatOrdreRecetteDestruction->date_destruction; ?></td>
        <td></td>
        <td>DESTRUCTION</td>
        <td></td>
        <td><?= $LeResultatOrdreRecetteDestruction->total; ?>€</td>
        <td></td>
        <td></td>
    </tr>
    <?php } foreach($LesResultatsOrdreRecetteTransfert as $LeResultatOrdreRecetteTransfert){ 
        $somme += $LeResultatOrdreRecetteTransfert->total;  ?>
    <tr>
        <td><?= $LeResultatOrdreRecetteTransfert->date_transfert; ?></td>
        <td></td>
        <?php if($LeResultatOrdreRecetteTransfert->id_type_transfert == 1){ ?>
            <td>TRANSFERT ATELIER</td>
        <?php }else{ ?>
            <td>TRANSFERT SELF</td>
        <?php } ?>
        <td></td>
        <td><?= $LeResultatOrdreRecetteTransfert->total; ?>€</td>
        <td></td>
        <td></td>
    </tr>
    <?php } ?>
    <tr>
        <td></td>
        <td style="font-weight:600;"></td>
        <td style="font-weight:600;"></td>
        <td style="font-weight:600;">Total</td>
        <td style="font-weight:600;"><?= $sommeRegle ?>€</td>
        <td></td>
        <td></td>
    </tr>
  </tbody>
</table>



<?php include "./vue/v_footer.php"; ?>
