<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nouvelle production</h1>
    </div>
    <?php
// if(isset($_POST['envoyer'])){
//  $resultat = implode(',', array_column(json_decode($_POST['tags']), 'value'));
//  echo $resultat;

?>

<script> var variable = <?php echo json_encode($stack); ?>; </script>

    <div class="container" style="margin-top: 1em;">
    <!-- Sign up form -->
    <form action="./?action=confirmation_nouvelle_production" method="POST">
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
                                <input name="nom" type="text" class="form-control" id="nom_produit" placeholder="Nom du produit" required>
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
                        <?php foreach($lesResultatsAteliers as $leResultatAtelier){ ?>
                                <option value="<?= $leResultatAtelier->id; ?>"><?= $leResultatAtelier->nom; ?></option>
                            <?php } ?>
                        </select>
                        <br />
                        <!-- Choix de la classe -->
                    <label for="classe" class="col-form-label">Classe</label>
                        <select name="classe" class="form-control">
                        <?php foreach($lesResultatsClasses as $leResultatClasse){ ?>
                                <option value="<?= $leResultatClasse->id; ?>"><?= $leResultatClasse->nom; ?></option>
                            <?php } ?>
                        </select>
                        <br />
                        <!-- Choix du professeur -->
                    <label for="prof" class="col-form-label">Professeur</label>
                        <select name="prof" class="form-control">
                        <?php foreach($lesResultatsProfesseurs as $leResultatProfesseur){ ?>
                                <option value="<?= $leResultatProfesseur->id; ?>"><?= $leResultatProfesseur->nom; ?> <?= $leResultatProfesseur->prenom; ?></option>
                            <?php } ?>
                        </select>
                        <br />
                    <!-- Choix de la famille de produit -->
                    <label for="famille" class="col-form-label">Famille du produit</label>
                        <select name="famille" class="form-control">
                        <?php foreach($lesResultatsFamillesProduits as $leResultatFamilleProduit){ ?>
                                <option value="<?= $leResultatFamilleProduit->id; ?>"><?= $leResultatFamilleProduit->nom; ?></option>
                            <?php } ?>
                        </select>
                        <br />
                    <!-- Composition pour calcul du prix -->
                    <label for="tel" class="col-form-label">Composition</label>
                    <input name='tags' class='form-group' placeholder='Composition' value='' of Objects)></input>
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
                        <input name="temperature" class="form-control" type="number" value="1" id="example-number-input">
                        <div class="input-group-append">
                            <span class="input-group-text">°C</span>
                        </div>
                    </div>
                    <br />
                    <!-- Choix de la date de fabrication -->
                    <label for="tel" class="col-form-label">Date de fabrication</label>
                        <div class="col-12">
                            <input name="date_fabric" class="form-control" type="date" value="<?= date('Y-m-d') ?>">
                        </div>
                        <br />
                    <!-- Choix du nombre de jours de conservtion -->
                    <label for="conserv" class="col-form-label">Nombre de jours de conservation</label>
                        <div class="col-12">
                            <input name="conserv" class="form-control" type="number" value="1" id="example-number-input">
                        </div>
                        <br />
                    <!-- Choix de la quantité par contenant -->
                    <label for="qte" class="col-form-label">Quantité par contenant</label>
                        <div class="input-group">
                        <input name="quantite" class="form-control" type="number" value="1" id="example-number-input">
                        <div class="input-group-append">
                            <span class="input-group-text">
                            <select name="unite" class="form-control">
                        <?php foreach($lesResultatsUnites as $leResultatUnite){ ?>
                                <option value="<?= $leResultatUnite->id; ?>"><?= $leResultatUnite->nom; ?></option>
                            <?php } ?>
                        </select></span>
                        </div>
                    </div>
                        <br />
                        <!-- Choix du nombre de contenants en stock -->
                    <label for="stock" class="col-form-label">Quantité de contenant en stock</label>
                        <div class="col-12">
                            <input name="stock" class="form-control" type="number" value="1" id="example-number-input">
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
            <input name="nouvelle_prod" type="submit" class="btn btn-primary btn-lg btn-block" value="Ajouter un produit"></input>
        </div>
        </form>
        
</div>
</main>

<?php include "./vue/v_footer.php"; ?>