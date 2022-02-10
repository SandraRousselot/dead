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
    padding:1%;
    border-collapse:collapse;
}
td{
    border-bottom:1px solid grey;
    width:50%;
    padding:1%;
    text-align:center;
}
th{
    
    width:50%;
    padding:1.5%;
}
h3{
    text-align:center;
}
</style>
<h3 class="card-title">Bilan du <?= $date_debut; ?> au <?= $date_fin; ?></h3>
<p><br/></p>

<table>
    <tr>
        <td>LYCEE-PATISSERIE</td>
        <td><?= round($lyceePatisserie, 2); ?>€</td>
    </tr>
    <tr>
        <td>LYCEE CHARCUTIER-TRAITEUR</td>
        <td><?= round($charcuterieTraiteur, 2); ?>€</td>
    </tr>
    <tr>
        <td>LYCEE BOUCHERIE</td>
        <td><?= round($boucherie, 2); ?>€</td>
    </tr>
    <tr>
        <td>LYCEE-CUISINE</td>
        <td><?= round($cuisineLycee, 2); ?>€</td>
    </tr>
    <tr>
        <td>EMBALLAGES</td>
        <td><?= round($emballages, 2); ?>€</td>
    </tr>
    <tr>
        <td style="font-weight:500;">SOUS-TOTAL LYCEE</td>
        <td style="font-weight:500;"><?= round($sousTotalLycee, 2); ?>€</td>
    </tr>
    <tr>
        <td>SOUS-TOTAL GRETA</td>
        <td><?= round($GRETA, 2); ?>€</td>
    </tr>
    <tr>
        <td>SOUS-TOTAL CFA</td>
        <td><?= round($CFA, 2); ?>€</td>
    </tr>
    <tr>
        <th>TOTAL VENTES SEMAINE</td>
        <th><?= round($totalVenteSemaineDeux, 2); ?>€</td>
    </tr>
</table>
<p><br/></p>
<table>
    <tr>
        <td>ESPECE</td>
        <td><?= round($liquide->prix_total, 2); ?>€</td>
    </tr>
    <tr>
        <td>CHEQUE</td>
        <td><?= round($cheque->prix_total, 2); ?>€</td>
    </tr>
    <tr>
        <td>CARTE BLEUE</td>
        <td><?= round($carteBleue->prix_total, 2); ?>€</td>
    </tr>
    <tr>
        <td>VALORISATION DESTRUCTION</td>
        <td><?= round($destruction->prix_destruction, 2); ?>€</td>
    </tr>
    <tr>
        <td>TRANSFERT ATELIER</td>
        <td><?= round($atelier->prix_par_type_transfert, 2); ?>€</td>
    </tr>
    <tr>
        <td>TRANSFERT SELF</td>
        <td><?= round($self->prix_par_type_transfert, 2); ?>€</td>
    </tr>
    <tr>
        <td>FACTURES NON REGLEES</td>
        <td><?= round($nonPaye->prix_total, 2); ?>€</td>
    </tr>
    <tr>
        <th>TOTAL VENTES SEMAINE</td>
        <th><?= round($totalVenteSemaineDeux, 2); ?>€</td>
    </tr>
</table>
           


<?php


$html=ob_get_clean();

$nomFichier = "Bilan-Semaine.pdf";

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();
// Output the generated PDF to Browser
$dompdf->stream($nomFichier, Array('Attachment'=>0));
?>