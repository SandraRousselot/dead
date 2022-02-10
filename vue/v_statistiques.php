<?php include "./vue/v_header.php"; ?>
<!-- MAIN DE LA PAGE -->
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Statistiques</h1>


<div style ="height:5vh;width:450px;" class="row align-items-center"> 

    <form action="" method="POST">

    <input class="col-4" name="date_debut" class="form-control" type="date" 
    value="">

    <input class="col-4" name="date_fin" class="form-control" type="date" 
    value="">
    
    <input width="25" height="25" type="image" src="image/chercherpardate.png">

</form>
</div>
</div>
    
<!-- DEBUT GRAPHIQUE CHIFFRE D'AFFAIRE PAR ATELIER -->
<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Chiffre d'affaire par atelier</h5>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <div>
                <canvas id="stat"></canvas>
            </div>
            <canvas id="stat" width="400" height="400"></canvas>
            <script>
            var cte = document.getElementById('stat').getContext('2d');
            var stat = new Chart(cte, {
            type: 'bar',
            data: {
                
                labels: <?= $test ?>,
                datasets: [{
                    label: 'Montant en euros ',
                    data: <?= $result ?>,
                    backgroundColor: [
                        'rgba(255, 0, 188, 0.3)',
                        'rgba(154, 0, 255, 0.3)',
                        'rgba(0, 0, 255, 0.3)',
                        'rgba(0, 213, 255, 0.3)',
                        'rgba(0, 255, 60, 0.3)',
                        'rgba(255, 255, 0, 0.3)',
                        'rgba(255, 145, 0, 0.3)',
                        'rgba(255, 0, 0, 0.3)'
                    ],
                    borderColor: [
                        'rgba(255, 0, 188, 1)',
                        'rgba(154, 0, 255, 1)',
                        'rgba(0, 0, 255, 1)',
                        'rgba(0, 213, 255, 1)',
                        'rgba(0, 255, 60, 1)',
                        'rgba(255, 255, 0, 1)',
                        'rgba(255, 145, 0, 1)',
                        'rgba(255, 0, 0, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false,

                    }
                }
            }
            });
            </script>
        </div>
    </div>
</div>
<!-- FIN GRAPHIQUE CHIFFRE D'AFFAIRE PAR ATELIER -->

<!-- DEBUT RAPHIQUE CHIFFRE D'AFFAIRE PAR TYPE DE REGLEMENT -->
<div class="col-sm-6">
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Chiffre d'affaire par type de reglement</h5>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <div>
                <canvas id="statistique"></canvas>
            </div>
            <canvas id="statistique" width="400" height="400"></canvas>
            <script>
            var deux = document.getElementById('statistique').getContext('2d');
            var statistique = new Chart(deux, {
            type: 'bar',
            data: {
                
                labels: <?= $essai ?>,
                datasets: [{
                    label: 'Montant en euros ',
                    data: <?= $resultat ?>,
                    backgroundColor: [
                        'rgba(255, 0, 188, 0.3)',
                        'rgba(154, 0, 255, 0.3)',
                        'rgba(0, 0, 255, 0.3)',
                        'rgba(0, 213, 255, 0.3)',
                        'rgba(0, 255, 60, 0.3)',
                        'rgba(255, 255, 0, 0.3)',
                        'rgba(255, 145, 0, 0.3)',
                        'rgba(255, 0, 0, 0.3)',
                        'rgba(255, 0, 0, 0.3)'
                    ],
                    borderColor: [
                        'rgba(255, 0, 188, 1)',
                        'rgba(154, 0, 255, 1)',
                        'rgba(0, 0, 255, 1)',
                        'rgba(0, 213, 255, 1)',
                        'rgba(0, 255, 60, 1)',
                        'rgba(255, 255, 0, 1)',
                        'rgba(255, 145, 0, 1)',
                        'rgba(255, 0, 0, 1)',
                        'rgba(255, 0, 0, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false,

                    }
                }
            }
            });
            </script>
        </div>
    </div>
</div>
<!-- FIN RAPHIQUE CHIFFRE D'AFFAIRE PAR TYPE DE REGLEMENT -->

<!-- DEBUT GRAPHIQUE CHIFFRE D'AFFAIRE PAR ATELIER NON PAYE -->
<div class="row" style="height:20px;">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">Somme non payée par atelier</h5>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <div>
                <canvas id="stats"></canvas>
            </div>
            <canvas id="stats" width="400" height="400"></canvas>
            <script>
            var trois = document.getElementById('stats').getContext('2d');
            var stats = new Chart(trois, {
            type: 'bar',
            data: {
                
                labels: <?= $suite ?>,
                datasets: [{
                    label: 'Montant en euros ',
                    data: <?= $results ?>,
                    backgroundColor: [
                        'rgba(255, 0, 188, 0.3)',
                        'rgba(154, 0, 255, 0.3)',
                        'rgba(0, 0, 255, 0.3)',
                        'rgba(0, 213, 255, 0.3)',
                        'rgba(0, 255, 60, 0.3)',
                        'rgba(255, 255, 0, 0.3)',
                        'rgba(255, 145, 0, 0.3)',
                        'rgba(255, 0, 0, 0.3)'
                    ],
                    borderColor: [
                        'rgba(255, 0, 188, 1)',
                        'rgba(154, 0, 255, 1)',
                        'rgba(0, 0, 255, 1)',
                        'rgba(0, 213, 255, 1)',
                        'rgba(0, 255, 60, 1)',
                        'rgba(255, 255, 0, 1)',
                        'rgba(255, 145, 0, 1)',
                        'rgba(255, 0, 0, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false,

                    }
                }
            }
            });
            </script>
        </div>
    </div>
</div>
<!-- FIN GRAPHIQUE CHIFFRE D'AFFAIRE PAR ATELIER NON PAYE -->

<?php include "./vue/v_footer.php"; ?>