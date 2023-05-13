<title>Libros</title>
<!--cremos toda la vista de escuelas para el formulario de agregar-->
<h1>Registrar Libro</h1>

<div class="container">
    <div class="row p-4">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <!-- FORM TO ADD TASKS -->
                    <form id="task-form">
                        <div class="form-group">
                            <input type="text" id="titulo" placeholder="Titulo del libro" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" id="autor" placeholder="Nombre Del autor" class="form-control">
                        </div>                        <div class="form-group">
                            <input type="text" id="editorial" placeholder="Editorial" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="fecha">Fecha de publicación</label>
                            <input placeholder="Fecha de publicación" class="form-control" name="fecha" id="fecha"
                                type="date" required="">
                        </div>
                        <div class="form-group">
                            <input type="text" id="ISBM" placeholder="ISBM" class="form-control">
                        </div>
                        <input type="hidden" id="taskId">
                        <button type="submit" class="btn btn-primary btn-block text-center">
                            Agregar
                        </button>
                    </form>
                    <div id="respuesta"></div>
                </div>
            </div>
        </div>

        <!-- TABLE  -->

        <div class="col-md-7">
            <form id="busqueda" class="form-inline my-2 my-lg-0">
                <input name="search" id="search" class="form-control mr-sm-2" type="search" placeholder="Search"
                    aria-label="Search">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <div class="card my-4" id="task-result">
                <div class="card-body">
                    <!-- SEARCH -->
                </div>
            </div>

            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Titulo</td>
                        <td>autor</td>
                        <td>ISBM</td>
                        <td>fecha</td>
                        <td>acciones</td>

                    </tr>
                </thead>
                <tbody id="tasks"></tbody>
            </table>
        </div>
    </div>
</div>
<script src="<?php URL ?>ajax/ajaxLibros.js"></script>