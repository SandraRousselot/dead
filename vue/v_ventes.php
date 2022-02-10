<?php include "./vue/v_header.php"; ?>
 
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Ventes</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        <a class="btn btn-primary" href="./?action=nouvelle_production" role="button">Ajouter un vente</a>

        </div>
      </div>
      <table class="table">
  <thead>
    <tr>
      <th scope="col">Date de vente</th>
      <th scope="col">Client</th>
      <th scope="col">Produit</th>
      <th scope="col">Quantité vendue</th>

    </tr>
  </thead>
  <tbody>
  <?php foreach($lesResultatsVentes as $leResultatVente){ ?>
    <tr class="table-<?php date("d-m-Y"); ?>">
      <td><?= $leResultatVente->nom; ?></td>
      <td><?= $leResultatVente->prenom; ?></td>
      <td><?= $leResultatVente->categorie; ?></td>
      <td><?= $leResultatVente->telephone ; ?></td>
      <td><?= $leResultatVente->mail ; ?></td>
      <td><?= $leResultatVente->ville ; ?></td>
      <td><input class="btn btn-primary" type="submit" value="FACTURES"></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
    </main>

  

<?php include "./vue/v_footer.php"; ?>