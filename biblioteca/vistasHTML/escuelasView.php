<title>Escuelas</title>

<div class="container text-center">
    <div class="row justify-content-center p-4">
        <div class="d-grid gap-2 p-4">
            <button id="agregarEs" type="sumit" class="btn btn-primary btn-block text-center"><i
                    class="bi bi-plus-circle-fill"></i> Agregar escuela</button>
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
                    <h1>Datos de la escuela a registrar</h1>
                    <form class="d-grid gap-2" id="add-form">
                        <div class="form-group">
                            <label for="nombreEscuela">Nombre: </label>
                            <input type="text" name="nombre" id="nombreEscuela" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="directorEscuela">director: </label>
                            <input type="text" name="director" id="directorEscuela" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block text-center">
                            Agregar
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>
    <!--escuelas previamente registradas-->
    <div class="card ">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <h1>lista de escuelas registradas</h1>
                <form id="busqueda" class="input-group ">
                    <input name="search" id="search" class="form-control col-md-4" type="search"
                        placeholder="Buscar por Nombre" aria-label="Search">
                    <button class="btn btn-success input-group-text" id="basic-addon1" type="submit"><i
                            class="bi bi-search"></i></button>
                </form>
            </div>
        </div>
    </div>
    <div id="escuelasLista"></div>
</div>


<!--ajax de escuelas solamente-->
<script src="<?php URL ?>ajax/ajaxEscuelas.js"></script>