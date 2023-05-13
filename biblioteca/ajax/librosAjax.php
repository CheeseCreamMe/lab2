<?php
$peticionAjax = true;
require_once "../core/config.php";
require_once "../controller/generalControlador.php";
$insLibros = new generalControlador;
if (isset($_POST['opcion'])) {
    if ($_POST['opcion'] == "buscar") {
        $respuesta = $insLibros->buscar_libro($_POST['search']);
    }
    else if ($_POST['opcion'] == "agregar") {
       $respuesta=$insLibros->agregar_libro_controlador();
    } 
    else if ($_POST['opcion'] == "eliminar") {
        $respuesta= $insLibros->eliminar_libro_controlador();
     }
    echo $respuesta;
}
