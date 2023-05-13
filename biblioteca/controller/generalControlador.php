<?php
if ($peticionAjax) {
    require_once "../modelo/generalModelo.php";
} else {
    require_once "./modelo/generalModelo.php";
}
class generalControlador extends generalModelo
{
    //creamos el controlador para poder agregar escuelas
    public function agregar_escuela_controlador()
    {
        $nombre = mainModel::limpiarCadena($_POST['nombre']);
        $director = mainModel::limpiarCadena($_POST['director']);
        $dataES = [
            "nombre" => $nombre,
            "director" => $director
        ];
        $guardar = generalModelo::agregar_escuela_modelo($dataES);
        if ($guardar->rowCount() >= 1) {
            $datos = [
                "alerta" => "realizado",
                "titulo" => "Agregado",
                "Texto" => "Se ha agregado correctamente la escuela " . $nombre,

            ];
            $alerta = mainModel::sweet_alert($datos);
        } else {
            $datos = [
                "alerta" => "error",
                "titulo" => "Upps!!",
                "Texto" => "No se pudo agregar la escuela " . $nombre,

            ];
            $alerta = mainModel::sweet_alert($datos);
        }
        return $alerta;
    }
    public function eliminar_escuela_controlador(){
        $id=$_POST['cod'];
        try {
            $eliminar=generalModelo::eliminar_escuela_modelo($id);
            if ($eliminar->rowCount() >= 1) {
                $datos = [
                    "alerta" => "realizado",
                    "titulo" => "Elimianado",
                    "Texto" => "Se ha eliminado correctamente la escuela ",
    
                ];
                $alerta = mainModel::sweet_alert($datos);
            } else {
                $datos = [
                    "alerta" => "error",
                    "titulo" => "Upps!!",
                    "Texto" => "No se pudo eliminar la escuela ",
    
                ];
                $alerta = mainModel::sweet_alert($datos);
            }
        } catch (\Throwable $th) {
            $datos = [
                "alerta" => "error",
                "titulo" => "Upps!!",
                "Texto" => "No se pudo eliminar la escuela <br> parece que hay alumnos<br> o carreras ligados a esta ecuela",

            ];
            $alerta = mainModel::sweet_alert($datos);
        }
        return $alerta;
    }

    //creamos el controlador para poder agregar carreras
    public function agregar_carrera_controlador()
    {
        $idEscuelaCarrera = mainModel::limpiarCadena($_POST['idEscuelaCarrera']);
        $nombreCarrera = mainModel::limpiarCadena($_POST['nombreCarrera']);
        $asignaturas = mainModel::limpiarCadena($_POST['asignaturas']);
    
        $data = [
            "idEscuelaCarrera" => $idEscuelaCarrera,
            "nombreCarrera" => $nombreCarrera,
            "asignaturas" => $asignaturas
        ];
    
        $guardar = generalModelo::agregar_carrera_modelo($data);
        if ($guardar->rowCount() >= 1) {
            $datos = [
                "alerta" => "realizado",
                "titulo" => "Agregado",
                "Texto" => "Se ha agregado correctamente la carrera " . $nombreCarrera,
    
            ];
            $alerta = mainModel::sweet_alert($datos);
        } else {
            $datos = [
                "alerta" => "error",
                "titulo" => "Upps!!",
                "Texto" => "No se pudo agregar la carrera " . $nombreCarrera,
    
            ];
            $alerta = mainModel::sweet_alert($datos);
        }
        return $alerta;
    }
    
    public function eliminar_carrera_controlador()
    {
        $id = $_POST['id'];
        try {
            $eliminar = generalModelo::eliminar_carrera_modelo($id);
            if ($eliminar->rowCount() >= 1) {
                $datos = [
                    "alerta" => "realizado",
                    "titulo" => "Eliminado",
                    "Texto" => "Se ha eliminado correctamente la carrera ",
        
                ];
                $alerta = mainModel::sweet_alert($datos);
            } else {
                $datos = [
                    "alerta" => "error",
                    "titulo" => "Upps!!",
                    "Texto" => "No se pudo eliminar la carrera ",
        
                ];
                $alerta = mainModel::sweet_alert($datos);
            }
        } catch (\Throwable $th) {
            $datos = [
                "alerta" => "error",
                "titulo" => "Upps!!",
                "Texto" => "No se pudo eliminar la carrera ",
    
            ];
            $alerta = mainModel::sweet_alert($datos);
        }
        return $alerta;
    }
    
    //creamos el controlador para agregar alumnos
    public function agregar_alumno_controlador()
    {
        $idCarreraAlumno = mainModel::limpiarCadena($_POST['idCarreraAlumno']);
        $nombres = mainModel::limpiarCadena($_POST['nombres']);
        $apellidos = mainModel::limpiarCadena($_POST['apellidos']);
        $direccion = mainModel::limpiarCadena($_POST['direccion']);
        $telefonos = mainModel::limpiarCadena($_POST['telefonos']);
        $dataAl = [
            "idCarreraAlumno" => $idCarreraAlumno,
            "nombres" => $nombres,
            "apellidos" => $apellidos,
            "direccion" => $direccion,
            "telefonos" => $telefonos
        ];
        $guardar = generalModelo::agregar_alumno_modelo($dataAl);
        if ($guardar->rowCount() >= 1) {
            $datos = [
                "alerta" => "realizado",
                "titulo" => "Agregado",
                "Texto" => "Se ha agregado correctamente el alumno " . $nombres,
    
            ];
            $alerta = mainModel::sweet_alert($datos);
        } else {
            $datos = [
                "alerta" => "error",
                "titulo" => "Upps!!",
                "Texto" => "No se pudo agregar el alumno " . $nombres,
    
            ];
            $alerta = mainModel::sweet_alert($datos);
        }
        return $alerta;
    }
    
    public function eliminar_alumno_controlador(){
        $id=$_POST['cod'];
        try {
            $eliminar=generalModelo::eliminar_alumno_modelo($id);
            if ($eliminar->rowCount() >= 1) {
                $datos = [
                    "alerta" => "realizado",
                    "titulo" => "Elimianado",
                    "Texto" => "Se ha eliminado correctamente el alumno ",
    
                ];
                $alerta = mainModel::sweet_alert($datos);
            } else {
                $datos = [
                    "alerta" => "error",
                    "titulo" => "Upps!!",
                    "Texto" => "No se pudo eliminar el alumno ",
    
                ];
                $alerta = mainModel::sweet_alert($datos);
            }
        } catch (\Throwable $th) {
            $datos = [
                "alerta" => "error",
                "titulo" => "Upps!!",
                "Texto" => "No se pudo eliminar el alumno ",
    
            ];
            $alerta = mainModel::sweet_alert($datos);
        }
        return $alerta;
    }
    //agregamos el controlador para poder agergar libros
    public function agregar_libro_controlador()
{
    $titulo = mainModel::limpiarCadena($_POST['titulo']);
    $autor = mainModel::limpiarCadena($_POST['autor']);
    $editorial = mainModel::limpiarCadena($_POST['editorial']);
    $fecha = mainModel::limpiarCadena($_POST['fecha']);
    $ISBM = mainModel::limpiarCadena($_POST['ISBM']);

    $dataL = [
        "titulo" => $titulo,
        "autor" => $autor,
        "editorial" => $editorial,
        "fecha" => $fecha,
        "ISBM" => $ISBM
    ];

    $guardar = generalModelo::agregar_libro_modelo($dataL);
    if ($guardar->rowCount() >= 1) {
        $datos = [
            "alerta" => "realizado",
            "titulo" => "Agregado",
            "Texto" => "Se ha agregado correctamente el libro " . $titulo,

        ];
        $alerta = mainModel::sweet_alert($datos);
    } else {
        $datos = [
            "alerta" => "error",
            "titulo" => "Upps!!",
            "Texto" => "No se pudo agregar el libro " . $titulo,

        ];
        $alerta = mainModel::sweet_alert($datos);
    }
    return $alerta;
}
public function eliminar_libro_controlador(){
    $id=$_POST['cod'];
    try {
        $eliminar=generalModelo::eliminar_libro_modelo($id);
        if ($eliminar->rowCount() >= 1) {
            $datos = [
                "alerta" => "realizado",
                "titulo" => "Eliminado",
                "Texto" => "Se ha eliminado correctamente el libro",

            ];
            $alerta = mainModel::sweet_alert($datos);
        } else {
            $datos = [
                "alerta" => "error",
                "titulo" => "Upps!!",
                "Texto" => "No se pudo eliminar el libro",

            ];
            $alerta = mainModel::sweet_alert($datos);
        }
    } catch (\Throwable $th) {
        $datos = [
            "alerta" => "error",
            "titulo" => "Upps!!",
            "Texto" => "No se pudo eliminar el libro",

        ];
        $alerta = mainModel::sweet_alert($datos);
    }
    return $alerta;
}


    //agregamos el controlador para poder agregar prestamos
    public function agregar_prestamo_controlador()
    {
        $idAlumno = mainModel::limpiarCadena($_POST['idAlumno']);
        $idLibro = mainModel::limpiarCadena($_POST['idLibro']);
        $fechaPrestamo = mainModel::limpiarCadena($_POST['fechaPrestamo']);
        $fechaDevolucion = mainModel::limpiarCadena($_POST['fechaDevolucion']);
        $estado = mainModel::limpiarCadena($_POST['estado']);
        $dataPrestamo = [
            "idAlumno" => $idAlumno,
            "idLibro" => $idLibro,
            "fechaPrestamo" => $fechaPrestamo,
            "fechaDevolucion" => $fechaDevolucion,
            "estado" => $estado
        ];
        $guardar = generalModelo::insertar_prestamo_modelo($dataPrestamo);
        if ($guardar->rowCount() >= 1) {
            $datos = [
                "alerta" => "realizado",
                "titulo" => "Agregado",
                "Texto" => "Se ha agregado correctamente el préstamo solicitado por ".$idAlumno,

            ];
            $alerta = mainModel::sweet_alert($datos);
        } else {
            $datos = [
                "alerta" => "error",
                "titulo" => "Upps!!",
                "Texto" => "No se pudo agregar el préstamo",

            ];
            $alerta = mainModel::sweet_alert($datos);
        }
        return $alerta;
    }
    public function eliminar_prestamo_controlador(){
        $id=$_POST['cod'];
        try {
            $eliminar=generalModelo::eliminar_prestamo_modelo($id);
            if ($eliminar->rowCount() >= 1) {
                $datos = [
                    "alerta" => "realizado",
                    "titulo" => "Eliminado",
                    "Texto" => "Se ha eliminado correctamente el préstamo",
                ];
                $alerta = mainModel::sweet_alert($datos);
            } else {
                $datos = [
                    "alerta" => "error",
                    "titulo" => "Upps!!",
                    "Texto" => "No se pudo eliminar el préstamo",
                ];
                $alerta = mainModel::sweet_alert($datos);
            }
        } catch (\Throwable $th) {
            $datos = [
                "alerta" => "error",
                "titulo" => "Upps!!",
                "Texto" => "No se pudo eliminar el préstamo",
            ];
            $alerta = mainModel::sweet_alert($datos);
        }
        return $alerta;
    }
    


}