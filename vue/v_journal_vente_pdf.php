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
<h3 class="card-title">Journal des ventes du <?= $date_debut; ?> au <?= $date_fin; ?></h3>

      <table class="table">
  <thead>
    <tr>
      <th scope="col" style="width:27%;">Facture</th>
      <th scope="col" style="width:27%;">Date</th>
      <th scope="col">Montant</th>
      <th scope="col">Client</th>
      <!--<th scope="col">Prix</th> -->
      <th scope="col">Réglé</th>
    </tr>
  </thead>
  <tbody>
  <?php $somme = 0;
  $sommeRegle = 0;
   foreach($LesResultatsJournalVentes as $LeResultatJournalVentes){ 
       $somme += $LeResultatJournalVentes->total; ?>
<tr class="table-<?php date("d-m-Y"); ?>">
      <td style="width:27%;"><?= $LeResultatJournalVentes->id_facture; ?></td>
      <td style="width:27%;"><?= $LeResultatJournalVentes->date; ?></td>
      <td><?= $LeResultatJournalVentes->total; ?>€</td>
      <td><?= $LeResultatJournalVentes->nom; ?> <?= $LeResultatJournalVentes->prenom; ?></td>
      <?php if($LeResultatJournalVentes->date_reglement == NULL){ ?>
      <td></td>
      <?php }else{ ?>
      <td><?= $LeResultatJournalVentes->total; ?>€</td>
      <?php $sommeRegle += $LeResultatJournalVentes->total;;
     } ?>
    </tr>
    <?php } 
    foreach($LesResultatsJournalVentesDestruction as $LeResultatJournalVentesDestruction){ 
        $somme += $LeResultatJournalVentesDestruction->total;  ?>
    <tr>
        <td style="width:27%;"></td>
        <td style="width:27%;"><?= $LeResultatJournalVentesDestruction->date_destruction; ?></td>
        <td><?= $LeResultatJournalVentesDestruction->total; ?>€</td>
        <td>DESTRUCTION</td>
        <td></td>
    </tr>
    <?php } foreach($LesResultatsJournalVentesTransfert as $LeResultatJournalVentesTransfert){ 
        $somme += $LeResultatJournalVentesTransfert->total;  ?>
    <tr>
        <td style="width:27%;"></td>
        <td style="width:27%;"><?= $LeResultatJournalVentesTransfert->date_transfert; ?></td>
        <td><?= $LeResultatJournalVentesTransfert->total; ?>€</td>
        <?php if($LeResultatJournalVentesTransfert->id_type_transfert == 1){ ?>
            <td>TRANSFERT ATELIER</td>
        <?php }else{ ?>
            <td>TRANSFERT SELF</td>
        <?php } ?>
        <td></td>
    </tr>
    <?php } ?>
    <tr>
        <td style="width:27%;"></td>
        <td style="font-weight:600; width:27%;">Total</td>
        <td style="font-weight:600;"><?= $somme ?>€</td>
        <td style="font-weight:600;">Total réglé</td>
        <td style="font-weight:600;"><?= $sommeRegle ?>€</td>
    </tr>
  </tbody>
  </table>
  </div>
</body>



<?php
$nomFichier = "Journal-Ventes.pdf";

$html=ob_get_clean();

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();


// Output the generated PDF to Browser
$dompdf->stream($nomFichier, Array('Attachment'=>0));
?>