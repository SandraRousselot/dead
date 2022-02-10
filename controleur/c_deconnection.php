<?php

include_once "./modele/pdo.php";
include_once "./modele/fonctions.php";

logged_only();

unset($_SESSION['user']);

header('Location: ./?action=connection');

?>