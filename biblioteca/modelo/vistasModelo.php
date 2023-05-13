<?php
class vistasModelo
{
    protected function obtener_vistas_modelo($vistas)
    {
        //agregamos una lista de paramentros permitidos
        //como somo racistas se llama lista blanca 😘
        $listaBlanca = [
            'historial',
            'alumnos',
            'carreras',
            'escuelas',
            'home',
            'libros',
            'prestamos'
        ];
        //comprobamos si la url existe en la lista blanca
        if (in_array($vistas, $listaBlanca)) {
            if (is_file("./vistasHTML/" . $vistas . "View.php")) {
                $contenido = "./vistasHTML/" . $vistas . "View.php";
            } else {
                $contenido = "./vistasHTML/homeView.php";
            }
        } else if ($vistas == 'home') {
            $contenido = "./vistasHTML/homeView.php";
        } else if ($vistas == 'index') {
            $contenido = "./vistasHTML/homeView.php";
        } else if (!in_array($vistas, $listaBlanca)) {
            $contenido = "./vistasHTML/errorView.php";
        }
        return $contenido;
    }
}