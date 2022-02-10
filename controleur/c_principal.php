<?php

function controleurPrincipal($action)
{
    $lesActions = [];
    $lesActions["defaut"] = "c_tableaudebord.php";
    $lesActions["accueil"] = "c_tableaudebord.php";
    $lesActions["connection"] = "c_connection.php";
    $lesActions["deconnection"] = "c_deconnection.php";
    $lesActions["inscription"] = "c_inscription.php";
    $lesActions["modification"] = "c_modification_utilisateur.php";
    $lesActions["catalogue"] = "c_catalogue.php";
    $lesActions["confirmation_transfert"] = "c_confirmation_transfert.php";
    $lesActions["nouvelle_production"] = "c_nouvelle_production.php";
    $lesActions["nouvelle_production_copy"] = "c_nouvelle_production_copy.php";
    $lesActions["confirmation_nouvelle_production"] = "c_confirmation_nouvelle_production.php";
    $lesActions["confirmation_nouvelle_vente"] = "c_confirmation_nouvelle_vente.php";
    $lesActions["clients"] = "c_clients.php";
    $lesActions["facturation"] = "c_facturation.php";
    $lesActions["nouvelle_vente"] = "c_nouvelle_vente.php";
    $lesActions["modification_production"] = "c_modification_production.php";
    $lesActions["modification_client"] = "c_modification_client.php";
    $lesActions["aide"] = "c_aide.php";
    $lesActions["bilan"] = "c_bilan.php";
    $lesActions["creation_bilan"] = "c_creation_bilan.php";
    $lesActions["bilan_semaine_pdf"] = "c_bilan_semaine_pdf.php";
    $lesActions["creation_journal_vente"] = "c_creation_journal_vente.php";
    $lesActions["journal_vente_pdf"] = "c_journal_vente_pdf.php";
    $lesActions["creation_ordre_recette"] = "c_creation_ordre_recette.php";
    $lesActions["ordre_recette_pdf"] = "c_ordre_recette_pdf.php";
    $lesActions["ajout_client"] = "c_ajout_client.php";
    $lesActions["creation_facture"] = "c_creation_facture.php"; 
    $lesActions["factures_client"] = "c_factures_client.php";  
    $lesActions["modification_facture"] = "c_modification_facture.php";  
    $lesActions["modification_element_facture"] = "c_modification_element_facture.php";  
    $lesActions["facture_pdf"] = "c_facture_pdf.php"; 
    //$lesActions["statistiques"] = "c_statistiques.php"; 
    $lesActions["statistiques_alternative"] = "c_statistiques_alternative.php"; 
    $lesActions["suppression_base_donnees"] = "c_suppression_base_donnees.php"; 
    $lesActions["confirmation_suppression_base_donnees"] = "c_confirmation_suppression_base_donnees.php";
    $lesActions["gestion_globale"] = "c_gestion_globale.php";
    $lesActions["suppression_clients"] = "c_suppression_clients.php";
    $lesActions["confirmation_suppression_clients"] = "c_confirmation_suppression_clients.php";
    $lesActions["gestion_moyen_paiement"] = "c_gestion_moyen_paiement.php";
    $lesActions["gestion_profs"] = "c_gestion_profs.php";
    $lesActions["gestion_classes"] = "c_gestion_classes.php";
    $lesActions["ajout_prof"] = "c_ajout_prof.php";
    $lesActions["modification_prof"] = "c_modification_prof.php";
    $lesActions["ajout_classe"] = "c_ajout_classe.php";
    $lesActions["modification_classe"] = "c_modification_classe.php";
    
    if (array_key_exists($action, $lesActions)) {
        return $lesActions[$action];
    } else {
        return $lesActions["defaut"];
    }

}
?>

 