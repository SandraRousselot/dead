<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Gestion des moyens de paiement</h1>

        
      </div>
      <table class="table">
  <thead>
    <tr>
      <th scope="col">Numéro</th>
      <th scope="col">Nom</th>
    </tr>
  </thead>
  <tbody>
  <?php   foreach($lesResultatsMoyenPaiement as $leResultatMoyenPaiement){ ?>
    <tr>
      <td><?= $leResultatMoyenPaiement->id; ?></td>
      <td><?= $leResultatMoyenPaiement->nom; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
    </main>
    <?php include "./vue/v_footer.php"; ?>