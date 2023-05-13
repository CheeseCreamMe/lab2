<?php
$peticionAjax = true;
require_once "../core/config.php";
require_once "../controller/generalControlador.php";
$insEs = new generalControlador;
$tabla=$insEs->verTodosLosLibros();
$total=json_encode($tabla);
echo $total;