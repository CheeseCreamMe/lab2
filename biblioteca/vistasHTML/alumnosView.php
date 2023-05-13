<title>Alumnos</title>
<!--cremos toda la vista de escuelas para el formulario de agregar-->
<div class="container">
    <div class="row justify-content-center p-4">
        <div class="d-grid gap-2 p-4">
            <button id="agregarEs" type="sumit" class="btn btn-primary btn-block text-center"><i
                    class="bi bi-plus-circle-fill"></i> Agregar alumno</button>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class=" justify-content-center" id="respuesta"></div>
            </div>
        </div>
        <div class="col-md-5">
            <!--formulario de registro de esculas-->
            <div class="card border-success" id="showForm">
                <div class="card-body">
                    <h1>Datos del alumno a registrar</h1>
                    <form class="d-grid gap-2" id="add-form">
                        <div class="form-group">
                            <label for="nombre">Nombre: </label>
                            <input type="text" name="nombre" id="nombre" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="apellidos">apellidos: </label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="direccion">direccion: </label>
                            <input type="text" name="direccion" id="direccion" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="telefonos">telefonos: </label>
                            <input type="text" name="telefonos" id="telefonos" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block text-center">
                            Agregar
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>

<script src="<?php URL ?>ajax/ajaxAlumnos.js"></script>