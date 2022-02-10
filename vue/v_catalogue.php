<?php include "./vue/v_header.php"; ?>
 
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Catalogue : les productions</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        <a href="./?action=nouvelle_production">
        <img alt="Nouvelle production" src="./image/nouvelle_production.png" width="40" height="40">
        </a>
         &nbsp;&nbsp;
        <a href="./?action=nouvelle_vente">
        <img alt="Nouvelle vente" src="./image/nouvelle_vente.png" width="45" height="45">
        </a>
        &nbsp;&nbsp;

        <form action="" method="POST">
        <select onchange="this.form.submit()" name="filtre" class="form-control" >
            <option value="production.id">Trier par</option>
            <option value="famille_produit.nom">Famille</option>
            <option value="famille_produit.nom DESC">Famille ~</option>
            <option value="produit.denomination">Désignation</option>
            <option value="produit.denomination DESC">Désignation ~</option>
            <option value="produit.prix">Prix</option>
            <option value="produit.prix DESC">Prix ~</option>
            <option value="quantite">Portions</option>
            <option value="quantite DESC">Portions ~</option>
            <option value="atelier.nom">Atelier</option>
            <option value="atelier.nom DESC">Atelier ~</option>
        </select>
        </form>
        </div>
      </div>
      <table class="table">
  <thead>
    <tr>
      <th scope="col">Famille</th>
      <th scope="col">Désignation</th>
      <th scope="col">Portions</th>
      <th scope="col">Stock</th>
      <th scope="col">Prix</th>
      <th scope="col">Atelier</th>
      <th scope="col">DLC</th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>



    </tr>
  </thead>
  <tbody>
  <?php foreach($lesResultatsProductions as $leResultatProduction){

    $date_peremption = strtotime(str_replace('/', '-', $leResultatProduction->date_peremption));
    $date_du_jour = strtotime(date("d-m-Y"));
  

    $interval = date_diff(date_create(str_replace('/', '-', $leResultatProduction->date_peremption)), date_create(date("d-m-Y")));
    

  if($leResultatProduction->etat_congelation != 1 ){
   if($date_peremption == $date_du_jour){
      $type = "warning";
    }else if($date_peremption > $date_du_jour){
      $type = "success";
    } else if($date_peremption < $date_du_jour){
      $type = "danger";
    }
  } else if($date_peremption < $date_du_jour){
    $type = "danger";
  } else if($date_peremption == $date_du_jour){
    $type = "warning";
  }else{
    $type = "info";
  }
     ?>
    <tr class="table-<?=$type?>">
    <?php if($leResultatProduction->etat_congelation == 1){ ?>
      <td><input width="15" height="15" type="image" src="image/congelateur.png">&nbsp;<?= $leResultatProduction->nom_famille_produit; ?></td>
      <?php } else { ?>
        <td><?= $leResultatProduction->nom_famille_produit; ?></td>
      <?php } ?>
      <td><?= $leResultatProduction->nom_produit; ?></td>
      <td><?= $leResultatProduction->quantite; ?></td>

      <?php
     $lesResultatsVentes = RecuperationVentesParIdProduction($leResultatProduction->id_production);
    $conditionnement = $leResultatProduction->conditionnement;
     foreach($lesResultatsVentes as $leResultatVente){ 
      
      $conditionnement = $conditionnement - $leResultatVente->quantite;
      } ?>

      <td><?= $conditionnement ?></td>

      <td><?= $leResultatProduction->prix ; ?> €</td>
      <td><?= $leResultatProduction->nom_atelier ; ?></td>
      <?php if($date_peremption < $date_du_jour){ ?>
        <td><?= $interval->format('- %a jours'); ?></td>
      <?php } else { ?>
       <td><?= $interval->format('+ %a jours'); ?></td>
       <?php } ?>
      <td>
          <form action="?action=modification_production" method="POST"> 
          <input name="id" type="hidden" value="<?php echo $leResultatProduction->id_production; ?>"></input>
          <input name="id_produit" type="hidden" value="<?php echo $leResultatProduction->id_produit; ?>"></input>
          <input width="30" height="30" type="image" src="image/edit.png">
         </form>
       </td>
      <td>
          <form action="" method="POST"> 
          <input name="id_produit" type="hidden" value="<?php echo $leResultatProduction->id_produit; ?>"></input>
          <input name="destruire" type="hidden" value="<?php echo $leResultatProduction->id_production; ?>"></input>
          <input width="30" height="30" type="image" alt="Envoyer à la destruction" src="image/poubelle.png">
         </form>
       </td>
       <td>
       <form action="?action=confirmation_transfert" method="POST"> 
          <input name="id_produit" type="hidden" value="<?php echo $leResultatProduction->id_produit; ?>"></input>
          <input name="transferer" type="hidden" value="<?php echo $leResultatProduction->id_production; ?>"></input>
          <input width="30" height="30" type="image" src="image/transfert.png">
         </form>
       </td>
       <td>
       <?php if($leResultatProduction->etat_congelation != 1){ ?>
          <form action="" method="POST"> 
          <input name="date_fabrication" type="hidden" value="<?php echo $leResultatProduction->date_fabrication; ?>"></input>
          <input name="congelateur" type="hidden" value="<?php echo $leResultatProduction->id_production; ?>"></input>
          <input width="30" height="30" type="image" src="image/congelateur.png">
         </form>
       </td>

    <?php } ?>
      </tr>
    <?php } ?>

    
  </tbody>
</table>
    </main>

  <!-- small modal -->
<div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Transfert</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" align="center">
          <form action="" method="POST"> 
          <input  type="number" step="any" name="quantite" class="quantite form-control" oninput="calculate()" value="1"/>
          </br>
          <input name="id_produit" type="hidden" value="<?php echo $leResultatProduction->id_produit; ?>"></input>
          <input name="transfert" type="hidden" value="<?php echo $leResultatProduction->id_production; ?>"></input>
          <button type="submit" name="transfert_ou" value="2"><img width="45" height="45" src="image/transfert_self.png" alt="Transfert Self"></button>&nbsp;&nbsp;&nbsp;&nbsp;
          <button type="submit" name="transfert_ou" value="1"><img width="45" height="45" src="image/transfert_atelier.png" alt="Transfert Atelier"></button>&nbsp;&nbsp;&nbsp;&nbsp;
          <br /><br />
          <div class="alert alert-primary" role="alert">
          <img width="20" height="20" src="image/transfert_self.png" alt="Transfert Self">: Transfert Self
          <br />
          <img width="20" height="20" src="image/transfert_atelier.png" alt="Transfert Atelier">: Transfert Atelier
          </div>
         </form>                 
       </div>

    </div>
  </div>
</div>

<?php include "./vue/v_footer.php"; ?>