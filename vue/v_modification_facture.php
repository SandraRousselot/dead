<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 
border-bottom">
        <h1 class="h2">Modification d'une facture</h1>
    </div>

    <div class="container" style="margin-top: 1em;">
    <!-- Sign up form -->
    <form action="" method="POST">
        <!-- Sign up card -->
        <div class="card person-card">
        <div class="col-md-12" style="padding=0.5em;">
            <div class="card-body">
                <!-- First row (on medium screen) -->
                <div class="row">
                    <div class="card-body">
                        <h2 class="card-title">Nom du client</h2>
                        <br />
                            <div class="form-group">
                                <input name="id" type="hidden" value="<?= $lesResultatsFactures[0]->id ?>"></input>
                                <input name="id_client" type="hidden" value=" <?= $lesResultatsFactures[0]->id_client?> ?>"></input>

                                <input name="nom" type="text" class="form-control" id="nom_client" 
                                value="<?= $lesResultatsFactures[0]->nom_client?> <?= $lesResultatsFactures[0]->prenom_client?>" placeholder="Nom du 
                                client" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br />
    </form>
        <div class="row">
            <div class="col-md-12" style="padding=0.5em;">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group col-md">
                        <div class="input-group mb-2">
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
                                        <td>
                                            <form action="./?action=modification_element_facture" method="POST"> 
                                                <input name="id_production" type="hidden" value="<?php echo $value->id_production; ?>"></input>
                                                <input name="id_facture" type="hidden" value="<?php echo $value->id_facture; ?>"></input>
                                                <input width="30" height="30" type="image" src="image/edit.png"></input>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="" method="POST"> 
                                                <input name="action" type="hidden" value="delete"></input>
                                                <input name="id_production" type="hidden" value="<?php echo $value->id_production; ?>"></input>
                                                <input name="id_facture" type="hidden" value="<?php echo $value->id_facture; ?>"></input>
                                                <input width="30" height="30" type="image" src="image/delete.png"></input>
                                            </form>
                                        </td>
                                    </tr>

                                <?php } ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <div style="margin-top: 1em;">
            <input name="modification_factures" type="submit" class="btn btn-primary btn-lg btn-block" 
            value="Modifier la facture"></input>
        </div>
        
        
</div>
</main>

<?php include "./vue/v_footer.php"; ?>