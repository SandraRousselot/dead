<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Gestion globale</h1>
    </div>

    <div class="col-sm-12">
    <div class="card">
        <div class="card-body">
        <form action="" method="POST"> 
            <h5 class="card-title">Gestion des clients</h5>
            <p>La suppression des clients demande une confirmation, 
              en acceptant celle-ci, l'intégralité des clients seront supprimés.</p>
            <input name="action" type="hidden" value="deleteClients"></input>
            <input width="30" height="30" type="submit" class="btn btn-primary btn-lg btn-block" value="Supprimer les clients"></input>
        </form>
        </div>
    </div>
</div>
</br>
<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
        <form action="" method="POST"> 
        <h5 class="card-title">Gestion des professeurs</h5>
            <p>La gestion des professeurs vous permettra d'en ajouter, d'en supprimer, 
              ou d'en modifier.</p>
            <input name="action" type="hidden" value="profs"></input>
            <input width="30" height="30" type="submit" class="btn btn-primary btn-lg btn-block" value="Gérer les professeurs"></input>
        </form>
        </div>
    </div>
</div>
</br>
<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
        <form action="" method="POST"> 
        <h5 class="card-title">Gestion des classes</h5>
            <p>La gestion des classes vous permettra d'en ajouter, d'en supprimer, 
              ou d'en modifier.</p>
            <input name="action" type="hidden" value="classes"></input>
            <input width="30" height="30" type="submit" class="btn btn-primary btn-lg btn-block" value="Gérer les classes"></input>
        </form>
        </div>
    </div>
</div>
</br>

<?php include "./vue/v_footer.php"; ?>