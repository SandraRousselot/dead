<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Modification d'un client</h1>
    </div>
    <div class="alert alert-warning" role="alert">
Le nom et le prénom ne doivent pas contenir d'espace.
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
                        <h2 class="card-title">Coordonnées</h2>
                        <br />
                            <div class="form-group">
                                <input name="id" type="hidden" value="<?= $_POST['id']; ?>"></input>
                                <label for="nom" class="col-form-label">Nom</label>
                                <input name="nom" type="text" class="form-control" value="<?= $leClientAModifier->nom_client; ?>" id="nom" placeholder="Nom du client" onkeydown="if(event.keyCode==32) return false;">
                                <label for="prenom" class="col-form-label">Prénom</label>
                                <input name="prenom" type="text" class="form-control" value="<?= $leClientAModifier->prenom; ?>" id="prenom" placeholder="Prénom du client" onkeydown="if(event.keyCode==32) return false;">
                                <!-- Choix de la catégorie du client -->
                                <label for="categorie" class="col-form-label">Catégorie</label>
                                <select name="categorie" class="form-control">
                                <option value="<?= $leClientAModifier->id_categorie; ?>">Par défaut : <?= $leClientAModifier->nom_categorie; ?></option>
                                <?php foreach($lesResultatsCategories as $leResultatCategorie){ ?>
                                    <option value="<?= $leResultatCategorie->id; ?>"><?= $leResultatCategorie->nom; ?></option>
                                <?php } ?>
                                </select>
                                <label for="ville" class="col-form-label">Ville</label>
                                <input name="ville" type="text" class="form-control" value="<?= $leClientAModifier->ville; ?>" id="ville" placeholder="Ville du client" required> 
                                <label for="tel" class="col-form-label">Téléphone</label>
                                <input name="tel" type="text" class="form-control" value="<?= $leClientAModifier->telephone; ?>" id="tel" placeholder="Téléphone du client" >  
                                <label for="mail" class="col-form-label">Mail</label>
                                <input name="mail" type="mail" class="form-control" value="<?= $leClientAModifier->mail; ?>" id="mail" placeholder="Mail du client" >  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 1em;">
            <input name="modif_client" type="submit" class="btn btn-primary btn-lg btn-block" value="Modifier un client"></input>
        </div>
        </form>
        
</div>
</main>

<?php include "./vue/v_footer.php"; ?>