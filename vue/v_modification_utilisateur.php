<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Modifier le compte</h1>
    </div>
    
<form action="" method="POST">
<div class="row">
  <div class="col-6">
  <div class="card bg-light mb-3" style="max-width">
  <div class="card-header">Modifier votre nom d'utilisateur</div>
  <div class="card-body">
  <div class="form-group">

          <div class="col-xs-4">
          <input name="nom" type="text" value="<?= $_SESSION['user']->nom; ?>" placeholder="nom.prénom" class="form-control input-md" >
          <br />
          <input name="modifierNom" type="submit" value="Modifier mon nom" class="btn btn-primary"></input>
          </div>
        </div>
  </div>
</div>
</div>
  
  <div class="col-6">
  <div class="card bg-light mb-3" style="max-width">
  <div class="card-header">Modifier le mot de passe</div>
  <div class="card-body">
  <div class="form-group">
          <div class="col-xs-4">
            <input name="mot_de_passe" type="password" placeholder="Votre nouveau mot de passe" class="form-control input-md">
           <br /> 
            <input name="modifierMotdepasse" type="submit" value="Modifier mon mot de passe" class="btn btn-primary"></input>
          </div>
        </div>
  </div>
</div>
</div>
</div>
</form>
</main>
<?php include "./vue/v_footer.php"; ?>