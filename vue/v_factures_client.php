<?php include "./vue/v_header.php"; ?>
 
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Factures</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        <form action="" method="POST">
        <!-- <select onchange="this.form.submit()" name="filtre" class="form-control" >
            <option value="facture.id">Trier par</option>
            <option value="facture.id">Numéro</option>
            <option value="facture.id DESC">Numéro ~</option>
        </select> -->
        </form>
        </div>
      </div>
      <table class="table">
  <thead>
    <tr>
      <th scope="col">Numéro</th>
      <th scope="col">Date</th>
      <th scope="col">Prix</th>
      <th scope="col">Etat</th>
    </tr>
  </thead>
  <tbody>
  <?php   foreach($lesResultatsFacturationsParClient as $leResultatFacturationParClient){ ?>
<tr class="table-<?php date("d-m-Y"); ?>">
      <td><?= $leResultatFacturationParClient->id_facture; ?></td>
      <td><?= $leResultatFacturationParClient->date; ?></td>
      <td><?= $leResultatFacturationParClient->total; ?>€</td>
      <?php if($leResultatFacturationParClient->id_moyen_reglement <1){
        if($leResultatFacturationParClient->etat_annulation == 0){
          $etat = "NON REGLEE";
        }elseif($leResultatFacturationParClient->etat_annulation == 1){
          $etat = "ANNULEE";
        }
      }else{
        $etat = "REGLEE";
      } ?>
      <form action="./?action=creation_facture" method="POST">
      <input type="hidden" name="id_facture" value="<?= $leResultatFacturationParClient->id_facture; ?>">
      <td><input class="btn btn-primary" type="submit" value="<?= $etat; ?>"></td>
      </form>
    </tr>
    <?php } ?>
  </tbody>
</table>
    </main>

  

<?php include "./vue/v_footer.php"; ?>