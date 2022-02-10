<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Aide</h1>
    </div>

    <div class="alert alert-primary" role="alert">
  Retrouvez des aides concernant les outils présent sur le site en fonction de chaque page !
</div>
<div class="card">
  <div class="card-header">
  Catalogue 
  </div>
  <div class="card-body">
    <h5 class="card-title">L'onglet <a href="./?action=catalogue" class="lien">catalogue</a> va permettre de répertorier l'ensemble des productions.</h5></br>
    <img style="width:50px; height:auto; display:inline" src="image/nouvelle_production.png" alt="" >&nbsp;&nbsp;&nbsp;
    <p class="card-text" style="display:inline">Ce bouton permettra l'ajout d'une nouvelle production.</p>
    <br /><br />
    <img style="width:50px; height:auto; display:inline" src="image/nouvelle_vente.png" alt="" >&nbsp;&nbsp;&nbsp;
    <p class="card-text" style="display:inline">Ce bouton permettra de créer une nouvelle vente.</p>
    <br /><br />
    <img style="width:50px; height:auto; display:inline" src="image/edit.png" alt="" >&nbsp;&nbsp;&nbsp;
    <p class="card-text" style="display:inline">Ce bouton permettra de modifier une production.</p>
    <br /><br />
    <img style="width:50px; height:auto; display:inline" src="image/delete.png" alt="" >&nbsp;&nbsp;&nbsp;
    <p class="card-text" style="display:inline">Ce bouton permettra de détruire une production.</p>
    <br /><br />
    <img style="width:50px; height:auto; display:inline" src="image/congelateur.png" alt="" >&nbsp;&nbsp;&nbsp;
    <p class="card-text" style="display:inline-block">Ce bouton permettra de mettre une production au congèlateur, 
    ce qui ajoutera automatiquement 3 mois de conservation après la date de création.<br />Si cette image se 
    trouve au début de la colone famille, cela voudra dire que le produit est déjà au congèlateur.</p>
    <br /><br />
    <img style="width:50px; height:auto; display:inline" src="image/transfert.png" alt="" >&nbsp;&nbsp;&nbsp;
    <p class="card-text" style="display:inline-block">Ce bouton permettra de transferer la production.</p>
    <br /><br />
    <img style="width:50px; height:auto; display:inline" src="image/transfert_self.png" alt="" >&nbsp;&nbsp;&nbsp;
    <p class="card-text" style="display:inline-block">Ce bouton permettra de transferer la production vers le self.</p>
    <br /><br />
    <img style="width:50px; height:auto; display:inline" src="image/transfert_atelier.png" alt="" >&nbsp;&nbsp;&nbsp;
    <p class="card-text" style="display:inline-block">Ce bouton permettra de transferer la production vers un atelier.</p>
  </div>
</div>
<br />
<div class="card">
  <div class="card-header">
  Clients 
  </div>
  <div class="card-body">
    <h5 class="card-title">L'onglet <a href="./?action=clients" class="lien">clients</a> va permettre de répertorier l'ensemble des clients.</h5></br>
    <img style="width:50px; height:auto; display:inline" src="image/ajout_client.png" alt="" >&nbsp;&nbsp;&nbsp;
    <p class="card-text" style="display:inline-block">Ce bouton permettra d'ajouter un client.</p>
    <br /><br />
    <img style="width:50px; height:auto; display:inline" src="image/bouton_factures.png" alt="" >&nbsp;&nbsp;&nbsp;
    <p class="card-text" style="display:inline-block">Ce bouton permettra d'afficher toutes les factures du client concerné.</p>
    <br /><br />
    <img style="width:50px; height:auto; display:inline" src="image/edit.png" alt="" >&nbsp;&nbsp;&nbsp;
    <p class="card-text" style="display:inline">Ce bouton permettra de modifier un client.</p>
    <br /><br />
    <img style="width:50px; height:auto; display:inline" src="image/delete.png" alt="" >&nbsp;&nbsp;&nbsp;
    <p class="card-text" style="display:inline">Ce bouton permettra de supprimer un client.</p>
    <br /><br />
    <img style="width:50px; height:auto; display:inline" src="image/boutons_factures_client.png" alt="" >&nbsp;&nbsp;&nbsp;
    <p class="card-text" style="display:inline">Ces boutons permettront d'afficher la facture concernée.</p>
    <br /><br />
  </div>
</div>
<br />
<div class="card">
  <div class="card-header">
  Factures 
  </div>
  <div class="card-body">
    <h5 class="card-title">L'onglet <a href="./?action=facturation" class="lien">factures</a> va permettre d'afficher la totalité des factures.</h5></br>
    <img style="width:50px; height:auto; display:inline" src="image/boutons_factures_client.png" alt="" >&nbsp;&nbsp;&nbsp;
    <p class="card-text" style="display:inline">Ces boutons permettront d'afficher la facture concernée.</p>
    <br /><br />
    <img style="width:50px; height:auto; display:inline" src="image/bouton-reglement-facture.png" alt="" >&nbsp;&nbsp;&nbsp;
    <p class="card-text" style="display:inline">Ce bouton permettra de règler la facture.</p>
    <br /><br />
    <img style="width:50px; height:auto; display:inline" src="image/carte_bancaire.png" alt="" >&nbsp;&nbsp;&nbsp;
    <p class="card-text" style="display:inline">Ce bouton permettra de règler la facture par carte bancaire.</p>
    <br /><br />
    <img style="width:50px; height:auto; display:inline" src="image/cash.png" alt="" >&nbsp;&nbsp;&nbsp;
    <p class="card-text" style="display:inline">Ce bouton permettra de règler la facture en liquide.</p>
    <br /><br />
    <img style="width:50px; height:auto; display:inline" src="image/cheque.png" alt="" >&nbsp;&nbsp;&nbsp;
    <p class="card-text" style="display:inline">Ce bouton permettra de règler la facture par chèque.</p>
    <br /><br />
    <img style="width:50px; height:auto; display:inline" src="image/annuler_facture.png" alt="" >&nbsp;&nbsp;&nbsp;
    <p class="card-text" style="display:inline">Ce bouton permettra d'annuler la facture, ainsi son total sera de 0€.</p>
    <br /><br />
    <img style="width:50px; height:auto; display:inline" src="image/imprimer.png" alt="" >&nbsp;&nbsp;&nbsp;
    <p class="card-text" style="display:inline">Ce bouton permettra d'imprimer la facture ou de l'enregistrer sous format PDF.</p>
    <br /><br />
  </div>
</div>
<br />
<div class="card">
  <div class="card-header">
  Statistiques 
  </div>
  <div class="card-body">
    <h5 class="card-title">L'onglet <a href="./?action=statistiques" class="lien">statistiques</a> va permettre d'afficher toutes les statistiques importante de la boutique.</h5></br>
    <img style="width:50px; height:auto; display:inline" src="image/selection-par-date.png" alt="" >&nbsp;&nbsp;&nbsp;
    <p class="card-text" style="display:inline">Ce selecteur permettra de sélectionner les dates de début et de fin choisies pour les graphiques.</p>
    <br /><br />
  </div>
</div>
<br />
<div class="card">
  <div class="card-header">
  Catalogue 
  </div>
  <div class="card-body">
    <h5 class="card-title">Le catalogue va permettre de répertorier l'ensemble des production !</h5></br>
    <p class="card-text">Text explicatif</p>
  </div>
</div>
<br />
<div class="card">
  <div class="card-header">
  Catalogue 
  </div>
  <div class="card-body">
    <h5 class="card-title">Le catalogue va permettre de répertorier l'ensemble des production !</h5></br>
    <p class="card-text">Text explicatif</p>
  </div>
</div>
<br />


 




<?php include "./vue/v_footer.php"; ?>