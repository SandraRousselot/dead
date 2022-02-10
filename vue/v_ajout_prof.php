<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Ajout d'un Professeur</h1>
    </div>
    <div class="alert alert-warning" role="alert">
Le nom ne doit pas contenir d'espace.
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
                                <label for="nom" class="col-form-label">Nom</label>
                                <input name="nom" type="text" class="form-control" id="nom" placeholder="Nom du professeur" onkeydown="if(event.keyCode==32) return false;">
                                <label for="prenom" class="col-form-label">Prénom</label>
                                <input name="prenom" type="text" class="form-control" id="nom" placeholder="Prénom du professeur" onkeydown="if(event.keyCode==32) return false;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-top: 1em;">
            <input name="ajout_prof" type="submit" class="btn btn-primary btn-lg btn-block" value="Ajouter un professeur"></input>
        </div>
        </form>
        
</div>
</main>
<script src='./script/no_space.js'></script>
<?php include "./vue/v_footer.php"; ?>