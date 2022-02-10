<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tableau de bord</h1>
    </div>
    
<div class="card-group">
    <div class="col-sm-5" style="margin:1em 3em;">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Factures non réglées</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Numéro</th>
                            <th scope="col">Date</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <!--<th scope="col">Prix</th> -->
                            <th scope="col">Etat</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php   foreach($lesResultatsFacturations as $leResultatFacturation){ ?>
                        <tr class="table-<?php date("d-m-Y"); ?>">
                            <td><?= $leResultatFacturation->id_facture; ?></td>
                            <td><?= $leResultatFacturation->date; ?></td>
                            <td><?= $leResultatFacturation->nom_client; ?></td>
                            <td><?= $leResultatFacturation->prenom_client; ?></td>
                            <form action="./?action=creation_facture" method="POST">
                                <input type="hidden" name="id_facture" value="<?= $leResultatFacturation->id_facture; ?>">
                                <td><input class="btn btn-danger" type="submit" value="REGLER"></td>
                            </form>
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
            <h5 class="card-title">Produits périmés ou en DLC</h5>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Famille</th>
                  <th scope="col">Désignation</th>
                  <th scope="col">Atelier</th>
                  <th scope="col">DLC</th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($lesResultatsProductions as $leResultatProduction){
                $type = "rien";

                $date_peremption = strtotime(str_replace('/', '-', $leResultatProduction->date_peremption));
                $date_du_jour = strtotime(date("d-m-Y"));
              

                $interval = date_diff(date_create(str_replace('/', '-', $leResultatProduction->date_peremption)), date_create(date("d-m-Y")));
                

              if($leResultatProduction->etat_congelation != 1 ){
              if($date_peremption == $date_du_jour){
                  $type = "warning";
                }else if($date_peremption > $date_du_jour){
                  $type = "success";
                } else if($date_peremption < $date_du_jour){
                  $type = "danger";
                }
              } else if($date_peremption < $date_du_jour){
                $type = "danger";
              } else if($date_peremption == $date_du_jour){
                $type = "warning";
              }else{
                $type = "info";
              }
                ?>

              <?php if($type != "success" && $type != "info"){ ?>

                <tr class="table-<?=$type?>">
                <?php if($leResultatProduction->etat_congelation == 1){ ?>

                
                  <td><input width="15" height="15" type="image" src="image/congelateur.png">&nbsp;<?= $leResultatProduction->nom_famille_produit; ?></td>
                  <?php } else { ?>
                    <td><?= $leResultatProduction->nom_famille_produit; ?></td>
                  <?php } ?>
                  <td><?= $leResultatProduction->nom_produit; ?></td>
                  <td><?= $leResultatProduction->nom_atelier ; ?></td>
                  <?php if($date_peremption < $date_du_jour){ ?>
                    <td><?= $interval->format('- %a jours'); ?></td>
                  <?php } else { ?>
                  <td><?= $interval->format('+ %a jours'); ?></td>
                  <?php } ?>
                <td>
                      <form action="" method="POST"> 
                      <input name="id_produit" type="hidden" value="<?php echo $leResultatProduction->id_produit; ?>"></input>
                      <input name="destruire" type="hidden" value="<?php echo $leResultatProduction->id_production; ?>"></input>
                      <input width="30" height="30" type="image" alt="Envoyer à la destruction" src="image/poubelle.png">
                    </form>
                  </td>
                  <td>
                  <?php if($leResultatProduction->etat_congelation != 1){ ?>
                      <form action="" method="POST"> 
                      <input name="date_fabrication" type="hidden" value="<?php echo $leResultatProduction->date_fabrication; ?>"></input>
                      <input name="congelateur" type="hidden" value="<?php echo $leResultatProduction->id_production; ?>"></input>
                      <input width="30" height="30" type="image" src="image/congelateur.png">
                    </form>
                  </td>

                <?php } ?>
                  </tr>
                <?php } } ?>
              </tbody>
            </table>
          </div>
        </div>
    </div>
    <div class="col-sm-5" style="margin:1em 3em;">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Réservations non réglées</h5>
      <table class="table">
  <thead>
    <tr>
      <th scope="col">Numéro</th>
      <th scope="col">Date</th>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <!--<th scope="col">Prix</th> -->
      <th scope="col">Etat</th>
    </tr>
  </thead>
  <tbody>
  <?php   foreach($lesResultatsFacturationsEnReservation as $leResultatFacturationEnReservation){ ?>
<tr class="table-<?php date("d-m-Y"); ?>">
      <td><?= $leResultatFacturationEnReservation->id_facture; ?></td>
      <td><?= $leResultatFacturationEnReservation->date; ?></td>
      <td><?= $leResultatFacturationEnReservation->nom_client; ?></td>
      <td><?= $leResultatFacturationEnReservation->prenom_client; ?></td>
      <form action="./?action=creation_facture" method="POST">
      <input type="hidden" name="id_facture" value="<?= $leResultatFacturationEnReservation->id_facture; ?>">
      <td><input class="btn btn-danger" type="submit" value="REGLER"></td>
      </form>
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
            <h5 class="card-title">Top 3 des clients les plus fidèles</h5>
            <table class="table">
            <thead>
              <tr>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Nombre de factures</th>
              </tr>
            </thead>
            <tbody>
            <?php   foreach($LesResultatsClientsFideles as $LeResultatClientFidele){ ?>
            <tr >
              <td><?= $LeResultatClientFidele->nom; ?></td>
              <td><?= $LeResultatClientFidele->prenom; ?></td>
              <td><?= $LeResultatClientFidele->nombreAchats; ?></td>
              </form>
            </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
    </div>
</div>
</div>

</main>
    

  <!-- small modal -->
<div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Règlement facture</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="center">
          <form action="" method="POST"> 
          <input name="id_produit" type="hidden" value="<?php echo $leResultatProduction->id_produit; ?>"></input>
          <input name="transfert" type="hidden" value="<?php echo $leResultatProduction->id_production; ?>"></input>
          <button type="submit" name="transfert_ou" value="2"><img width="45" height="45" src="image/transfert_self.png" alt="Transfert Self"></button>&nbsp;&nbsp;&nbsp;&nbsp;
          <button type="submit" name="transfert_ou" value="1"><img width="45" height="45" src="image/transfert_atelier.png" alt="Transfert Atelier"></button>&nbsp;&nbsp;&nbsp;&nbsp;
          <br /><br />
          <div class="alert alert-primary" role="alert">
          <img width="20" height="20" src="image/transfert_self.png" alt="Transfert Self">: Transfert Self
          <br />
          <img width="20" height="20" src="image/transfert_atelier.png" alt="Transfert Atelier">: Transfert Atelier
          </div>
         </form>                 
       </div>

    </div>
  </div>
</div>

        </div>
    </div>
</div>

<?php include "./vue/v_footer.php"; ?>