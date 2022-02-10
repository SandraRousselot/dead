<?php

include_once("pdo.php");

/*
 * Fonction : Connection de l'utilisateur
 * Prermet de verifier si l'utilisateur peut se connecter avec son nom.prénom et son mot de passe
 *
 * @param nom $nom : Nom de l'utilisateur (nom.prénom)
 * @param mot_de_passe $mot_de_passe : Mot de passe de l'utilisateur
 * @return booleen $connectionApprouvee : Si "true" l'utilisateur peut se connecter
 */
 /// <summary>
 /// Vroum
 /// <summary/>
function ConnectionUtilisateur($nom, $mot_de_passe){

    $connectionApprouvee = false;
        $conn = connexionPDO();
          $chercherUser = $conn->prepare("SELECT * FROM utilisateur WHERE nom = ?");
          $chercherUser->execute(array($nom));

          if($chercherUser->rowCount() != 0){
              $ligne = $chercherUser->fetch(PDO::FETCH_OBJ);
     			if(password_verify($mot_de_passe, $ligne->mot_de_passe)){
                session_start();
                $_SESSION['user'] = $ligne;
                $connectionApprouvee = true;
                } 
            }
        return $connectionApprouvee;
}


/*
 * Fonction : Inscription de l'utilisateur
 * Permet de s'inscrire avec son nom.prénom et son mot de passe
 *
 * @param nom $nom : Nom de l'utilisateur (nom.prénom)
 * @param mot_de_passe $mot_de_passe : Mot de passe de l'utilisateur
 * @return booleen $connectionApprouvee : Si "true" l'utilisateur peut se connecter
 */

function InscriptionUtilisateur($nom, $mot_de_passe){

  try {
         $inscriptionUtilisateur = false;

         $cnx=ConnexionPDO();
         // 1) Hasher le mot de passe de l'utilisateur avec password_hash()
         $hash=password_hash($mot_de_passe,PASSWORD_BCRYPT); 

         $utilisateur_existe = $cnx->prepare("SELECT * FROM utilisateur WHERE nom = ?");
         $utilisateur_existe->execute(array($nom));

          if($utilisateur_existe->rowCount() == 0){
            $inscriptionUtilisateur=$cnx->prepare("INSERT INTO utilisateur VALUES (NULL, ?, ?, 1)"); 
            $inscriptionUtilisateur->execute(array($nom, $hash));
          }

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
  return $inscriptionUtilisateur;
}


/*
 * Fonction : Modification de l'utilisateur
 * Permet de modifier son nom.prénom et son mot de passe
 *
 * @param nom $nom : Nom de l'utilisateur (nom.prénom)
 * @param mot_de_passe $mot_de_passe : Mot de passe de l'utilisateur
 */

function ModificationUtilisateur($nom, $mot_de_passe){

  try {

  $cnx = connexionPDO();
  $ModificationUtilisateur= $cnx->prepare("UPDATE utilisateur SET nom = ?, mot_de_passe = ? WHERE id = ?");

  $ModificationUtilisateur->execute(array($nom, $mot_de_passe, $_SESSION['user']->id));

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
}


/*
 * Fonction : Modification du client
 * Permet de modifier son nom, prenom, catégorie, téléphone, mail et ville
 *
 * @param id $id : id
 * @param nom $nom : Nom
 * @param prenom $prenom : prenom
 * @param categorie $categorie : categorie
 * @param tel $nom : Nom
 * @param nom $nom : Nom
 * @param nom $nom : Nom
 */

 function ModificationClient($id, $nom, $prenom, $categorie, $tel, $mail, $ville){

  try {

  $cnx = connexionPDO();
  $ModificationClient= $cnx->prepare("UPDATE client SET nom = ?, prenom = ?, id_categorie = ?, telephone = ?,
   mail = ?, ville = ? WHERE id = ?");

  $ModificationClient->execute(array($nom, $prenom, $categorie, $tel, $mail, $ville, $id));

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
}


/*
 * Fonction : Modification Mode Reglement
 *
 */

 function ModificationModeReglement($id_mode_reglement, $id_facture){

  try {

  $cnx = connexionPDO();
  $ModificationModeReglement= $cnx->prepare("UPDATE facture SET id_moyen_reglement = ?, date_reglement = ?
   WHERE id = ?");

  $date_du_jour = date('Y-m-d');
  $ModificationModeReglement->execute(array($id_mode_reglement, $date_du_jour, $id_facture));

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
}


/*
 * Fonction : Recupération de la table
 *
 * @param table $table : Récupérère le nom de la table
 * @return tableau $stock : Retourne toutes les occurences de la table
 */

 function RecuperationOccurences($table){
  $stock= array();

  $cnx = connexionPDO();
  $RecuperationOccurences= $cnx->prepare("SELECT * FROM $table");
  $RecuperationOccurences->execute();
  $stock = $RecuperationOccurences->fetchAll(PDO::FETCH_OBJ);
  
  return $stock;
}

/*
 * Fonction : Recupération de la table
 *
 * @param table $table : Récupérère le nom de la table
 * @return tableau $stock : Retourne toutes les occurences de la table
 */

function AffichageProduits(){
  $stock= array();

  $cnx = connexionPDO();
  $RecuperationOccurences= $cnx->prepare("SELECT * FROM produit WHERE etat_affichage = ?");
  $RecuperationOccurences->execute(array(1));
  $stock = $RecuperationOccurences->fetchAll(PDO::FETCH_OBJ);
  
  return $stock;
}

/*
 * Fonction : Ajout d'une production
 * Permet d'ajouter une production
 *
 * @param classe $classe : classe
 * @param atelier $id_article : id de l'article
 * @param atelier $atelier : atelier de production
 * @param prof $id_prof : prof
 * @param temp $temperature : température de conservtionn
 * @param date $date_fabrication : date de fabrication
 * @param date_peremption $date_peremption : date de peremption
 * @param quantite $quantite : quantite
 * @param conditionnement $conditionnement : conditionnement
 */

 function AjoutProduction($classe, $id_produit, $id_atelier, $id_prof, $temperature, $date_fabrication, $date_peremption, $quantite, $conditionnement){

  try {

         $cnx=ConnexionPDO();
         $ajoutProd = $cnx->prepare("INSERT INTO production VALUES(NULL,?,?,?,?,?,?,?,?,?, NULL, ?)");
         $ajoutProd->execute(array($classe, $id_produit, $id_atelier, $id_prof, $temperature, $date_fabrication, $date_peremption, $quantite, $conditionnement, 1));
         
        } catch (PDOException $e) {
          print "Erreur !: " . $e->getMessage();
          die();
      }

}


/*
 * Fonction : Modification d'une production
 * Permet de modifier son nom, atelier, classe, prof, famille, date_fabric, date_peremption, quantite et stock
 *
 * @param id $id : id
 * @param nom $nom : Nom
 * @param atelier $atelier : atelier
 * @param classe $classe : classe
 * @param prof $prof : prof
 * @param famille $famille : famille
 * @param temp $temp : temp
 * @param date_fabric $date_fabric : date_fabric
 * @param date_peremption $date_peremption : date_peremption
 * @param quantite $quantite : quantite
 * @param stock $stock : stock
 */

 function ModificationProduction($id, $id_produit, $nom, $atelier, $classe, $prof, $famille, $temp, $date_fabric, 
 $date_peremption, $quantite, $stock){

  try {

  $cnx = connexionPDO();

  $ModificationProduction= $cnx->prepare("UPDATE production SET id_atelier = ?, id_classe = ?, 
  id_prof = ?, temperature = ?, date_fabrication = ?, date_peremption = ?, quantite = ?, 
  conditionnement = ? WHERE id = ?");

  $ModificationProduction->execute(array($atelier, $classe, $prof, $temp, $date_fabric, 
  $date_peremption, $quantite, $stock, $id));

  $ModificationProduit= $cnx->prepare("UPDATE produit SET denomination = ?, id_famille = ? WHERE id = ?");

  $ModificationProduit->execute(array($nom, $famille, $id_produit));

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
}


/*
 * Fonction : Ajout d'un produit
 * Permet d'ajouter une production
 *
 * @param id_famille $id_famille : id_famille
 * @param id_unite $id_unite : id_unite
 * @param nom $nom : désignation du produit
 * @param prix $prix : prix du produit
 */

function AjoutProduit($id_famille, $id_unite, $denomination, $prix){

  try {
    
         $cnx=ConnexionPDO();
         $ajoutProd = $cnx->prepare("INSERT INTO produit VALUES(NULL,?,?,?,?,?)");
         $ajoutProd->execute(array($id_famille, $id_unite, $denomination, $prix, 1));
         
        } catch (PDOException $e) {
          print "Erreur !: " . $e->getMessage();
          die();
      }

}



/*
 * Fonction : Page accessible que si l'utilisateur est connecté
 * Démarre la variable si cette dernière n'est pas lancé
 * Si la variable SESSION['user'] n'existe pas : redirection vers Connection
 */

function logged_only(){

   if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

  if(!isset($_SESSION['user'])){
    header('Location: ./?action=connection');
    exit();
  }
}

/*
 * Fonction : Page accessible que si l'utilisateur est déconnecté
 * Démarre la variable si cette dernière n'est pas lancé
 * Si la variable SESSION['user'] existe pas : redirection vers le panneau de bord
 */

function unlogged_only(){

  if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

 if(isset($_SESSION['user'])){
   header('Location: ./?action=defaut');
   exit();
 }
}


/*
 * Fonction : Actualise la variable SESSION['user']
 */

function actualiser_variable_session(){

  if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

 if(isset($_SESSION['user'])){

  $conn = connexionPDO();

  $chercherUser = $conn->prepare("SELECT * FROM utilisateur WHERE id = ?");

  $chercherUser->execute(array($_SESSION['user']->id));

  $ligne = $chercherUser->fetch(PDO::FETCH_OBJ);

  $_SESSION['user'] = $ligne;

 }
}


/*
 * Fonction : Affiche toutes les ventes
 *
 * @return tableau $resultat 
 */

 function AffichageFacturations($filtre = "facture.id DESC"){

  $resultat = array();
  try {

  $cnx = connexionPDO();
  $affichageFactures= $cnx->prepare("SELECT facture.id as id_facture, etat_annulation, `date`, client.nom as 
  nom_client, client.prenom as prenom_client, id_moyen_reglement
  FROM facture INNER JOIN client ON facture.id_client = client.id ORDER BY $filtre");

  $affichageFactures->execute();

  $resultat = $affichageFactures->fetchAll(PDO::FETCH_OBJ);

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
  return $resultat;
}


/*
 * Fonction : Affiche toutes les ventes non reglees
 *
 * @return tableau $resultat 
 */

 function AffichageFacturationsNonReglees($filtre = "facture.id DESC"){

  $resultat = array();
  try {

  $cnx = connexionPDO();
  $affichageFacturesNonReglees= $cnx->prepare("SELECT facture.id as id_facture, `date`, client.nom as 
  nom_client, client.prenom as prenom_client, id_moyen_reglement, etat_annulation
  FROM facture INNER JOIN client ON facture.id_client = client.id WHERE id_moyen_reglement = 0 AND etat_annulation = 0 ORDER BY $filtre");

  $affichageFacturesNonReglees->execute();

  $resultat = $affichageFacturesNonReglees->fetchAll(PDO::FETCH_OBJ);

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
  return $resultat;
}


/*
 * Fonction : Affiche toutes les ventes non reglees et en réservation
 *
 * @return tableau $resultat 
 */

function AffichageFacturationsNonRegleesEnReservation($filtre = "facture.id DESC"){

  $resultat = array();
  try {

  $cnx = connexionPDO();
  $AffichageFacturationsNonRegleesEnReservation= $cnx->prepare("SELECT facture.id as id_facture, `date`, client.nom as 
  nom_client, client.prenom as prenom_client, id_moyen_reglement, etat_annulation
  FROM  facture  INNER JOIN client ON facture.id_client = client.id WHERE id_moyen_reglement = 0 AND etat_annulation = 0 AND reservation =1 ORDER BY $filtre");

  $AffichageFacturationsNonRegleesEnReservation->execute();

  $resultat = $AffichageFacturationsNonRegleesEnReservation->fetchAll(PDO::FETCH_OBJ);

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
  return $resultat;
}




/*
 * Fonction : Affiche toutes les ventes
 *
 * @return tableau $resultat 
 */

 function AffichageFacturationsParIdClient($id_client, $filtre = "facture.id DESC"){

  $resultat = array();
  try {

  $cnx = connexionPDO();
  $AffichageFacturationsParIdClient= $cnx->prepare("SELECT facture.id as id_facture, etat_annulation, `date`, client.nom as 
  nom_client, client.prenom as prenom_client, id_moyen_reglement, total, client.id as id_client
  FROM facture INNER JOIN client ON facture.id_client = client.id WHERE client.id = ? ORDER BY $filtre");

  $AffichageFacturationsParIdClient->execute(array($id_client));

  $resultat = $AffichageFacturationsParIdClient->fetchAll(PDO::FETCH_OBJ);

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
  return $resultat;
}


/*
 * Fonction : Affiche tous les clients
 *
 * @return tableau $resultat 
 */

 function AffichageClients($filtre = "client.id"){

  $resultat = array();
  try {

  $cnx = connexionPDO();
  $affichageClients= $cnx->prepare("SELECT client.id, client.nom, prenom, telephone, ville, mail, categorie_client.nom as categorie
  FROM client INNER JOIN categorie_client ON categorie_client.id = client.id_categorie ORDER BY $filtre");

  $affichageClients->execute();

  $resultat = $affichageClients->fetchAll(PDO::FETCH_OBJ);

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
  return $resultat;
}


/*
 * Fonction : Affiche tous les clients par id
 *
 * @return tableau $resultat 
 */

 function AffichageClientsParId($id){

  try {

  $cnx = connexionPDO();
  $affichageClientsParId= $cnx->prepare("SELECT client.id, client.nom as nom_client, prenom, telephone, ville, mail, categorie_client.nom as nom_categorie, categorie_client.id as id_categorie
  FROM client INNER JOIN categorie_client ON categorie_client.id = client.id_categorie WHERE client.id = ?");

  $affichageClientsParId->execute(array($id));

  $resultat = $affichageClientsParId->fetch(PDO::FETCH_OBJ);

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
  return $resultat;
}


/*
 * Fonction : Ajout d'un client
 * Permet d'ajouter un client
 *
 * @param nom $nom : nom
 * @param prenom $prenom : prenom
 * @param ville $ville : ville
 * @param tel $tel : tel
 * @param mail $mail : mail
 * @param categorie $categorie : categorie
 */

 function AjoutClient($nom, $prenom, $ville, $tel, $mail, $categorie){

  try {

         $cnx=ConnexionPDO();
         $ajoutClient = $cnx->prepare("INSERT INTO client VALUES(NULL,?,?,?,?,?,?)");
         $ajoutClient->execute(array($nom, $prenom, $ville, $tel, $mail, $categorie));
         
        } catch (PDOException $e) {
          print "Erreur !: " . $e->getMessage();
          die();
      }

}


/*
 * Fonction : Affiche toutes les élèments de la table productions
 *
 * @return tableau $resultat 
 */

function AffichageProductions($filtre = "production.id"){

  $resultat = array();
  try {

  $cnx = connexionPDO();
  $affichageProductions= $cnx->prepare("SELECT production.date_fabrication, production.id as id_production, 
  production.date_peremption as date_peremption, atelier.nom as nom_atelier, conditionnement, 
  famille_produit.nom as nom_famille_produit, classe.nom as nom_classe, produit.denomination as nom_produit, 
  atelier.nom as nom_atelier, professeur.nom as nom_professeur, quantite, produit.prix, 
  production.etat_congelation as etat_congelation, produit.id as id_produit FROM production
   INNER JOIN classe ON production.id_classe = classe.id INNER JOIN produit ON production.id_produit = produit.id 
   INNER JOIN atelier ON production.id_atelier = atelier.id INNER JOIN famille_produit 
   ON produit.id_famille = famille_produit.id INNER JOIN professeur ON production.id_prof = professeur.id 
   WHERE production.etat_affichage = ? ORDER BY $filtre");

  $affichageProductions->execute(array(1));

  $resultat = $affichageProductions->fetchAll(PDO::FETCH_OBJ);

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
  return $resultat;
}


/*
 * Fonction : Affiche les élèments perimés et en DLC de la table productions
 *
 * @return tableau $resultat 
 */

function AffichageProductionsTableauDeBord(){

  $resultat = array();
  try {

  $cnx = connexionPDO();
  $affichageProductions= $cnx->prepare("SELECT production.date_fabrication, production.id as id_production, 
  production.date_peremption as date_peremption, atelier.nom as nom_atelier, conditionnement, 
  famille_produit.nom as nom_famille_produit, classe.nom as nom_classe, produit.denomination as nom_produit, 
  atelier.nom as nom_atelier, professeur.nom as nom_professeur, quantite, produit.prix, 
  production.etat_congelation as etat_congelation, produit.id as id_produit FROM production
   INNER JOIN classe ON production.id_classe = classe.id INNER JOIN produit ON production.id_produit = produit.id 
   INNER JOIN atelier ON production.id_atelier = atelier.id INNER JOIN famille_produit 
   ON produit.id_famille = famille_produit.id INNER JOIN professeur ON production.id_prof = professeur.id 
   WHERE production.etat_affichage = ?");

  $affichageProductions->execute(array(1));

  $resultat = $affichageProductions->fetchAll(PDO::FETCH_OBJ);

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
  return $resultat;
}


/*
 * Fonction : Affiche toutes les ventes lié à un ID production
 *
 * @return tableau $resultat 
 */

 function RecuperationVentesParIdProduction($id_production){
  $montantVente= array();

  $cnx = connexionPDO();
  $RecuperationVentesParIdProduction= $cnx->prepare("SELECT * FROM vente WHERE id_production = ?");
  $RecuperationVentesParIdProduction->execute(array($id_production));
  $montantVente = $RecuperationVentesParIdProduction->fetchAll(PDO::FETCH_OBJ);
  
  return $montantVente;
}


/*
 * Fonction : Affiche toutes les élèments d'une production en fonction de son id
 *
 * @param id @id : id de la production
 * @return $resultat 
 */

function AffichageProductionParId($id){


  try {

  $cnx = connexionPDO();
  $affichageProduction= $cnx->prepare("SELECT production.date_fabrication, production.id as id_production, production.date_peremption as date_peremption, atelier.nom as nom_atelier, conditionnement, 
  famille_produit.nom as nom_famille_produit,  famille_produit.id as id_famille_produit, classe.nom as nom_classe, classe.id as id_classe, produit.denomination as nom_produit, 
  atelier.nom as nom_atelier, atelier.id as id_atelier, unite.id as id_unite, unite.nom as nom_unite, professeur.nom as nom_professeur, professeur.id as id_professeur, quantite, temperature, produit.prix, production.etat_congelation as etat_production FROM production
   INNER JOIN classe ON production.id_classe = classe.id INNER JOIN produit ON production.id_produit= produit.id 
   INNER JOIN atelier ON production.id_atelier = atelier.id INNER JOIN famille_produit 
   ON produit.id_famille = famille_produit.id INNER JOIN professeur ON production.id_prof = professeur.id INNER JOIN unite ON
   produit.id_unite = unite.id
   WHERE production.id = ?");

  $affichageProduction->execute(array($id));

  $resultat = $affichageProduction->fetch(PDO::FETCH_OBJ);

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
  return $resultat;
}


/*
 * Fonction : Affiche toutes les élèments de la tables type_produit
 *
 * @return tableau $resultat : Si "true" l'utilisateur peut se connecter
 */

function RecuperationDesTypesProduits(){

  $resultat = array();
  try {

  $cnx = connexionPDO();
  $recuperationDesTypesProduits= $cnx->prepare("SELECT nom FROM type_produit");

  $recuperationDesTypesProduits->execute();

  $resultat = $recuperationDesTypesProduits->fetchAll(PDO::FETCH_OBJ);

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
  return $resultat;
}

/*
 * Fonction : Affiche toutes le prix en fonction du nom de la tables type_produit
 *
 * @param nom $nom : nom du type de produit
 * @return tableau $resultat 
 */

function RecherchePrixParTypeProduit($nom){

  try {

  $cnx = connexionPDO();
  $recherchePrixParTypeProduit= $cnx->prepare("SELECT prix, unite.nom as nom_unite FROM type_produit INNER JOIN unite ON unite.id = type_produit.id_unite WHERE type_produit.nom = ?");

  $recherchePrixParTypeProduit->execute(array($nom));

  $resultat = $recherchePrixParTypeProduit->fetch(PDO::FETCH_OBJ);

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
  return $resultat;
}

/*
 * Fonction : Récupère l'id d'un produit avec sa denomination
 *
 * @param nom $nom : nom du produit
 * @return  $resultat 
 */

function RecuperationProduit($nom){

  try {

  $cnx = connexionPDO();
  $rechercheIdProduit= $cnx->prepare("SELECT produit.denomination as nom_produit, unite.nom as nom_unite, prix, 
  produit.id as id_produit FROM produit INNER JOIN unite ON unite.id = produit.id_unite WHERE denomination = ? AND etat_affichage = ?");

  $rechercheIdProduit->execute(array($nom, 1));

  $resultat = $rechercheIdProduit->fetch(PDO::FETCH_OBJ);

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
  return $resultat;
}


/*
 * Fonction : Supprimer une client avec son id
 *
 * @param id $id_client : id de la client
 */

function SupprimerClient($id_client){

  try {

  $conn = connexionPDO();
  $SupprimerClient= $conn->prepare("DELETE FROM client WHERE id = ?");

  $SupprimerClient->execute(array($id_client));

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
}


/*
 * Fonction : Supprimer une client avec son id
 *
 * @param id $id_client : id de la client
 */

 function DetectionDoublonNomProduit($nom_produit, $classe){

  try {

  $cnx = connexionPDO();
  $DetectionDoublonNomProduit= $cnx->prepare("SELECT * FROM produit WHERE denomination = ? AND etat_affichage = ?");

  $DetectionDoublonNomProduit->execute(array($nom_produit, 1));

  $nombre_de_doublon = $DetectionDoublonNomProduit->rowCount();

  if($nombre_de_doublon > 0){
    $nom = $nom_produit . "-" . $classe;
  } else {
    $nom = $nom_produit;
  }

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }

  return $nom;
}


/*
 * Fonction : Permet d'augmenter de signaler que le produit est au congélateur
 * Ajoute +3 mois de date de péremption à partir de la date de fabrication
 *
 * @param id_production $id_production : Id de la production
 * @param date production $date_production : Date de production où l'on ajout +3 mois
 */

function MettreAuCongelateur($id_production, $date_production){

  try {

  $etat = 1; //etat 1 = congélateur 

//on calcule la nouvelle date de peremption
$nouvelle_date_peremption = date('d/m/Y', strtotime('+ 3 month', strtotime(str_replace('/', '-', $date_production))));

  $cnx = connexionPDO();
  $MettreAuCongelateur= $cnx->prepare("UPDATE production SET date_peremption = ?, etat_congelation = ? WHERE id = ?");
  $MettreAuCongelateur->execute(array($nouvelle_date_peremption, $etat, $id_production));

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
}



/*
 * Fonction : Permet de détuire une production
 * Nous changeons l'état affichage de produit et production
 *
 * @param id_production $id_production : Id de la production
 * @param date production $date_production : Date de production où l'on ajout +3 mois
 */

function DetruireUneProduction($id_production, $id_produit, $conditionnement){

  try {

    $cnx=ConnexionPDO();

    $date_destruction = date("Y-m-d");
    $recupPrix = $cnx->prepare("SELECT prix FROM produit WHERE id = ?");
    $recupPrix->execute(array($id_produit));
    $prix = $recupPrix->fetch(PDO::FETCH_OBJ);

    $insertionDestruction = $cnx->prepare("INSERT INTO destruction VALUES(NULL, ?, ?, ?, ?)");
    $insertionDestruction->execute(array($id_production, $conditionnement, $prix->prix, $date_destruction));

    $majAffichageProduction = $cnx->prepare("UPDATE production SET etat_affichage = ?, 
    conditionnement = ? WHERE id = ?");
    $majAffichageProduction->execute(array(0, 0, $id_production));

    $majAffichageProduit = $cnx->prepare("UPDATE produit SET etat_affichage = ? WHERE id = ?");
    $majAffichageProduit->execute(array(0, $id_produit));

    /*$DetruireUneProduction= $cnx->prepare("UPDATE production SET etat_affichage = ?, date_destruction = ? WHERE id = ?");
    $DetruireUneProduction->execute(array(0, $date_destruction, $id_production));
  

    $DetruireLeProduit= $cnx->prepare("UPDATE produit SET etat_affichage = ? WHERE id = ?");
    $DetruireLeProduit->execute(array(0, $id_produit));*/


   } catch (PDOException $e) {
     print "Erreur !: " . $e->getMessage();
     die();
 }

}


function RecupConditionnement($id_production){
  $resultat = array();
  $cnx = connexionPDO();
$RecupConditionnement = $cnx->prepare("SELECT conditionnement FROM production WHERE id = ?");
    $RecupConditionnement->execute(array($id_production));

    $resultat = $RecupConditionnement->fetch(PDO::FETCH_OBJ);
    return $resultat;
}
/*
 * Fonction : Permet de transferer une production
 * Nous changeons l'état affichage de produit et production
 *
 * @param id_production $id_production : Id de la production
 * @param date production $date_production : Date de production où l'on ajout +3 mois
 */

 function TransfererUneProduction($id_production, $id_produit, $quantite, $id_transfert, $conditionnement){

  try {

    $cnx=ConnexionPDO();

    $date_transfert = date("Y-m-d");

    $RecupPrix = $cnx->prepare("SELECT produit.prix FROM production INNER JOIN produit ON production.id_produit = produit.id WHERE production.id = ?");
    $RecupPrix->execute(array($id_production));
    $prix = $RecupPrix->fetch(PDO::FETCH_OBJ);

    $NouveauTransfert = $cnx->prepare("INSERT INTO transfert VALUES(NULL,?,?,?,?,?)");
    $NouveauTransfert->execute(array($id_production, $id_transfert, $quantite, $prix->prix, $date_transfert));

    $UpdateQuantite = $cnx->prepare("UPDATE production SET conditionnement = ? WHERE id = ?");
    $UpdateQuantite->execute(array(($conditionnement - $quantite), $id_production));


   } catch (PDOException $e) {
     print "Erreur !: " . $e->getMessage();
     die();
 }

}

/*
 * Fonction : Permet d'annuler la facture

 */

 function AnnulerUneFacture($id_facture){

  try {

    $cnx=ConnexionPDO();

    $date_transfert = date("Y-m-d");

    // $SelectionneLesVentesAAnnuler= $cnx->prepare("SELECT * FROM vente INNER JOIN facture ON vente.id_facture = facture.id WHERE id_facture = ?");
    // $SelectionneLesVentesAAnnuler->execute(array($id_facture));
    
    $PasseLesQuantiteAZero = $cnx->prepare("UPDATE vente INNER JOIN facture ON facture.id = vente.id_facture SET quantite = 0, prix_total = 0 WHERE facture.id = ?");
    $PasseLesQuantiteAZero->execute(array($id_facture));
    
        

    $AnnulerLaFacture= $cnx->prepare("UPDATE facture SET etat_annulation = ? WHERE id = ?");
    $AnnulerLaFacture->execute(array(1, $id_facture));


   } catch (PDOException $e) {
     print "Erreur !: " . $e->getMessage();
     die();
 }

}

/*
 * Fonction : Permet de mettre l'etat d'une production et d'un produit à false
 * Nous changeons l'état affichage de produit et production
 */

function ProduitAZeroStock($id_production, $id_produit){

  try {

    $cnx=ConnexionPDO();


    $AfficherUneProduction= $cnx->prepare("UPDATE production SET etat_affichage = ? WHERE id = ?");
    $AfficherUneProduction->execute(array(0, $id_production));
  

    $AfficherUnProduit= $cnx->prepare("UPDATE produit SET etat_affichage = ? WHERE id = ?");
    $AfficherUnProduit->execute(array(0, $id_produit));


   } catch (PDOException $e) {
     print "Erreur !: " . $e->getMessage();
     die();
 }
}


/*
 * Fonction : Crée une nouvelle vente ainsi qu'une facture associé
 *
 * @param nomprenom $nomprenomclient : nom et prenom du client compilé
 * @return $resul$resultatrecupIdFacture->id : l'id facture
 */

function NouvelleVente($nomprenomclient, $quantite, $produits, $prix_produit_de_base, $prix_total_produit, 
$total, $reservation){

  try {

  $cnx = connexionPDO();

  // DECOUPAGE CLIENT NOM/PRENOM RECUPERATION DES INFO CLIENTS
  $prenom_nom_tableau = explode(" ", $nomprenomclient); // [0] : nom, [1] : prenom

  $rechercheClientParNomEtPrenom= $cnx->prepare("SELECT * FROM client WHERE nom = ? AND prenom = ?");

  $rechercheClientParNomEtPrenom->execute(array($prenom_nom_tableau[0], $prenom_nom_tableau[1]));

  $resultatNomEtPrenom = $rechercheClientParNomEtPrenom->fetch(PDO::FETCH_OBJ);
  
  // FIN DECOUPAGE CLIENT NOM/PRENOM RECUPERATION DES INFO CLIENTS
  // INSERT INTO FACTURE : CREATION D'UNE FACTURE
  
  $ajoutFacture = $cnx->prepare("INSERT INTO facture VALUES(NULL, ?, ?, ?, NULL, ?, 0, ?)");

  $ajoutFacture->execute(array(0, $resultatNomEtPrenom->id, date('Y-m-d'), $total, $reservation));

  // FIN INSERT INTO FACTURE : CREATION D'UNE FACTURE
  // RECUPERATION DE L'ID DE LA DERNIERE FACTURE ENREGISTRER
  $recupIdFacture = $cnx->prepare("SELECT id FROM facture WHERE id_client = ? 
  ORDER BY id DESC LIMIT 1");
  
  $recupIdFacture->execute(array($resultatNomEtPrenom->id));

  $resultatrecupIdFacture = $recupIdFacture->fetch(PDO::FETCH_OBJ);
  // FIN  RECUPERATION DE L'ID DE LA DERNIERE FACTURE ENREGISTRER

  
  // INSERT INTO VENTE AVEC ID FACTURE
  $i = count($produits)-1;
  while($i >= 0){


    // RECUPERATION DE L'ID PRODUCTION AVEC LES ID PRODUITS
  $recupIdProduction = $cnx->prepare("SELECT production.id as id_production FROM produit INNER JOIN 
    production ON production.id_produit = produit.id WHERE production.id_produit = ?");

  $recupIdProduction->execute(array($produits[$i]));
  $resultatRecupIdProduction = $recupIdProduction->fetch(PDO::FETCH_OBJ);

    // FIN RECUPERATION DE L'ID PRODUCTION AVEC LES ID PRODUITS
    // AJOUT D'UNE VENTE AVEC L'ID FACTURE PRECEDEMMENT CREEE
  $ajoutVente = $cnx->prepare("INSERT INTO vente VALUES(?, ?, ?, ?, ?)");

  $ajoutVente->execute(array($resultatrecupIdFacture->id, $resultatRecupIdProduction->id_production, 
  $quantite[$i], $prix_produit_de_base[$i], $prix_total_produit[$i]));

    // FIN AJOUT D'UNE VENTE AVEC L'ID FACTURE PRECEDEMMENT CREEE

  $i--;
  }
  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
  return $resultatrecupIdFacture->id;
}


/*
 * Fonction : affiche une facture
 *
 * @param nomprenom $nomprenomclient : nom et prenom du client compilé
 * @return $resultatrecupIdFacture->id : l'id facture
 */
  function AffichageFacture($id_facture){
    
    $resultat = array();

    try{

      $cnx = connexionPDO();
    
      $affichageFacture= $cnx->prepare("SELECT etat_annulation, mode_reglement.nom as nom_mode_reglement,
       facture.id as id_facture, client.nom as nom_client, client.prenom as prenom_client, client.ville 
       as ville_client, facture.date as date_facturation, produit.denomination as denomination_produit,
       production.quantite as nb_portions, facture.id_moyen_reglement as id_moyen_reglement,
       production.date_peremption as DLC, vente.quantite as quantite, vente.prix_unitaire as 
       prix_unitaire, vente.prix_total as prix_produit_total, facture.total as total_facture, 
       reservation, production.id as id_production
      FROM vente INNER JOIN facture 
      ON vente.id_facture = facture.id INNER JOIN client 
      ON facture.id_client = client.id INNER JOIN mode_reglement 
      ON facture.id_moyen_reglement = mode_reglement.id INNER JOIN production 
      ON vente.id_production = production.id INNER JOIN produit 
      ON production.id_produit = produit.id
      WHERE facture.id = ?");
    
      $affichageFacture->execute(array($id_facture));

      $resultat = $affichageFacture->fetchAll(PDO::FETCH_OBJ);

    } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
    }
    return $resultat;
  }
  

  /*
 * Fonction : Affiche la production en fonction de l'id du produit
 *
 */

  function AffichageProductionAvecIdProduit($id_produit){
        
    try{

      $cnx = connexionPDO();
    
      $affichageFacture= $cnx->prepare("SELECT production.id as id_production, conditionnement FROM production INNER JOIN produit
      ON produit.id = production.id_produit WHERE produit.id = ?");
    
      $affichageFacture->execute(array($id_produit));

      $resultat = $affichageFacture->fetch(PDO::FETCH_OBJ);

    } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
    }
    return $resultat;
  }

  

 /*
 * Fonction : Recupère le nom de la classe en fonction de l'id
 *
 */

function RecuperationNomClassParId($id_classe){
        
  try{

    $cnx = connexionPDO();
  
    $RecuperationNomClassParId = $cnx->prepare("SELECT * FROM classe WHERE id = ?");
  
    $RecuperationNomClassParId->execute(array($id_classe));

    $resultat = $RecuperationNomClassParId->fetch(PDO::FETCH_OBJ);

  } catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage();
    die();
  }
  return $resultat;
}


 /*
 * Fonction : maj bd
 *
 */
function MiseAJourBaseDonnees(){
  $cnx = connexionPDO();

  $SuppressionBDProduit = $cnx->prepare("TRUNCATE TABLE `produit`");

  $SuppressionBDProduit->execute();

  $SuppressionBDProduction = $cnx->prepare("TRUNCATE TABLE `production`");

  $SuppressionBDProduction->execute();

  $SuppressionBDFacture = $cnx->prepare("TRUNCATE TABLE `facture`");

  $SuppressionBDFacture->execute();

  $SuppressionBDVente = $cnx->prepare("TRUNCATE TABLE `vente`");

  $SuppressionBDVente->execute();

  $SuppressionBDTransfert = $cnx->prepare("TRUNCATE TABLE `transfert`");

  $SuppressionBDTransfert->execute();

  $SuppressionBDDestruction = $cnx->prepare("TRUNCATE TABLE `destruction`");

  $SuppressionBDDestruction->execute();
}

/*
 * Fonction : maj clients
 *
 */
function MiseAJourBaseDonneesClients(){
  $cnx = connexionPDO();

  $SuppressionClientBD = $cnx->prepare("TRUNCATE TABLE `client`");

  $SuppressionClientBD->execute();
}

/*
 * Fonction : afficher profs
 *
 */
function AfficherProfesseur(){
  $cnx = connexionPDO();

  $AfficherProfesseur = $cnx->prepare("SELECT id, nom, prenom FROM professeur");

  $AfficherProfesseur->execute();

  $affiche = $AfficherProfesseur->fetchAll(PDO::FETCH_OBJ);

  return $affiche;
}


/*
 * Fonction : ajout prof
 *
 */
function AjoutProfesseur($nom,$prenom){
  $cnx = connexionPDO();

  $AjoutProfesseur = $cnx->prepare("INSERT INTO professeur VALUES(NULL,?,?)");

  $AjoutProfesseur->execute(array($nom, $prenom));
}

/*
 * Fonction : Modification du Prof
 * Permet de modifier son nom et son prenom
 *
 * @param id $id : id
 * @param nom $nom : Nom
 * @param prenom $prenom : prenom
 */

function ModificationProf($id, $nom, $prenom){

  try {

  $cnx = connexionPDO();
  $ModificationProf= $cnx->prepare("UPDATE professeur SET nom = ?, prenom = ? WHERE id = ?");

  $ModificationProf->execute(array($nom, $prenom, $id));

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
}

/*
 * Fonction : Affiche tous les Profs par id
 *
 * @return tableau $resultat 
 */

function AffichageProfsParId($id){

  try {

  $cnx = connexionPDO();
  $affichageProfsParId= $cnx->prepare("SELECT id, nom, prenom FROM professeur WHERE id = ?");

  $affichageProfsParId->execute(array($id));

  $resultat = $affichageProfsParId->fetch(PDO::FETCH_OBJ);

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
  return $resultat;
}

/*
 * Fonction : Supprimer une client avec son id
 *
 * @param id $id_client : id de la client
 */

function SupprimerProf($id){

  try {

  $conn = connexionPDO();
  $SupprimerProf= $conn->prepare("DELETE FROM professeur WHERE id = ?");

  $SupprimerProf->execute(array($id));

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
}

/*
 * Fonction : afficher classes
 *
 */
function AfficherClasses(){
  $cnx = connexionPDO();

  $AfficherProfesseur = $cnx->prepare("SELECT id, nom FROM classe");

  $AfficherProfesseur->execute();

  $affiche = $AfficherProfesseur->fetchAll(PDO::FETCH_OBJ);

  return $affiche;
}

/*
 * Fonction : ajout prof
 *
 */
function AjoutClasse($nom){
  $cnx = connexionPDO();

  $AjoutClasse = $cnx->prepare("INSERT INTO classe VALUES(NULL,?)");

  $AjoutClasse->execute(array($nom));
}

/*
 * Fonction : Modification de la classe
 * Permet de modifier son nom 
 *
 * @param id $id : id
 * @param nom $nom : Nom
 */

function ModificationClasse($id, $nom){

  try {

  $cnx = connexionPDO();
  $ModificationClasse= $cnx->prepare("UPDATE classe SET nom = ? WHERE id = ?");

  $ModificationClasse->execute(array($nom, $id));

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
}

/*
 * Fonction : Affiche tous les Profs par id
 *
 * @return tableau $resultat 
 */

function AffichageClassesParId($id){

  try {

  $cnx = connexionPDO();
  $AffichageClassesParId= $cnx->prepare("SELECT id, nom FROM classe WHERE id = ?");

  $AffichageClassesParId->execute(array($id));

  $resultat = $AffichageClassesParId->fetch(PDO::FETCH_OBJ);

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
  return $resultat;
}

/*
 * Fonction : Supprimer une client avec son id
 *
 * @param id $id_client : id de la client
 */

function SupprimerClasse($id){

  try {

  $conn = connexionPDO();
  $SupprimerClasse= $conn->prepare("DELETE FROM classe WHERE id = ?");

  $SupprimerClasse->execute(array($id));

  } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
  }
}


/*
 * Fonction : afficher les 3 clients les plus fidèles
 */
function ClientsLesPlusFideles(){
  $resultatClientFidele = array();
  try {
  $cnx = connexionPDO();
  $ClientsLesPlusFideles = $cnx->prepare("SELECT nom, prenom,  COUNT(facture.id) as nombreAchats 
  FROM client INNER JOIN facture ON client.id = facture.id_client WHERE date_reglement 
  IS NOT NULL GROUP BY id_client ORDER BY nombreAchats DESC LIMIT 3");
  $ClientsLesPlusFideles->execute();
  $resultatClientFidele = $ClientsLesPlusFideles->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
  print "Erreur !: " . $e->getMessage();
  die();
}
  return $resultatClientFidele;
}

function ChiffreAffaireParAtelier($date_debut, $date_fin){
$cnx = connexionPDO();
      $RecuperationOccurences= $cnx->prepare("SELECT total_atelier.id,nom, SUM(prix_total) 
      as prix_total FROM total_atelier INNER JOIN facture ON facture.id = 
      total_atelier.id_facture WHERE date_reglement between ? and ? GROUP BY 
      total_atelier.id");
      $RecuperationOccurences->execute(array($date_debut, $date_fin));
      $resultat = $RecuperationOccurences->fetchAll(PDO::FETCH_OBJ);
      return $resultat;
}

function ChiffreAffaireParAtelierNonRegle($date_debut, $date_fin){
      $cnx = connexionPDO();
      $RecuperationOccurencesNonPaye= $cnx->prepare("SELECT atelier.nom as nom, prix_total 
      FROM atelier right JOIN production on atelier.id = production.id_atelier RIGHT JOIN 
      vente ON production.id = vente.id_production RIGHT JOIN facture ON vente.id_facture 
      = facture.id WHERE facture.id_moyen_reglement=0  AND facture.date BETWEEN ? AND ? GROUP BY atelier.id ORDER BY 
      atelier.id ");
      $RecuperationOccurencesNonPaye->execute(array($date_debut, $date_fin));
      $resultatNonPaye = $RecuperationOccurencesNonPaye->fetchAll(PDO::FETCH_OBJ);
      return $resultatNonPaye;
}

function ChiffreAffaireParTypeReglement($date_debut, $date_fin){
    $cnx = connexionPDO();
    $RecuperationOccurencesTypeReglement= $cnx->prepare("SELECT mode_reglement.nom ,
    SUM(vente.prix_total) AS prix_total_par_mode_reglement FROM vente RIGHT JOIN facture 
    ON vente.id_facture = facture.id RIGHT JOIN mode_reglement ON facture.id_moyen_reglement 
    = mode_reglement.id WHERE facture.date BETWEEN ? AND ? GROUP BY mode_reglement.id 
    ORDER BY mode_reglement.id ");
    $RecuperationOccurencesTypeReglement->execute(array($date_debut, $date_fin));
    $resultatTypeReglement = $RecuperationOccurencesTypeReglement->fetchAll(PDO::FETCH_OBJ);
      return $resultatTypeReglement;
}

function ChiffreAffaireParClasse($date_debut, $date_fin){
  $cnx = connexionPDO();
  $RecuperationOccurencesClasse= $cnx->prepare("SELECT classe.nom ,SUM(vente.prix_total) 
  AS prix_total_par_classe FROM facture Left JOIN vente ON vente.id_facture = facture.id 
  RIGHT JOIN production ON vente.id_production = production.id RIGHT JOIN classe ON 
  production.id_classe = classe.id WHERE date_reglement BETWEEN ? AND ? GROUP BY classe.id 
  ORDER BY classe.id");
  $RecuperationOccurencesClasse->execute(array($date_debut, $date_fin));
  $resultatClasse = $RecuperationOccurencesClasse->fetchAll(PDO::FETCH_OBJ);
    return $resultatClasse;
}

/*function Destruction($date_debut, $date_fin){
  $cnx = connexionPDO();
  
  $RecuperationLeNombreDeProduitsVendus= $cnx->prepare("SELECT DISTINCT produit.id as 
id_produit FROM vente INNER JOIN production ON production.id = vente.id_production 
INNER JOIN produit ON production.id_produit = produit.id INNER JOIN facture ON 
vente.id_facture = facture.id WHERE date_destruction IS NOT NULL AND date_reglement 
IS NOT NULL AND date_reglement BETWEEN ? AND ?");

$RecuperationLeNombreDeProduitsVendus->execute(array($date_debut, $date_fin));
$calculDestruction = 0;
while($resultat = $RecuperationLeNombreDeProduitsVendus->fetch(PDO::FETCH_OBJ)){
// pour récupérer l'id du produit : $resultat->id_produit
$RecuperationConditionnement= $cnx->prepare("SELECT conditionnement FROM production 
INNER JOIN vente ON vente.id_production = production.id INNER JOIN facture ON 
vente.id_facture = facture.id WHERE id_produit = ? AND date_reglement BETWEEN ? AND ?");
$RecuperationConditionnement->execute(array($resultat->id_produit, $date_debut, $date_fin));
$RecuperationConditionnementResultat = $RecuperationConditionnement->fetch(PDO::FETCH_OBJ);

$CalculNbVentes= $cnx->prepare("SELECT SUM(vente.quantite) as quantite_vendue FROM vente 
INNER JOIN facture ON vente.id_facture = facture.id INNER JOIN production ON 
vente.id_production = production.id WHERE id_produit = ? AND date_reglement BETWEEN ? AND ?");
$CalculNbVentes->execute(array($resultat->id_produit, $date_debut, $date_fin));
$CalculNbVentesResulat = $CalculNbVentes->fetch(PDO::FETCH_OBJ);

$RecuperationPrixUnitaire= $cnx->prepare("SELECT prix FROM produit INNER JOIN production ON 
produit.id = production.id_produit INNER JOIN vente ON vente.id_production = production.id 
INNER JOIN facture ON vente.id_facture = facture.id WHERE produit.id = ? AND date_reglement 
BETWEEN ? AND ?");
$RecuperationPrixUnitaire->execute(array($resultat->id_produit, $date_debut, $date_fin));
$RecuperationPrixUnitaireResultat = $RecuperationPrixUnitaire->fetch(PDO::FETCH_OBJ);

$calculDestruction = $calculDestruction + (($RecuperationConditionnementResultat->conditionnement 
- $CalculNbVentesResulat->quantite_vendue) * $RecuperationPrixUnitaireResultat->prix);
}
return $calculDestruction; 
}*/

function CalculTransferts($type_transfert, $date_debut, $date_fin){
  $cnx = connexionPDO();
  $CalculTransferts= $cnx->prepare("SELECT SUM(prix*quantite) AS prix_par_type_transfert 
  FROM transfert WHERE id_type_transfert = ? AND date_transfert BETWEEN ? AND ?");
  $CalculTransferts->execute(array($type_transfert, $date_debut, $date_fin));
  $resultatPrixTransfert = $CalculTransferts->fetch(PDO::FETCH_OBJ);
    return $resultatPrixTransfert; 
}

function CalculDestruction($date_debut, $date_fin){
  $cnx = connexionPDO();
  $CalculDestruction= $cnx->prepare("SELECT SUM(prix*quantite) AS prix_destruction 
  FROM destruction WHERE date_destruction BETWEEN ? AND ?");
  $CalculDestruction->execute(array($date_debut, $date_fin));
  $resultatPrixTransfert = $CalculDestruction->fetch(PDO::FETCH_OBJ);
    return $resultatPrixTransfert; 
}

function PrixParAtelier($id_atelier, $date_debut, $date_fin){
  $cnx = connexionPDO();
  $total = 0;
  $ventes = $cnx->prepare("SELECT SUM(prix_total) AS ventes_total FROM facture INNER JOIN 
  vente ON facture.id = vente.id_facture INNER JOIN production ON vente.id_production = 
  production.id WHERE id_atelier = ? AND `date` BETWEEN ? AND ?");
  $ventes->execute(array($id_atelier, $date_debut, $date_fin));
  $resultatventes = $ventes->fetch(PDO::FETCH_OBJ);

  if($resultatventes == NULL){
    $resultatventes = 0;
  }

  $destruction = $cnx->prepare("SELECT SUM(prix*destruction.quantite) AS destruction_total FROM destruction 
  INNER JOIN production ON destruction.id_production = production.id WHERE id_atelier = ? 
  AND `date_destruction` BETWEEN ? AND ?");
  $destruction->execute(array($id_atelier, $date_debut, $date_fin));
  $resultatdestruction = $destruction->fetch(PDO::FETCH_OBJ);

  if($resultatdestruction == NULL){
    $resultatdestruction = 0;
  }

  $transfert = $cnx->prepare("SELECT SUM(prix*transfert.quantite) AS transfert_total FROM transfert 
  INNER JOIN production ON transfert.id_production = production.id WHERE id_atelier = ? 
  AND `date_transfert` BETWEEN ? AND ?");
  $transfert->execute(array($id_atelier, $date_debut, $date_fin));
  $resultattransfert = $transfert->fetch(PDO::FETCH_OBJ);

  if($resultattransfert == NULL){
    $resultattransfert = 0;
  }


  $total = $resultatventes->ventes_total + $resultatdestruction->destruction_total + $resultattransfert->transfert_total ;
    return $total; 
}

function PrixParModePaiement($id_mode_paiement, $date_debut, $date_fin){
  $cnx = connexionPDO();
  $PrixParModePaiement= $cnx->prepare("SELECT SUM(prix_total) AS prix_total FROM facture 
  INNER JOIN vente ON facture.id = vente.id_facture WHERE id_moyen_reglement = ? AND `date` 
  BETWEEN ? AND ? ");
  $PrixParModePaiement->execute(array($id_mode_paiement, $date_debut, $date_fin));
  $resultatPrixParModePaiement = $PrixParModePaiement->fetch(PDO::FETCH_OBJ);
    return $resultatPrixParModePaiement; 
}

function JournalVente($date_debut, $date_fin){
  $cnx = connexionPDO();
  $JournalVente= $cnx->prepare("SELECT facture.id as id_facture, `date`, total, nom, prenom, 
  date_reglement FROM facture INNER JOIN client ON facture.id_client = client.id AND `date` 
  BETWEEN ? AND ? ORDER BY id_facture ");
  $JournalVente->execute(array($date_debut, $date_fin));
  $resultatJournalVente = $JournalVente->fetchAll(PDO::FETCH_OBJ);
    return $resultatJournalVente; 
}

function JournalVenteDestruction($date_debut, $date_fin){
  $cnx = connexionPDO();
  $JournalVenteDestruction= $cnx->prepare("SELECT date_destruction, (quantite*prix) as total FROM 
  destruction WHERE date_destruction BETWEEN ? AND ? ");
  $JournalVenteDestruction->execute(array($date_debut, $date_fin));
  $resultatJournalVenteDestruction = $JournalVenteDestruction->fetchAll(PDO::FETCH_OBJ);
    return $resultatJournalVenteDestruction; 
}

function JournalVenteTransfert($date_debut, $date_fin){
  $cnx = connexionPDO();
  $JournalVenteTransfert= $cnx->prepare("SELECT date_transfert, (quantite*prix) as total, 
  id_type_transfert FROM transfert WHERE date_transfert BETWEEN ? AND ? ");
  $JournalVenteTransfert->execute(array($date_debut, $date_fin));
  $resultatJournalVenteTransfert = $JournalVenteTransfert->fetchAll(PDO::FETCH_OBJ);
    return $resultatJournalVenteTransfert; 
}

function OrdreRecette($date_debut, $date_fin){
  $cnx = connexionPDO();
  $OrdreRecette= $cnx->prepare("SELECT facture.id as id_facture, `date`, total, client.nom as nom, prenom, ville,
  date_reglement, mode_reglement.nom as moyen_reglement FROM mode_reglement INNER JOIN facture ON mode_reglement.id = 
  facture.id_moyen_reglement INNER JOIN client ON facture.id_client = client.id AND `date` 
  BETWEEN ? AND ? ORDER BY id_facture ");
  $OrdreRecette->execute(array($date_debut, $date_fin));
  $resultatOrdreRecette = $OrdreRecette->fetchAll(PDO::FETCH_OBJ);
    return $resultatOrdreRecette; 
}

function OrdreRecetteDestruction($date_debut, $date_fin){
  $cnx = connexionPDO();
  $OrdreRecetteDestruction= $cnx->prepare("SELECT date_destruction, (quantite*prix) as total FROM 
  destruction WHERE date_destruction BETWEEN ? AND ? ");
  $OrdreRecetteDestruction->execute(array($date_debut, $date_fin));
  $resultatOrdreRecetteDestruction = $OrdreRecetteDestruction->fetchAll(PDO::FETCH_OBJ);
    return $resultatOrdreRecetteDestruction; 
}

function OrdreRecetteTransfert($date_debut, $date_fin){
  $cnx = connexionPDO();
  $OrdreRecetteTransfert= $cnx->prepare("SELECT date_transfert, (quantite*prix) as total, 
  id_type_transfert FROM transfert WHERE date_transfert BETWEEN ? AND ? ");
  $OrdreRecetteTransfert->execute(array($date_debut, $date_fin));
  $resultatOrdreRecetteTransfert = $OrdreRecetteTransfert->fetchAll(PDO::FETCH_OBJ);
    return $resultatOrdreRecetteTransfert; 
}

function ModifierElementFacture($id_facture, $id_production, $qte, $prix_unitaire){
  try{
  $cnx = connexionPDO();
  $ModifierElementFacture= $cnx->prepare("UPDATE vente SET quantite = ? , prix_unitaire = ? , 
  prix_total = (quantite * prix_unitaire) WHERE id_facture = ? AND id_production = ?");
  $ModifierElementFacture->execute(array($qte, $prix_unitaire, $id_facture, $id_production));

  } catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage();
    die();
  }
}

function SupprimerElementFacture($id_facture, $id_production){
  try{
    $cnx = connexionPDO();
    $SupprimerElementFacture= $cnx->prepare("DELETE FROM vente WHERE id_facture = ? AND 
    id_production = ?");;
    $SupprimerElementFacture->execute(array($id_facture, $id_production));
  
    } catch (PDOException $e) {
      print "Erreur !: " . $e->getMessage();
      die();
    }
}