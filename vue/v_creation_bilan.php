<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Bilan de la semaine</h1>
        <div style ="height:5vh;width:450px;" class="row align-items-center"> 

        <form action="" method="POST">

            <input class="col-4" name="date_debut" class="form-control" type="date" 
            value="<?= $date_debut; ?>">

            <input class="col-4" name="date_fin" class="form-control" type="date" 
            value="<?= $date_fin; ?>">
            
            <input width="25" height="25" type="image" src="image/chercherpardate.png">

        </form>
    </div>
    <form action="./?action=bilan_semaine_pdf" method="POST">
    <input formtarget="_blank" type="image" src="./image/imprimer.png" alt="Submit" width="40" height="40" >
        <input type="hidden" name="date_debut" value=<?= $date_debut ?>/>
        <input type="hidden" name="date_fin" value=<?= $date_fin ?>/>
    </div>
</form>
<h5 class="card-title">Semaine du <?= $date_debut; ?> au <?= $date_fin; ?></h5>
<div class="card-group">
    <div class="col-sm-5" style="margin:1em 3em;">
        <div class="card">
            <div class="card-body">
            <table class="table">
                <tr>
                    <td>LYCEE-PATISSERIE</td>
                    <?php if($lyceePatisserie == NULL){ ?>
                        <td name="lyceePatisserie"><?= $lyceePatisserie = 0; ?>€</td>
                    <?php }else{ ?>
                        <td name="lyceePatisserie"><?= round($lyceePatisserie, 2); ?>€</td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>LYCEE CHARCUTIER-TRAITEUR</td>
                    <?php if($charcuterieTraiteur == NULL){ ?>
                        <td name="charcuterieTraiteur"><?= $charcuterieTraiteur = 0; ?>€</td>
                    <?php }else{ ?>
                        <td name="charcuterieTraiteur"><?= round($charcuterieTraiteur, 2); ?>€</td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>LYCEE BOUCHERIE</td>
                    <?php if($boucherie == NULL){ ?>
                        <td name="boucherie"><?= $boucherie = 0; ?>€</td>
                    <?php }else{ ?>
                        <td name="boucherie"><?= round($boucherie, 2); ?>€</td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>LYCEE-CUISINE</td>
                    <?php if($cuisineLycee == NULL){ ?>
                        <td name="cuisineLycee"><?= $cuisineLycee = 0; ?>€</td>
                    <?php }else{ ?>
                        <td name="cuisineLycee"><?= round($cuisineLycee, 2); ?>€</td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>EMBALLAGES</td>
                    <?php if($emballages == NULL){ ?>
                        <td name="emballages"><?= $emballages = 0; ?>€</td>
                    <?php }else{ ?>
                        <td name="emballages"><?= round($emballages, 2); ?>€</td>
                    <?php } ?>
                </tr>
                <tr>
                    <td style="font-weight:600;">SOUS-TOTAL LYCEE</td>
                    <td style="font-weight:600;" name="sousTotalLycee"><?= round($sousTotalLycee, 2); ?>€</td>
                </tr>
                <tr>
                    <td>SOUS-TOTAL GRETA</td>
                    <?php if($GRETA == NULL){ ?>
                        <td name="greta"><?= $GRETA = 0; ?>€</td>
                    <?php }else{ ?>
                        <td name="greta"><?= round($GRETA, 2); ?>€</td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>SOUS-TOTAL CFA</td>
                    <?php if($CFA == NULL){ ?>
                        <td name="cfa"><?= $CFA = 0; ?>€</td>
                    <?php }else{ ?>
                        <td name="cfa"><?= round($CFA, 2); ?>€</td>
                    <?php } ?>
                </tr>
                <tr>
                    <th scope="col">TOTAL VENTES SEMAINE</th>
                    <th scope="col" name="totalVenteSemaineUn"><?= round($totalVenteSemaineUn, 2); ?>€</th>
                </tr>
            </table>
            </div>
        </div>
    </div>
    <div class="col-sm-5" style="margin:1em 3em;">
        <div class="card">
            <div class="card-body">
            <table class="table">
                <tr>
                    <td>ESPECE</td>
                    <?php if($liquide->prix_total == NULL){ ?>
                        <td name="espece"><?= $liquide->prix_total = 0; ?>€</td>
                    <?php }else{ ?>
                        <td name="espece"><?= round($liquide->prix_total, 2); ?>€</td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>CHEQUE</td>
                    <?php if($cheque->prix_total == NULL){ ?>
                        <td name="cheque"><?= $cheque->prix_total = 0; ?>€</td>
                    <?php }else{ ?>
                        <td name="cheque"><?= round($cheque->prix_total, 2); ?>€</td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>CARTE BLEUE</td>
                    <?php if($carteBleue->prix_total == NULL){ ?>
                        <td name="cb"><?= $carteBleue->prix_total = 0; ?>€</td>
                    <?php }else{ ?>
                        <td name="cb"><?= round($carteBleue->prix_total, 2); ?>€</td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>VALORISATION DESTRUCTION</td>
                    <?php if($destruction->prix_destruction == NULL){ ?>
                        <td name="destruction"><?= $destruction->prix_destruction = 0; ?>€</td>
                    <?php }else{ ?>
                        <td name="destruction"><?= round($destruction->prix_destruction, 2); ?>€</td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>TRANSFERT ATELIER</td>
                    <?php if($atelier->prix_par_type_transfert == NULL){ ?>
                        <td name="transfertA"><?= $atelier->prix_par_type_transfert = 0; ?>€</td>
                    <?php }else{ ?>
                        <td name="transfertA"><?= round($atelier->prix_par_type_transfert, 2); ?>€</td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>TRANSFERT SELF</td>
                    <?php if($self->prix_par_type_transfert == NULL){ ?>
                        <td name="transfertS"><?= $self->prix_par_type_transfert = 0; ?>€</td>
                    <?php }else{ ?>
                        <td name="transfertS"><?= round($self->prix_par_type_transfert, 2); ?>€</td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>FACTURES NON REGLEES</td>
                    <?php if($nonPaye->prix_total == NULL){ ?>
                        <td name="nonRegle">0€</td>
                    <?php }else{ ?>
                        <td name="nonRegle"><?= round($nonPaye->prix_total, 2); ?>€</td>
                    <?php } ?>
                </tr>
                <tr>
                    <th scope="col">TOTAL VENTES SEMAINE</th>
                    <th scope="col" name="totalVenteSemaineDeux"><?= round($totalVenteSemaineDeux, 2); ?>€</th>
                </tr>
            </table>
            </div>
        </div>
    </div>
</div>



<?php include "./vue/v_footer.php"; ?>
