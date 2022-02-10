<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Bilan</h1>
        
    </div>

    <div class="col-sm-12">
    <div class="card">
        <div class="card-body">
        <form action="" method="POST"> 
            <h5 class="card-title">Bilan</h5>
            <input name="action" type="hidden" value="bilanSemaine"></input>
            <input width="30" height="30" type="submit" class="btn btn-primary btn-lg btn-block" value="Bilan"></input>
        </form>
        </div>
    </div>
</div>
</br>
<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
        <form action="" method="POST"> 
        <h5 class="card-title">Journal des ventes</h5>
            <input name="action" type="hidden" value="journalVente"></input>
            <input width="30" height="30" type="submit" class="btn btn-primary btn-lg btn-block" value="Journal des ventes"></input>
        </form>
        </div>
    </div>
</div>
</br>
<div class="col-sm-12">
    <div class="card">
        <div class="card-body">
        <form action="" method="POST"> 
        <h5 class="card-title">Ordre de recette</h5>
            <input name="action" type="hidden" value="ordreRecette"></input>
            <input width="30" height="30" type="submit" class="btn btn-primary btn-lg btn-block" value="Ordre de recette"></input>
        </form>
        </div>
    </div>
</div>
</br>

<?php include "./vue/v_footer.php"; ?>