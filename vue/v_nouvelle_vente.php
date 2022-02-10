<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nouvelle vente</h1>
    </div>
    
<link href="./css/affiche_client.css" rel="stylesheet">
<script> var variable = <?= json_encode($stack); ?>; </script>
<script> var clients = <?= json_encode($clients); ?>; </script>

</script>

    <div class="container" style="margin-top: 1em;">
    <!-- Sign up form -->
    <form action="./?action=confirmation_nouvelle_vente" method="POST">
        <!-- Sign up card -->
        <div class="card person-card">
        <div class="col-md-12" style="padding:0.5em;">
            <div class="card-body">
                <!-- First row (on medium screen) -->
                <div class="row">
                    <div class="card-body">
                    <h2 class="card-title">Produits</h2>
                    <div class="form-group col-md">
                    <!-- Composition pour calcul du prix -->
                            <input name='tags' class='form-group' placeholder='Produits' value='' of Objects)></input>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <div class="card person-card">
        <div class="col-md-12" style="padding:0.5em;">
            <div class="card-body">
                <!-- First row (on medium screen) -->
                <div class="row">
                    <div class="card-body">
                    <h2 class="card-title">Client</h2>
                    <div class="form-group">
                    <input id="myInput" class="form-control" type="text"  name="client" placeholder="Nom du client">
                    <!-- Composition pour calcul du prix -->
                    <br />
                    <div class="form-check form-switch">
                        <input name="reservation" class="form-check-input" type="checkbox" value="1">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Réservation</label>
                    </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div style="margin-top: 1em;">
            <input name="nouvelle_vente" type="submit" class="btn btn-primary btn-lg btn-block" value="Vendre"></input>
        </div>
        </form>

<script src='./script/affiche_client.js'></script>

</body>
</html>


<?php include "./vue/v_footer.php"; ?>


