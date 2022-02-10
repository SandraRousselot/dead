<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Se connecter</h1>
    </div>
    
    <form action="" method="POST">

        <div class="form-group">
          <label class="col-md-4 control-label" for="nom">Nom d'utilisateur</label>
          <div class="col-md-4">
          <input name="nom" type="text" placeholder="nom.prénom" class="form-control input-md" required>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="mot_de_passe">Mot de passe</label>
          <div class="col-md-4">
            <input name="mot_de_passe" type="password" placeholder="Votre mot de passe" class="form-control input-md" required>
           <br /> 
            <input name="seConnecter" type="submit" value="Se connecter" class="btn btn-primary"></input>
          </div>
        </div>
        <br />
	    <p>S'inscrire ? <a href="./?action=inscription">Inscrivez-vous ici</a></p> 
    </form>
<br />

</main>
<?php include "./vue/v_footer.php"; ?>