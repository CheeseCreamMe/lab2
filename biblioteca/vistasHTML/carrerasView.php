<title>Carreras</title>
<!--creamos toda la vista de carreras para el formulario de agregar-->

<div class="container text-center">
    <h1>Escuela seleccionada</h1>
<div class="row card" id="escuelaDatos">

</div>
    <div class="row justify-content-center p-4">
        <div class="d-grid gap-2 p-4">
            <button id="agregarEs" type="sumit" class="btn btn-primary btn-block text-center"></button>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class=" justify-content-center" id="respuesta"></div>
            </div>
        </div>
        <div class="col-md-5">
            <!--formulario de registro de esculas-->
            <div class="card border-success" id="showForm">
                <div class="card-body">
                    <h1>Datos para agregar una nueva carrera</h1>
                    <form class="d-grid gap-2" id="add-form">
                        <div class="form-group">
                            <label for="nombreCarrera">Nombre: </label>
                            <input type="text" name="nombre" id="nombreCarrera" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="asignaturas">asignaturas: </label>
                            <input type="number" name="director" id="asignaturas" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block text-center">
                            Agregar
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>
    <!--carreras previamente registradas-->
    <div class="row">
        <div class="col card">
            <h1>lista de carreras registradas</h1>
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <form id="busqueda" class="input-group">
                        <input name="search" id="search" class="form-control col-md-4" type="search"
                            placeholder="Buscar por Nombre" aria-label="Search">
                        <button class="btn btn-success input-group-text" id="basic-addon1" type="submit"><i
                                class="bi bi-search"></i></button>
                    </form>
                </div>
            </div>

            <div class="row card-body" id="carrerasLista">

            </div>
        </div>
    </div>
</div>



<script src="<?php URL ?>ajax/ajaxCarreras.js"></script>