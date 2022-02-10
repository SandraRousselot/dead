<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Facture</h1>
        <?php if($lesResultatsFactures[0]->id_moyen_reglement == 0){ 
            if($lesResultatsFactures[0]->etat_annulation == 0){?>
            <a href="#" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#smallModal">Règlement de la facture</a>
                <?php if($lesResultatsFactures[0]->etat_annulation == 0){ ?>
                    <form action="" method="POST"> 
                        <input name="annuler" type="hidden" value="<?php echo $lesResultatsFactures[0]->id_facture; ?>"></input>
                        <input width="30" height="30" type="image" alt="Annuler la facture" src="image/annuler_facture.png">
                    </form>
                    <form action="./?action=modification_facture" method="POST"> 
                        <input name="id_facture" type="hidden" value="<?php echo $lesResultatsFactures[0]->id_facture; ?>"></input>
                        <input width="30" height="30" type="image" alt="Modifier la facture" src="image/modifier_facture.png">
                    </form>
                <?php } 
            }else{
                //pas de bouton reglement ni annulation
            }
        } ?>
        <a target="_blank" href="./?action=facture_pdf&amp;id_facture=<?= $lesResultatsFactures[0]->id_facture ?>">
        <img alt="Imprimer la facture" src="./image/imprimer.png" width="40" height="40">
        </a>
    </div>


<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row p-2">
                        <div class="col-md-6">
                            <img src="./image/logo.jpeg" height="120" width="auto">
                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-1"><b>Boutique des ventes</b></p>
                            <p class="font-weight-bold mb-1">12 rue Louis Amstrong</p>
                            <p class="font-weight-bold mb-1">87065 LIMOGES</p>
                            <p class="font-weight-bold mb-1">Tél : 05 55 35 06 73</p>
                            <p class="font-weight-bold mb-1">Mail : boutique.jean.monnet@gmail.com</p>

                        </div>
                    </div>

                    <hr class="my-1">

                    <div class="row pb-5 p-5">
                        <div class="col-md-6">
                            <p class="mb-1"><?= $lesResultatsFactures[0]->nom_client?>&nbsp;<?= $lesResultatsFactures[0]->prenom_client ?></p>
                            <p><?= $lesResultatsFactures[0]->ville_client ?></p>

                        </div>

                        <div class="col-md-6 text-right">
                            <p class="font-weight-bold mb-1">Facture N° <?= $lesResultatsFactures[0]->id_facture ?></p>
                            <p class="font-weight-bold mb-1">Date <?= $lesResultatsFactures[0]->date_facturation ?></p>

                        </div>
                    </div>
                    <?php if($lesResultatsFactures[0]->reservation == 1){ 
                        if($lesResultatsFactures[0]->id_moyen_reglement == 0){?>
                        <div style="margin-left:28%" class="alert alert-primary col-md-5 text-center center" role="alert">
                        <B style="letter-spacing:7px; font-size:26px">RÉSERVÉE</B>
                        </div>
                        <?php }else{ ?>
                            <div style="margin-left:28%" class="alert alert-primary col-md-5 text-center center" role="alert">
                            <B style="letter-spacing:7px; font-size:26px">A ÉTÉ RÉSERVÉE</B>
                            </div>
                        <?php } 
                    } ?>
                    <?php if($lesResultatsFactures[0]->etat_annulation == 1){ ?>
                            <div style="margin-left:28%" class="alert alert-danger col-md-5 text-center center" role="alert">
                            <B style="letter-spacing:7px; font-size:26px">ANNULÉE</B>
                            </div>
                    <?php } ?>
                    <div class="row p-5">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-0 text-uppercase small font-weight-bold">Désignation</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Portions</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Conso. avant</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Quantité</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">P. Unité</th>
                                        <th class="border-0 text-uppercase small font-weight-bold">Total</th>
                                        <th class="border-0 text-uppercase small font-weight-bold"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($lesResultatsFactures as $key => $value) { ?>

                                    <tr>
                                        <td><?= $value->denomination_produit; ?></td>
                                        <td><?= $value->nb_portions; ?></td>
                                        <td><?= $value->DLC; ?></td>
                                        <td><?= $value->quantite; ?></td>
                                        <td><?= $value->prix_unitaire; ?>€</td>
                                        <td><?= $value->prix_produit_total; ?>€</td>
                                    </tr>

                                <?php } ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php if($lesResultatsFactures[0]->id_moyen_reglement == 0){
                        if($lesResultatsFactures[0]->etat_annulation == 0){
                            $paiement = "Veuillez régler votre facture dans les meilleurs délais";
                        }elseif($lesResultatsFactures[0]->etat_annulation == 1){
                            $paiement = "Aucun paiement requis";
                        }
                    }else if($lesResultatsFactures[0]->id_moyen_reglement != 0){
                        if($lesResultatsFactures[0]->etat_annulation == 0){
                            $paiement = "Réglé par ". $lesResultatsFactures[0]->nom_mode_reglement;
                        }elseif($lesResultatsFactures[0]->etat_annulation == 1){
                            $paiement = "Aucun paiement requis";
                        }
                    } ?>
                    <div style="padding:1%; background-color:black; color:white">
                    <table>
                    <tr>
                    <td width="920px">
                            <p class="h3">&nbsp;&nbsp;<?= $paiement ?></p>
                        </td>
                        <td style="text-align:right">
                            <p class="h6">Total</p>
                        <?php if($lesResultatsFactures[0]->id_moyen_reglement == 0){
                            if($lesResultatsFactures[0]->etat_annulation == 0){ ?>
                                <p class="h2"><?= $lesResultatsFactures[0]->total_facture ?>€</p>
                            <?php }elseif($lesResultatsFactures[0]->etat_annulation == 1){ ?>
                                <p class="h2">0€</p>
                            <?php }
                        } ?> 
                        </td>
                        </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


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
          <input type="hidden" name="id_facture" value="<?= $_POST['id_facture'] ?>">
          <button type="submit" name="moyen_paiement" value="1"><img width="45" height="45" src="image/carte_bancaire.png" alt="SomeAlternateText"></button>&nbsp;&nbsp;&nbsp;&nbsp;
          <button type="submit" name="moyen_paiement" value="2"><img width="45" height="45" src="image/cheque.png" alt="SomeAlternateText"></button>&nbsp;&nbsp;&nbsp;&nbsp;
          <button type="submit" name="moyen_paiement" value="3"><img width="45" height="45" src="image/cash.png" alt="SomeAlternateText"></button>
         </form>                 
       </div>

    </div>
  </div>
</div>



<?php include "./vue/v_footer.php"; ?>
