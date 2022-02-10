<?php include "./vue/v_header.php"; ?>
 
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Clients</h1>
        <div class="btn-toolbar mb-2 mb-md-0">

        <a href="./?action=ajout_client">
        <img alt="Nouvelle production" src="./image/ajout_client.png" width="40" height="40">
        </a>
        &nbsp;&nbsp;
        <form action="" method="POST">
        <select onchange="this.form.submit()" name="filtre" class="form-control" >
            <option value="client.id">Trier par</option>
            <option value="categorie">Catégorie</option>
            <option value="categorie DESC">Catégorie ~</option>
            <option value="nom">Nom</option>
            <option value="nom DESC">Nom ~</option>
            <option value="prenom">Prénom</option>
            <option value="prenom DESC">Prénom ~</option>
            <option value="ville">Ville</option>
            <option value="ville DESC">Ville ~</option>
        </select>
        </form>        
        </div>
      </div>
      <table class="table">
  <thead>
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col">Catégorie</th>
      <th scope="col">Téléphone</th>
      <th scope="col">Mail</th>
      <th scope="col">Ville</th>
      <th scope="col">Facture</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($lesResultatsClients as $leResultatClient){ ?>
    <tr class="table-<?php date("d-m-Y"); ?>">
      <td><?= $leResultatClient->nom; ?></td>
      <td><?= $leResultatClient->prenom; ?></td>
      <td><?= $leResultatClient->categorie; ?></td>
      <td><?= $leResultatClient->telephone ; ?></td>
      <td><?= $leResultatClient->mail ; ?></td>
      <td><?= $leResultatClient->ville ; ?></td>
      <form action="./?action=factures_client" method="POST">
      <input name="id_client" type="hidden" value="<?php echo $leResultatClient->id; ?>"></input>
      <td><input class="btn btn-primary" type="submit" value="FACTURES"></td>
      </form>
      <td>
          <form action="./?action=modification_client" method="POST"> 
          <input name="id" type="hidden" value="<?php echo $leResultatClient->id; ?>"></input>
          <input width="30" height="30" type="image" src="image/edit.png">
         </form>
         </td>
         <td>
          <form action="" method="POST"> 
          <input name="action" type="hidden" value="delete"></input>
          <input name="id" type="hidden" value="<?php echo $leResultatClient->id; ?>"></input>
          <input width="30" height="30" type="image" src="image/delete.png"></input>
         </form>
       </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
    </main>

  

<?php include "./vue/v_footer.php"; ?>