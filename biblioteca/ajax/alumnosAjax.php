<?php
$peticionAjax = true;
require_once "../core/config.php";
require_once "../controller/generalControlador.php";
$general = new generalControlador;
if (isset($_POST['opcion'])) {
    if ($_POST['opcion'] == "buscar") {
        $respuesta = $general->buscar_alumno($_POST['search']);
    }
    else if ($_POST['opcion'] == "agregar") {
    $respuesta=$general->agregar_alumno_controlador();
    } 
    else if ($_POST['opcion'] == "eliminar") {
        $respuesta= $general->eliminar_alumno_controlador();
    }
    echo $respuesta;
}
