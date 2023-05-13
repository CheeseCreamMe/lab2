<?php
if ($peticionAjax) {
    require_once "../core/configApp.php";
} else {
    require_once "./core/configApp.php";
}
class mainModel
{
    //creamos la conexion a la base de datos
    public function cn()
    {
        //https://www.php.net/manual/es/pdo.construct.php
        $enlace = new PDO(SGBD, USER, PASS);
        return $enlace;
    }

    //anti sql injection
    protected function limpiarCadena($cadena)
    {
        //eliminamos espacios en blanco
        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);
        $cadena = str_ireplace("<script>", "", $cadena);
        $cadena = str_ireplace("</script>", "", $cadena);
        $cadena = str_ireplace("<script src", "", $cadena);
        $cadena = str_ireplace("<script type", "", $cadena);
        $cadena = str_ireplace("<script>", "", $cadena);
        $cadena = str_ireplace("SELECT * FROM", "", $cadena);
        $cadena = str_ireplace("INSERT INTO", "", $cadena);
        $cadena = str_ireplace("DELETE FROM", "", $cadena);
        $cadena = str_ireplace('"', "", $cadena);
        $cadena = str_ireplace("'", "", $cadena);
        return $cadena;
    }
    //https://sweetalert2.github.io/
    protected function sweet_alert($datos)
    {
        //alerta multiusos
        if ($datos['alerta'] == "simple") {
            $alerta = "
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='.bd-example-modal-sm'>" . $datos['titulo'] . "</button>

            <div class='modal fade bd-example-modal-sm' tabindex='-1' role='dialog' aria-labelledby='mySmallModalLabel' aria-hidden='true'>
              <div class='modal-dialog modal-sm'>
                <div class='modal-content'>
                " . $datos['Texto'] . "
                </div>
              </div>
            </div>
            ";
            //alerta de recargar pagina
        } else if ($datos['alerta'] == "error") {
            $alerta = "
                <div class='card col'>
                <img src='" . URL . "imagenes/no.png' class='card-img-top' alt='...'>
                <div class='card-body'>
                  <h5 class='card-title'>" . $datos['titulo'] . "</h5>
                  <p class='card-text'>" . $datos['Texto'] . "</p>
                </div>
              </div>
                ";
            //alerta de  limpiar inputs de los forms
        } else if ($datos['alerta'] == "realizado") {
            $alerta = "
                 <div class='card  col'>
                <img src='" . URL . "imagenes/ok.png' class='card-img-top' alt='...'>
                <div class='card-body' col>
                  <h5 class='card-title'>" . $datos['titulo'] . "</h5>
                  <p class='card-text'>" . $datos['Texto'] . "</p>
                </div>
              </div> 
                ";
        }
        return $alerta;
    }
}