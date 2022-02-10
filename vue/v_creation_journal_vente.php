<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Journal des ventes</h1>
        <div style ="height:5vh;width:450px;" class="row align-items-center"> 

        <form action="" method="POST">

            <input class="col-4" name="date_debut" class="form-control" type="date" 
            value="<?= $date_debut; ?>">

            <input class="col-4" name="date_fin" class="form-control" type="date" 
            value="<?= $date_fin; ?>">
            
            <input width="25" height="25" type="image" src="image/chercherpardate.png">

        </form>
    </div>
    <form action="./?action=journal_vente_pdf" method="POST">
    <input formtarget="_blank" type="image" src="./image/imprimer.png" alt="Submit" width="40" height="40" >
        <input type="hidden" name="date_debut" value=<?= $date_debut ?>/>
        <input type="hidden" name="date_fin" value=<?= $date_fin ?>/>
    </div>
</form>
<h5 class="card-title">Journal des ventes du <?= $date_debut; ?> au <?= $date_fin; ?></h5>

      <table class="table">
  <thead>
    <tr>
      <th scope="col">Facture</th>
      <th scope="col">Date</th>
      <th scope="col">Montant</th>
      <th scope="col">Client</th>
      <!--<th scope="col">Prix</th> -->
      <th scope="col">Réglé</th>
    </tr>
  </thead>
  <tbody>
  <?php $sommeRegle = 0;
  $somme = 0;
   foreach($LesResultatsJournalVentes as $LeResultatJournalVentes){ 
       $somme += $LeResultatJournalVentes->total; ?>
<tr class="table-<?php date("d-m-Y"); ?>">
      <td><?= $LeResultatJournalVentes->id_facture; ?></td>
      <td><?= $LeResultatJournalVentes->date; ?></td>
      <td><?= $LeResultatJournalVentes->total; ?>€</td>
      <td><?= $LeResultatJournalVentes->nom; ?> <?= $LeResultatJournalVentes->prenom; ?></td>
      <?php if($LeResultatJournalVentes->date_reglement == NULL){ ?>
      <td></td>
      <?php }else{ ?>
      <td><?= $LeResultatJournalVentes->total; ?>€</td>
      <?php $sommeRegle += $LeResultatJournalVentes->total;;
     } ?>
    </tr>
    <?php } 
    foreach($LesResultatsJournalVentesDestruction as $LeResultatJournalVentesDestruction){ 
        $somme += $LeResultatJournalVentesDestruction->total;  ?>
    <tr>
        <td></td>
        <td><?= $LeResultatJournalVentesDestruction->date_destruction; ?></td>
        <td><?= $LeResultatJournalVentesDestruction->total; ?>€</td>
        <td>DESTRUCTION</td>
        <td></td>
    </tr>
    <?php } foreach($LesResultatsJournalVentesTransfert as $LeResultatJournalVentesTransfert){ 
        $somme += $LeResultatJournalVentesTransfert->total;  ?>
    <tr>
        <td></td>
        <td><?= $LeResultatJournalVentesTransfert->date_transfert; ?></td>
        <td><?= $LeResultatJournalVentesTransfert->total; ?>€</td>
        <?php if($LeResultatJournalVentesTransfert->id_type_transfert == 1){ ?>
            <td>TRANSFERT ATELIER</td>
        <?php }else{ ?>
            <td>TRANSFERT SELF</td>
        <?php } ?>
        <td></td>
    </tr>
    <?php } ?>
    <tr>
        <td></td>
        <td style="font-weight:600;">Total</td>
        <td style="font-weight:600;"><?= $somme ?>€</td>
        <td style="font-weight:600;">Total réglé</td>
        <td style="font-weight:600;"><?= $sommeRegle ?>€</td>
    </tr>
  </tbody>
</table>



<?php include "./vue/v_footer.php"; ?>
