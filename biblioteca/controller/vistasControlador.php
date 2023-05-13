<?php
require_once "./modelo/vistasModelo.php";
class vistasControlador extends vistasModelo
{
    public function obtener_plantilla_controlador()
    {
        //cargamos la nav var
        return require_once("./default/plantilla.php");
    }
    public function obtener_vistas_controlador()
    {
        //comprobamos si la url ha cambiado
        if(isset($_GET['controller']))
        {
            //creamos un string de lo que hay en la url por cada '/'
            $ruta=explode('/',$_GET['controller']);
            $respuesta=vistasModelo::obtener_vistas_modelo($ruta[0]);
        }
        else
        {
            $respuesta = "./vistasHTML/homeView.php";
        }
        return $respuesta;
    }
}