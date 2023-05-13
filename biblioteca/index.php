<?php
//definimos la url;
REQUIRE_ONCE("./core/config.php");
//agregamos el controlador
REQUIRE_ONCE("./controller/vistasControlador.php");
//instanciamos el controlador
$plantilla=new vistasControlador();
$plantilla->obtener_plantilla_controlador();


