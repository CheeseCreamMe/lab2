<?php
$peticionAjax = true;
require_once "../core/config.php";
require_once "../controller/generalControlador.php";
$insCr = new generalControlador;

$escuelas = $insCr->buscar_escuela_id($_POST['search']);
    
header("Content-Type: application/json");
echo json_encode($escuelas);