<title>Historial de Préstamos</title>

    <div class="container">
        <h1 class="text-center my-4">Historial de Préstamos</h1>
        <div class="my-4">
            <form id="busqueda" class="form-inline my-2 my-lg-0">
                <input name="search" id="search" class="form-control mr-sm-2" type="search" placeholder="Buscar"
                    aria-label="Search">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
            </form>

            <form id="busqueda-fecha" class="form-inline my-2 my-lg-0">
                <input name="fechaDevolucion" id="fechaDevolucion" class="form-control mr-sm-2" type="date"
                    placeholder="Fecha de devolución" aria-label="Search">
                <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
            </form>
            <div class="card my-4" id="task-result">
                <div class="card-body">
                    <!-- Resultados de la búsqueda -->
                    <ul id="container"></ul>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Alumno</th>
                        <th>Libro</th>
                        <th>Devolución</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tasks"></tbody>
            </table>
        </div>
        <script src="<?php URL ?>ajax/ajaxHistorial.js"></script>