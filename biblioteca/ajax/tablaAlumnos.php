<?php
$peticionAjax = true;
require_once "../core/config.php";
require_once "../controller/generalControlador.php";
$insEs = new generalControlador;
$tabla=$insEs->ver_todos_los_alumnos();
$total=json_encode($tabla);
echo $total;