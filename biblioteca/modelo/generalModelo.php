<?php
if ($peticionAjax) {
    require_once "../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}
class generalModelo extends mainModel
{
    //agregamos todas las funciones que ocuparemos
    public function ejecutarConsultaSimple($sql)
    {
        $respuesta = self::cn()->prepare($sql);
        $respuesta->execute();
        return $respuesta;
    }
    //definimos el crud de escuelas 
    public function buscar_escuela($nombre)
    {
        $sql = mainModel::cn()->prepare("SELECT e.idEscuela as escuela, e.nombre, e.director,
        COUNT(DISTINCT c.idCarrera) AS numero_carreras, COUNT(DISTINCT a.idAlumno) AS numero_alumnos
        FROM escuelas e
        LEFT JOIN carreras c ON c.idEscuelaCarrera = e.idEscuela
        LEFT JOIN alumnos a ON a.idCarreraAlumno = c.idCarrera
        WHERE e.nombre LIKE :nombre
        GROUP BY e.idEscuela");
        $sql->bindValue(":nombre", $nombre . '%');
        $sql->execute();
        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

        $json = array();
        foreach ($resultados as $fila) {
            $json[] = array(
                'nombre' => $fila['nombre'],
                'director' => $fila['director'],
                'idEscuela' => $fila['escuela'],
                'alumnos' => $fila['numero_alumnos'],
                'carreras' => $fila['numero_carreras']
            );
        }
        return json_encode($json);
    }
    public function buscar_escuela_id($id)
    {
        $sql = mainModel::cn()->prepare("SELECT e.idEscuela AS escuela, e.nombre, e.director,
        COUNT(DISTINCT c.idCarrera) AS numero_carreras, COUNT(DISTINCT a.idAlumno) AS numero_alumnos
        FROM escuelas e
        LEFT JOIN carreras c ON c.idEscuelaCarrera = e.idEscuela
        LEFT JOIN alumnos a ON a.idCarreraAlumno = c.idCarrera
        WHERE e.idEscuela = :idEscuela
        GROUP BY e.idEscuela
        ");
        $sql->bindValue(":idEscuela", $id);
        $sql->execute();
        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

        $json = array();
        foreach ($resultados as $fila) {
            $json[] = array(
                'nombre' => $fila['nombre'],
                'director' => $fila['director'],
                'idEscuela' => $fila['escuela'],
                'alumnos' => $fila['numero_alumnos'],
                'carreras' => $fila['numero_carreras']
            );
        }
        return json_encode($json);
    }



    protected function agregar_escuela_modelo($datos)
    {
        $sql = mainModel::cn()->prepare("INSERT INTO `escuelas` 
        (
        `nombre`, 
        `director`
        )
        VALUES
        ( 
        :nombre, 
        :director)");
        $sql->bindParam(":nombre", $datos['nombre']);
        $sql->bindParam(":director", $datos['director']);
        $sql->execute();
        return $sql;
    }
    protected function eliminar_escuela_modelo($codigo)
    {
        $sql = mainModel::cn()->prepare("DELETE FROM `escuelas` WHERE `idEscuela` = :codigo");
        $sql->bindParam(":codigo", $codigo);
        $sql->execute();
        return $sql;
    }
    public function verTodasLasEscuelas()
    {
        $sql = mainModel::cn()->prepare("SELECT e.nombre, e.director, e.idEscuela  AS escuela,
         COUNT(DISTINCT c.idCarrera) AS numero_carreras, COUNT(DISTINCT a.idAlumno) AS numero_alumnos
        FROM escuelas e
        LEFT JOIN carreras c ON c.idEscuelaCarrera = e.idEscuela
        LEFT JOIN alumnos a ON a.idCarreraAlumno = c.idCarrera
        GROUP BY e.idEscuela");
        $sql->execute();
        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

        $json = array();
        foreach ($resultados as $fila) {
            $json[] = array(
                'nombre' => $fila['nombre'],
                'director' => $fila['director'],
                'idEscuela' => $fila['escuela'],
                'alumnos' => $fila['numero_alumnos'],
                'carreras' => $fila['numero_carreras']
            );
        }
        return $json;
    }




    //definimos el crud de carreras
    public function buscar_carrera($idEscuela, $nombre)
    {
        $sql = mainModel::cn()->prepare("SELECT c.nombreCarrera, c.asignaturas, c.idCarrera AS carrera, COUNT(a.idAlumno) AS numero_alumnos
        FROM carreras c
        LEFT JOIN alumnos a ON a.idCarreraAlumno = c.idCarrera
        WHERE idEscuelaCarrera = :idescuela AND nombreCarrera LIKE :nombre
        GROUP BY c.idCarrera
        ");
        $sql->bindParam(":idescuela", $idEscuela);
        $nombreParam = $nombre . "%";
        $sql->bindParam(":nombre", $nombreParam);

        $sql->execute();
        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

        $json = array();
        foreach ($resultados as $fila) {
            $json[] = array(
                'carrera' => $fila['carrera'],
                'nombreCarrera' => $fila['nombreCarrera'],
                'asignaturas' => $fila['asignaturas'],
                'alumnos' => $fila['numero_alumnos']
            );
        }
        return json_encode($json);
    }


    protected function agregar_carrera_modelo($datos)
    {
        $sql = mainModel::cn()->prepare("INSERT INTO `carreras` 
        (
            `idEscuelaCarrera`,
            `nombreCarrera`, 
            `asignaturas`
        )
        VALUES
        ( 
            :idEscuelaCarrera,
            :nombreCarrera, 
            :asignaturas
        )");
        $sql->bindParam(":idEscuelaCarrera", $datos['idEscuelaCarrera']);
        $sql->bindParam(":nombreCarrera", $datos['nombreCarrera']);
        $sql->bindParam(":asignaturas", $datos['asignaturas']);
        $sql->execute();
        return $sql;
    }

    protected function eliminar_carrera_modelo($codigo)
    {
        $sql = mainModel::cn()->prepare("DELETE FROM `carreras` WHERE `idCarrera` = :codigo");
        $sql->bindParam(":codigo", $codigo);
        $sql->execute();
        return $sql;
    }

    public function verTodasLasCarreras($idEscuela)
    {
        $sql = mainModel::cn()->prepare("SELECT c.nombreCarrera, c.asignaturas ,c.idCarrera  AS carrera, COUNT(a.idAlumno) AS numero_alumnos
        FROM carreras c
        LEFT JOIN alumnos a ON a.idCarreraAlumno = c.idCarrera 
        WHERE idEscuelaCarrera=:idEscuela
        GROUP BY c.idCarrera");
        $sql->bindParam(":idEscuela", $idEscuela);
        $sql->execute();
        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

        $json = array();
        foreach ($resultados as $fila) {
            $json[] = array(
                'carrera' => $fila['carrera'],
                'nombreCarrera' => $fila['nombreCarrera'],
                'asignaturas' => $fila['asignaturas'],
                'alumnos' => $fila['numero_alumnos']
            );
        }
        return $json;
    }

    //definimos el crud de alumnos
    public function buscar_alumno($nombre)
    {
        $sql = mainModel::cn()->prepare("SELECT idAlumno, nombres, apellidos, direccion, telefonos
        FROM alumnos
        WHERE nombres LIKE :nombre OR apellidos LIKE :nombre");
        $sql->bindValue(":nombre", $nombre . '%');
        $sql->execute();
        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

        $json = array();
        foreach ($resultados as $fila) {
            $json[] = array(
                'nombres' => $fila['nombres'],
                'apellidos' => $fila['apellidos'],
                'direccion' => $fila['direccion'],
                'telefonos' => $fila['telefonos'],
                'idAlumno' => $fila['idAlumno']
            );
        }
        return json_encode($json);
    }



    protected function agregar_alumno_modelo($datos)
    {
        $sql = mainModel::cn()->prepare("INSERT INTO `alumnos` 
        (
        `idCarreraAlumno`,
        `nombres`, 
        `apellidos`,
        `direccion`,
        `telefonos`
        )
        VALUES
        ( 
        :idCarreraAlumno,
        :nombres, 
        :apellidos,
        :direccion,
        :telefonos
        )");
        $sql->bindParam(":idCarreraAlumno", $datos['idCarreraAlumno']);
        $sql->bindParam(":nombres", $datos['nombres']);
        $sql->bindParam(":apellidos", $datos['apellidos']);
        $sql->bindParam(":direccion", $datos['direccion']);
        $sql->bindParam(":telefonos", $datos['telefonos']);
        $sql->execute();
        return $sql;
    }

    protected function eliminar_alumno_modelo($codigo)
    {
        $sql = mainModel::cn()->prepare("DELETE FROM `alumnos` WHERE `idAlumno` = :codigo");
        $sql->bindParam(":codigo", $codigo);
        $sql->execute();
        return $sql;
    }

    public function ver_todos_los_alumnos()
    {
        $sql = mainModel::cn()->prepare("SELECT *
            FROM alumnos");
        $sql->execute();
        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

        $json = array();
        foreach ($resultados as $fila) {
            $json[] = array(
                'nombres' => $fila['nombres'],
                'apellidos' => $fila['apellidos'],
                'direccion' => $fila['direccion'],
                'telefonos' => $fila['telefonos'],
                'idAlumno' => $fila['idAlumno'],
                'idCarreraAlumno' => $fila['idCarreraAlumno'],
            );
        }
        return $json;
    }

    //definimos el crud de libros
    public function buscar_libro($titulo)
    {
        $sql = mainModel::cn()->prepare("SELECT idLibro, titulo, autor, editorial, fecha, ISBM
        FROM libros
        WHERE titulo LIKE :titulo");
        $sql->bindValue(":titulo", $titulo . '%');
        $sql->execute();
        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

        $json = array();
        foreach ($resultados as $fila) {
            $json[] = array(
                'titulo' => $fila['titulo'],
                'autor' => $fila['autor'],
                'editorial' => $fila['editorial'],
                'fecha' => $fila['fecha'],
                'ISBM' => $fila['ISBM'],
                'idLibro' => $fila['idLibro']
            );
        }
        return json_encode($json);
    }

    protected function agregar_libro_modelo($datos)
    {
        $sql = mainModel::cn()->prepare("INSERT INTO `libros` 
        (
        `titulo`, 
        `autor`,
        `editorial`,
        `fecha`,
        `ISBM`
        )
        VALUES
        ( 
        :titulo, 
        :autor,
        :editorial,
        :fecha,
        :ISBM
        )");
        $sql->bindParam(":titulo", $datos['titulo']);
        $sql->bindParam(":autor", $datos['autor']);
        $sql->bindParam(":editorial", $datos['editorial']);
        $sql->bindParam(":fecha", $datos['fecha']);
        $sql->bindParam(":ISBM", $datos['ISBM']);
        $sql->execute();
        return $sql;
    }

    protected function eliminar_libro_modelo($codigo)
    {
        $sql = mainModel::cn()->prepare("DELETE FROM `libros` WHERE `idLibro` = :codigo");
        $sql->bindParam(":codigo", $codigo);
        $sql->execute();
        return $sql;
    }

    public function verTodosLosLibros()
    {
        $sql = mainModel::cn()->prepare("SELECT idLibro, titulo, autor, editorial, fecha, ISBM
            FROM libros ");
        $sql->execute();
        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

        $json = array();
        foreach ($resultados as $fila) {
            $json[] = array(
                'titulo' => $fila['titulo'],
                'autor' => $fila['autor'],
                'editorial' => $fila['editorial'],
                'fecha' => $fila['fecha'],
                'ISBM' => $fila['ISBM'],
                'idLibro' => $fila['idLibro']
            );
        }
        return $json;
    }
    //definimos el crud de la tabla prestamos
    protected function insertar_prestamo_modelo($datos)
    {
        $sql = mainModel::cn()->prepare("INSERT INTO `prestamos` 
        (
        `idAlumno`,
        `idLibro`, 
        `fechaPrestamo`,
        `fechaDevolucion`,
        `estado`
        )
        VALUES
        ( 
        :idAlumno,
        :idLibro,
        :fechaPrestamo,
        :fechaDevolucion,
        :estado
        )");
        $sql->bindParam(":idAlumno", $datos['idAlumno']);
        $sql->bindParam(":idLibro", $datos['idLibro']);
        $sql->bindParam(":fechaPrestamo", $datos['fechaPrestamo']);
        $sql->bindParam(":fechaDevolucion", $datos['fechaDevolucion']);
        $sql->bindParam(":estado", $datos['estado']);
        $sql->execute();
        return $sql;
    }
    protected function eliminar_prestamo_modelo($codigo)
    {
        $sql = mainModel::cn()->prepare("DELETE FROM `prestamos` WHERE `idPrestamo` = :codigo");
        $sql->bindParam(":codigo", $codigo);
        $sql->execute();
        return $sql;
    }
    public function verTodosLosPrestamos()
    {
        $sql = mainModel::cn()->prepare("SELECT 	 
        idPrestamo,
        fechaPrestamo,
        fechaDevolucion,
        estado, libros.titulo, CONCAT(alumnos.nombres, ' ', alumnos.apellidos) AS nombre_completo
    FROM prestamos
    INNER JOIN libros ON prestamos.idLibro = libros.idLibro
    INNER JOIN alumnos ON prestamos.idAlumno = alumnos.idAlumno; ");
        $sql->execute();
        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

        $json = array();
        foreach ($resultados as $fila) {
            $json[] = array(
                'id' => $fila['idPrestamo'],
                'alumno' => $fila['nombre_completo'],
                'libro' => $fila['titulo'],
                'fechaPrestamo' => $fila['fechaPrestamo'],
                'fechaDevolucion' => $fila['fechaDevolucion'],
                'estado' => $fila['estado']
            );
        }
        return $json;
    }
    public function buscar_prestamo_por_alumno($nombre)
    {
        $sql = mainModel::cn()->prepare("SELECT p.idPrestamo, l.titulo, a.nombres, a.apellidos, p.fechaPrestamo, p.fechaDevolucion, p.estado
        FROM prestamos p
        INNER JOIN alumnos a ON p.idAlumno = a.idAlumno
        INNER JOIN libros l ON p.idLibro = l.idLibro
        WHERE CONCAT(a.nombres, ' ', a.apellidos) LIKE :nombre");
        $sql->bindValue(":nombre", $nombre . '%');
        $sql->execute();
        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

        $json = array();
        foreach ($resultados as $fila) {
            $json[] = array(
                'idPrestamo' => $fila['idPrestamo'],
                'titulo' => $fila['titulo'],
                'nombres' => $fila['nombres'],
                'apellidos' => $fila['apellidos'],
                'fechaPrestamo' => $fila['fechaPrestamo'],
                'fechaDevolucion' => $fila['fechaDevolucion'],
                'estado' => $fila['estado']
            );
        }
        return $json;
    }
    public function buscar_prestamo_por_fecha_devolucion($fecha)
    {
        $sql = mainModel::cn()->prepare("SELECT p.idPrestamo, l.titulo, a.nombres, a.apellidos, p.fechaPrestamo, p.fechaDevolucion, p.estado 
                                         FROM prestamos p 
                                         INNER JOIN alumnos a ON p.idAlumno = a.idAlumno 
                                         INNER JOIN libros l ON p.idLibro = l.idLibro 
                                         WHERE p.fechaDevolucion = :fecha");
        $sql->bindValue(":fecha", $fecha);
        $sql->execute();
        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

        $json = array();
        foreach ($resultados as $fila) {
            $json[] = array(
                'idPrestamo' => $fila['idPrestamo'],
                'titulo' => $fila['titulo'],
                'nombres' => $fila['nombres'],
                'apellidos' => $fila['apellidos'],
                'fechaPrestamo' => $fila['fechaPrestamo'],
                'fechaDevolucion' => $fila['fechaDevolucion'],
                'estado' => $fila['estado']
            );
        }
        return $json;
    }
    public function buscar_prestamo_por_fecha($fecha)
    {
        $sql = mainModel::cn()->prepare("SELECT p.idPrestamo, l.titulo, a.nombres, a.apellidos, p.fechaPrestamo, p.fechaDevolucion, p.estado 
                                         FROM prestamos p 
                                         INNER JOIN alumnos a ON p.idAlumno = a.idAlumno 
                                         INNER JOIN libros l ON p.idLibro = l.idLibro 
                                         WHERE p.fechaPrestamo = :fecha");
        $sql->bindValue(":fecha", $fecha);
        $sql->execute();
        $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);

        $json = array();
        foreach ($resultados as $fila) {
            $json[] = array(
                'idPrestamo' => $fila['idPrestamo'],
                'titulo' => $fila['titulo'],
                'nombres' => $fila['nombres'],
                'apellidos' => $fila['apellidos'],
                'fechaPrestamo' => $fila['fechaPrestamo'],
                'fechaDevolucion' => $fila['fechaDevolucion'],
                'estado' => $fila['estado']
            );
        }
        return $json;
    }



}