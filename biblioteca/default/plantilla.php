<?php
//iniciamos una sesion en php la usaremos para el tema
session_start();
//este script guarda los datos del tema elegido por el usuario
if (isset($_POST['theme'])) {
    if (!isset($_SESSION['theme']) || $_SESSION['theme'] == 'light') {
        $_SESSION['theme'] = 'dark';
    } else {
        $_SESSION['theme'] = 'light';
    }
}
//defininimos el tema elegido por el usuario
if (!isset($_SESSION['theme'])) {
    $_SESSION['theme'] = 'light'; // modo claro por defecto
}
//guardamos el tema en una sesion
$theme = $_SESSION['theme'];
//print_r($theme);
$peticionAjax=false;
?>
<html lang="en">

<head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <?php
    //invocamos o declaramos una instancia de la clase vistas
    require_once "./controller/vistasControlador.php";
    $vt = new vistasControlador();
    $vistasF = $vt->obtener_vistas_controlador();
    ?>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo URL; ?>home"> <img width="130px" height="60px"
                    src="<?php echo URL; ?>imagenes/logo.png"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Contenido</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="<?php echo URL; ?>home"><i
                                    class="bi bi-house-door-fill"></i>Home</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Registro
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo URL; ?>escuelas"><i class="bi bi-hospital-fill"></i> Escuelas</a></li>
                                <li><a class="dropdown-item" href="<?php echo URL; ?>carreras"><i class="bi bi-window-sidebar"></i> Carreras</a></li>
                                <li><a class="dropdown-item" href="<?php echo URL; ?>alumnos"><i class="bi bi-person-square"></i> Alumnos</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Biblioteca
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo URL; ?>libros"><i class="bi bi-book-fill"></i> Libros</a></li>
                                <li><a class="dropdown-item" href="<?php echo URL; ?>prestamos"><i class="bi bi-file-earmark-person"></i> Prestamos</a></li>
                                <li><a class="dropdown-item" href="<?php echo URL; ?>historial"><i class="bi bi-clock-history"></i> Historial</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <form method="POST" id="temaXd">
                                <button class="btn btn-outline-light" type="submit" name="theme">
                                    <a id="theme" style="cursor:pointer;"></a>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <?php
    //mostramos la vista que hemos invocado
    require_once $vistasF;
    ?>
</body>

</html> 
<script src="<?php echo URL; ?>ajax/ajax.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
<?php
//configuramos los ajustes del tema oscuro/claro
//lo pasamos a travez de la variable definida en la parte superior
include("default/theme.php");
?>