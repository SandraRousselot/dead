<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 
border-bottom">
        <h1 class="h2">Modification d'une production</h1>
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
                        <h2 class="card-title">Nom du produit</h2>
                        <br />
                            <div class="form-group">
                                <input name="id" type="hidden" value="<?= $_POST['id']; ?>"></input>
                                <input name="id_produit" type="hidden" value="<?= $_POST['id_produit']; ?>"></input>

                                <input name="nom" type="text" class="form-control" id="nom_produit" 
                                value="<?= $laProductionAModifier->nom_produit ?>" placeholder="Nom du 
                                produit" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-6" style="padding=0.5em;">
                <div class="card">
                <div class="card-body">
                    <div class="form-group col-md">
                    <!-- Choix de l'atelier de fabrication -->
                    <label for="atelier" class="col-form-label">Atelier de fabrication</label>
                        <select name="atelier" class="form-control">
                        <option value="<?= $laProductionAModifier->id_atelier; ?>">Par défaut : 
                        <?= $laProductionAModifier->nom_atelier; ?></option>
                        <?php foreach($lesResultatsAteliers as $leResultatAtelier){ ?>
                                <option value="<?= $leResultatAtelier->id; ?>"><?= $leResultatAtelier->nom; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <br />
                        <!-- Choix de la classe -->
                    <label for="classe" class="col-form-label">Classe</label>
                        <select name="classe" class="form-control">
                        <option value="<?= $laProductionAModifier->id_classe; ?>">Par défaut : 
                        <?= $laProductionAModifier->nom_classe; ?></option>
                        <?php foreach($lesResultatsClasses as $leResultatClasse){ ?>
                                <option value="<?= $leResultatClasse->id; ?>"><?= $leResultatClasse->nom; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <br />
                        <!-- Choix du professeur -->
                    <label for="prof" class="col-form-label">Professeur</label>
                        <select name="prof" class="form-control">
                        <option value="<?= $laProductionAModifier->id_professeur; ?>">Par défaut : 
                        <?= $laProductionAModifier->nom_professeur; ?></option>
                        <?php foreach($lesResultatsProfesseurs as $leResultatProfesseur){ ?>
                                <option value="<?= $leResultatProfesseur->id; ?>">
                                <?= $leResultatProfesseur->nom; ?></option>
                            <?php } ?>
                        </select>
                        <br />
                    <!-- Choix de la famille de produit -->
                    <label for="famille" class="col-form-label">Famille du produit</label>
                        <select name="famille" class="form-control">
                        <option value="<?= $laProductionAModifier->id_famille_produit; ?>">Par défaut : 
                        <?= $laProductionAModifier->nom_famille_produit; ?></option>
                        <?php foreach($lesResultatsFamillesProduits as $leResultatFamilleProduit){ ?>
                                <option value="<?= $leResultatFamilleProduit->id; ?>">
                                <?= $leResultatFamilleProduit->nom; ?></option>
                            <?php } ?>
                        </select>
                        <br />

                    </div>
                </div>
                    <div class="form-group col-md-4">
                        <!-- tags a rajouter pour les ajouts de familles de produits -->
                    </div>
                </div>
                </div>
                <div class="col-md-6" style="padding=0.5em;">
                <div class="card">
                <div class="card-body">
                    <div class="form-group col-md">
                    <!-- Choix de la température de conservtion -->
                    <label for="temp" class="col-form-label">Température de conservation</label>
                    <div class="input-group">
                        <input name="temperature" class="form-control" type="number" 
                        value="<?= $laProductionAModifier->temperature ?>">
                        <div class="input-group-append">
                            <span class="input-group-text">°C</span>
                        </div>
                    </div>
                    <br />

                    <!-- Choix de la date de fabrication -->
                    <label for="date_fabric" class="col-form-label">Date de fabrication</label>
                        <div class="col-12">
                        <input name="date_fabric" class="form-control" type="date" 
                        value="<?= date('Y-m-d',strtotime(str_replace('/', '-', $laProductionAModifier->date_fabrication))) ?>">
                        </div>
                        <br />
                    <!-- Choix de la date de peremption -->
                    <label for="date_peremption" class="col-form-label">Date de peremption</label>
                        <div class="col-12">
                        <input name="date_peremption" class="form-control" type="date" 
                        value="<?= date('Y-m-d',strtotime(str_replace('/', '-', $laProductionAModifier->date_peremption)))?>">
                        </div>
                        <br />
                    <!-- Choix de la quantité par contenant -->
                    <label for="qte" class="col-form-label">Quantité par contenant</label>
                        <div class="input-group">
                        <input name="quantite" class="form-control" 
                        value="<?= $laProductionAModifier->quantite ?>" type="number" value="1">
                        <div class="input-group-append">
                            <span class="input-group-text">
                            <select name="unite" class="form-control">
                            <option value="<?= $laProductionAModifier->id_unite; ?>">
                            <?= $laProductionAModifier->nom_unite; ?></option>
                        <?php foreach($lesResultatsUnites as $leResultatUnite){ ?>
                                <option value="<?= $leResultatUnite->id; ?>"><?= $leResultatUnite->nom; ?>
                                </option>
                            <?php } ?>
                        </select></span>
                        </div>
                    </div>
                        <br />
                        <!-- Choix du nombre de contenants en stock -->
                    <label for="stock" class="col-form-label">Quantité restante</label>
                        <div class="col-12">
<?php
$lesResultatsVentes = RecuperationVentesParIdProduction($_POST['id']);
$conditionnement = $laProductionAModifier->conditionnement;
foreach($lesResultatsVentes as $leResultatVente){ 
 
 $conditionnement = $conditionnement - $leResultatVente->quantite;
 } 

// controle du stock 
   if($conditionnement <= 0){
     ProduitAZeroStock($leResultatProduction->id_production, $leResultatProduction->id_produit);
     header('Location: ?action=catalogue');
   }
 ?>  
                            <input name="stock" class="form-control" type="number" 
                            value="<?= $conditionnement ?>" >
                        </div>
                    </div>
                </div>
                    <div class="form-group col-md-4">
                        <!-- tags a rjouter pour les ajouts de familles de produits -->
                    </div>
                </div>
                </div>
        </div>
        <div style="margin-top: 1em;">
            <input name="modification_production" type="submit" class="btn btn-primary btn-lg btn-block" 
            value="Modifier la production"></input>
        </div>
        </form>
        
</div>
</main>

<?php include "./vue/v_footer.php"; ?>