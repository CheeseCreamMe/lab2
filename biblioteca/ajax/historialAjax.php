<?php
$peticionAjax = true;
require_once "../core/config.php";
require_once "../controller/generalControlador.php";
$insHs = new generalControlador;
if (isset($_POST['opcion'])) {
    if ($_POST['opcion'] == "buscar-alumno") {
        $respuesta = json_encode($insHs->buscar_prestamo_por_alumno($_POST['nombre']));
    }
    else if ($_POST['opcion'] == "buscar-fecha-i") {
       $respuesta=json_encode($insHs->buscar_prestamo_por_fecha($_POST['fecha']));
    } 
    else if ($_POST['opcion'] == "buscar-fecha-d") {
        $respuesta= $insHs->buscar_prestamo_por_fecha_devolucion($_POST['fecha']);
     }
    echo $respuesta;
}