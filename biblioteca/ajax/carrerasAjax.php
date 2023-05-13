<?php
$peticionAjax = true;
require_once "../core/config.php";
require_once "../controller/generalControlador.php";
$insEs = new generalControlador;
if (isset($_POST['opcion'])) {
    if ($_POST['opcion'] == "buscar") {
        $respuesta = $insEs->buscar_carrera($_POST['idEscuelaCarrera'],$_POST['search']);
    }
    else if ($_POST['opcion'] == "agregar") {
       $respuesta=$insEs->agregar_carrera_controlador();
    } 
    else if ($_POST['opcion'] == "eliminar") {
        $respuesta= $insEs->eliminar_carrera_controlador();
     }
    echo $respuesta;
}
