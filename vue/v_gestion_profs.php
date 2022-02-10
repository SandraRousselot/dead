<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Gestion des professeurs</h1>
        <a href="./?action=ajout_prof">
        <img alt="Nouvelle production" src="./image/ajout_client.png" width="40" height="40">
        </a>
      </div>
      <table class="table">
  <thead>
    <tr>
      <th scope="col">Numéro</th>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php   foreach($LesResultatsProfs as $LeResultatProf){ ?>
<tr >
      <td><?= $LeResultatProf->id; ?></td>
      <td><?= $LeResultatProf->nom; ?></td>
      <td><?= $LeResultatProf->prenom; ?></td>
      <td>
          <form action="./?action=modification_prof" method="POST"> 
          <input name="id" type="hidden" value="<?php echo $LeResultatProf->id; ?>"></input>
          <input width="30" height="30" type="image" src="image/edit.png">
         </form>
         </td>
         <td>
          <form action="" method="POST"> 
          <input name="action" type="hidden" value="deleteProf"></input>
          <input name="id" type="hidden" value="<?php echo $LeResultatProf->id; ?>"></input>
          <input width="30" height="30" type="image" src="image/delete.png"></input>
         </form>
       </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
    </main>

  

    <?php include "./vue/v_footer.php"; ?>