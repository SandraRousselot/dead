<?php
// reference the Dompdf namespace
use Dompdf\Dompdf;

require_once 'dompdf/autoload.inc.php';

// instantiate and use the dompdf class
$dompdf = new Dompdf();

ob_start();
?>
<style>
table{
    width:100%;
    border-width:1px; 
    border-style:solid; 
    border-color:grey;
    padding:0.5%;
    border-collapse:collapse;
}
td{
    border-bottom:1px solid grey;
    width:50%;
    padding:0.5%;
    text-align:center;
}
th{
    
    width:50%;
    padding:1.5%;
}
p{
    font-size:60%;
}
h3{
    text-align:center;
}
</style>
<style>
    @page { margin: 180px 50px; }
    #header { position: fixed; left: 0px; top: -130px; right: 0px; height: 150px;}
    #footer { position: fixed; left: 0px; bottom: -270px; right: 0px; height: 150px;}
    #footer .page:after { content: counter(page, upper-roman); }
  </style>
<body>
  <div id="header">
  <h1><p><b>Lycée des métiers Jean Monnet</b></p>
<p>12 rue Louis Amstrong</p>
<p>87065 LIMOGES CEDEX</p>
<br/>
<p>Tél : 05 55 35 06 73</p>
<p>Mail : boutique.jean.monnet@gmail.com</p>
  </div>
  <div id="footer">
    <p class="page">Page </p>
  </div>
  <div id="content">
  <h3 class="card-title">Ordre de recette du <?= $date_debut; ?> au <?= $date_fin; ?></h3>

<table class="table">
<thead>
<tr>
<th scope="col">Date</th>
<th scope="col" style="width:25%;">Facture</th>
<th scope="col">Client</th>
<th scope="col">Ville</th>
<th scope="col" style="width:25%;">Montant</th>
<!--<th scope="col">Prix</th> -->
<th scope="col">Réglé le</th>
<th scope="col">Par</th>
</tr>
</thead>
<tbody>
<?php $sommeRegle = 0;
$somme = 0;
foreach($LesResultatsOrdreRecette as $LeResultatOrdreRecette){ 
 $somme += $LeResultatOrdreRecette->total; ?>
<tr class="table-<?php date("d-m-Y"); ?>">
<td><?= $LeResultatOrdreRecette->date; ?></td>
<td style="width:25%;"><?= $LeResultatOrdreRecette->id_facture; ?></td>
<td><?= $LeResultatOrdreRecette->nom; ?> <?= $LeResultatOrdreRecette->prenom; ?></td>
<td ><?= $LeResultatOrdreRecette->ville; ?></td>
<td style="width:25%;"><?= $LeResultatOrdreRecette->total; ?>€</td>
<?php if($LeResultatOrdreRecette->date_reglement == NULL){ ?>
<td></td>
<?php }else{ ?>
<td><?= $LeResultatOrdreRecette->date_reglement; ?></td>
<?php $sommeRegle += $LeResultatOrdreRecette->total;;
} ?>
<td><?= $LeResultatOrdreRecette->moyen_reglement; ?></td>
</tr>
<?php } 
foreach($LesResultatsOrdreRecetteDestruction as $LeResultatOrdreRecetteDestruction){ 
  $somme += $LeResultatOrdreRecetteDestruction->total;  ?>
<tr>
  <td><?= $LeResultatOrdreRecetteDestruction->date_destruction; ?></td>
  <td style="width:25%;"></td>
  <td>DESTRUCTION</td>
  <td></td>
  <td style="width:25%;"><?= $LeResultatOrdreRecetteDestruction->total; ?>€</td>
  <td></td>
  <td></td>
</tr>
<?php } foreach($LesResultatsOrdreRecetteTransfert as $LeResultatOrdreRecetteTransfert){ 
  $somme += $LeResultatOrdreRecetteTransfert->total;  ?>
<tr>
  <td><?= $LeResultatOrdreRecetteTransfert->date_transfert; ?></td>
  <td style="width:25%;"></td>
  <?php if($LeResultatOrdreRecetteTransfert->id_type_transfert == 1){ ?>
      <td>TRANSFERT ATELIER</td>
  <?php }else{ ?>
      <td>TRANSFERT SELF</td>
  <?php } ?>
  <td></td>
  <td style="width:25%;"><?= $LeResultatOrdreRecetteTransfert->total; ?>€</td>
  <td></td>
  <td></td>
</tr>
<?php } ?>
<tr>
  <td></td>
  <td style="font-weight:600; width:25%;"></td>
  <td style="font-weight:600;"></td>
  <td style="font-weight:600;">Total</td>
  <td style="font-weight:600; width:25%;"><?= $sommeRegle ?>€</td>
  <td></td>
  <td></td>
</tr>
</tbody>
</table>
  </div>
</body>





<?php

$nomFichier = "Ordre-Recette.pdf";
$html=ob_get_clean();

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream($nomFichier, Array('Attachment'=>0));
?>