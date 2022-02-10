<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Modification d'un élément de la facture n°<?= $_POST['id_facture']; ?></h1>
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
                        <h2 class="card-title">Produit à modifier dans la facture</h2>
                        <br />
                            <div class="form-group">
                                <input name="id" type="hidden" value="<?= $_POST['id']; ?>"></input>
                                <label for="nom" class="col-form-label">Nom</label>
                                <input name="nom" type="text" class="form-control" value="<?= $leProfAModifier->nom; ?>" id="nom" placeholder="Nom du professeur" onkeydown="if(event.keyCode==32) return false;">
                                <label for="prenom" class="col-form-label">Prénom</label>
                                <input name="prenom" type="text" class="form-control" value="<?= $leProfAModifier->prenom; ?>" id="prenom" placeholder="Prénom du professeur" onkeydown="if(event.keyCode==32) return false;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 1em;">
            <input name="modif_prof" type="submit" class="btn btn-primary btn-lg btn-block" value="Modifier un professeur"></input>
        </div>
        </form>
        
</div>
</main>

<?php include "./vue/v_footer.php"; ?>