<!doctype html>

<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Boutique Vente</title>

    <?php date_default_timezone_set('Europe/Paris');?>
    <!-- Bootstrap core CSS -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='./assets/tag/tagify.css'>
<link rel='stylesheet' href='./assets/tag/codepen.css'>
<link rel="stylesheet" href="./assets/tag/style.css">
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- JavaScript Bundle with Popper -->

    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  
  
  <ul class="navigation ">
    <li class="nav-link"  href=""><a href="./?action=defaut" id="gestion" >Boutique des Vente <h6 style="color:black; text-shadow:dimGray 1px 1px 1px;" >version 1.0</h6></a></li>
    
    <?php if(isset($_SESSION["user"])){
      actualiser_variable_session();
      ?>
      <li class="nav-link derouler" ><a href="">Mon compte</a>
        <ul class="sousnavigation ">
          <li class="nav-link"><a href="./?action=modification">Modifier mon compte</a></li>
          <li class="nav-link"><a href="./?action=deconnection">Déconnection</a></li>
          </ul>
      </li>
    <?php } else { ?>
      <li class="nav-link"><a href="./?action=connection">Se connecter</a></li>
    <?php } ?>
        </li>
    </ul>
</header>
<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
      <br />
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./?action=defaut">
              <span data-feather="home"></span>
              Tableau de bord
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./?action=catalogue">
              <span data-feather="list"></span>
              Catalogue
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./?action=clients">
              <span data-feather="users"></span>
              Clients
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./?action=facturation">
              <span data-feather="layers"></span>
              Factures
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./?action=bilan">
              <span data-feather="file-text"></span>
              Bilan
            </a>
          </li>
          <?php if(isset($_SESSION["user"])){ ?>
          <?php if($_SESSION["user"]->role == 3 ){ ?>
          <!--<li class="nav-item">
            <a class="nav-link" href="./?action=statistiques">
              <span data-feather="bar-chart-2"></span>
              Statistiques
            </a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="./?action=statistiques_alternative">
              <span data-feather="bar-chart-2"></span>
              Statistiques
            </a>
          </li>
          <?php } ?>
          <li class="nav-item">
            <a class="nav-link" href="./?action=aide">
              <span data-feather="alert-circle"></span>
              Aide
            </a>
          </li>
        </ul>

        <?php if($_SESSION["user"]->role > 1 ){ ?>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Administration</span>
        </h6>
        <ul class="nav flex-column mb-2">

        <?php if($_SESSION["user"]->role == 3 ){ ?>
          <li class="nav-item">
            <a class="nav-link" href="./?action=suppression_base_donnees">
              <span data-feather="folder-minus"></span>
              Suppression des tables
            </a>
          </li>
          <?php } ?>
          <li class="nav-item">
            <a class="nav-link" href="./?action=gestion_globale">
              <span data-feather="grid"></span>
              Gestion globale
            </a>
          </li>
        </ul>
        <?php } } ?>
      </div>
    </nav>

