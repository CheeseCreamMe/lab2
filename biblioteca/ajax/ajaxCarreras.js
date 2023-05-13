$(document).ready(function () {
    //obtenemos el id de la carrera que hemos gaurdado en el local storage que es como una sesion de php y como las cookies de js
    let carrera = localStorage.getItem("idEscuela");
    //console.log(carrera)//este codigo es para probar si obtenemos el id

    $("#search").keyup(function () {
        if ($(this).val() != "") {
            buscarCarreras();
        } else {
            cargarCarreras();
        }
    });
    
    cargarCarreras();
    datosEscuela();
    //ocultamos el formulario para que se vea mas "presentable la pagina"
    $('#showForm').hide();
    //hacemos dinamico el texto del boton agregar para que siempre muestre el id de la carrera seleccionada
    // Agregar el contenido HTML al botón
    $("#agregarEs").html("<i class='bi bi-plus-circle-fill'></i> Agregar carrera a la escuela cod: " + carrera);


    //creamos la funcion onclick para mostrar y ocultar el formulario de registro recordemos que estamos usando jquery
    $('#agregarEs').click(function () {
        if ($('#showForm').is(':hidden')) {
            $('#showForm').show();
        } else {
            $('#showForm').hide();
        }
    });

    //creamos la funcion para agregar carreras
    $("#add-form").submit(function (e) {
        //console.log('agregar');
        e.preventDefault();

        const data = {
            nombreCarrera: $('#nombreCarrera').val(),
            idEscuelaCarrera: carrera,
            asignaturas: $("#asignaturas").val(),
            opcion: "agregar"
        };

        $.post('http://localhost/biblioteca/ajax/carrerasAjax.php', data,
            function (response) {
                //console.log(response);
                $('#respuesta').html(response.replace(/\r?\n|\r/g, ''));
                setTimeout(function () {
                    $('#respuesta').html('');
                }, 2500);
                $("#add-form").trigger('reset');
                cargarCarreras();
            });
    });
    function datosEscuela(){
        let search=carrera;
        $.ajax({
            url: "http://localhost/biblioteca/ajax/tablaCarrerasEscuelas.php",
            type: 'POST',
            data: { search, opcion: "buscar" },
            success: function (response) {
                //console.log(response);
                let tabla = JSON.parse(response);
                let template = '';
                tabla.forEach(escuela => {
                    template += `
            <div class="card  text-center p-4">
              <div class="row g-0">
              <div class="card-header text-primary">
                Codigo: ${escuela.idEscuela}
              </div>
              <div class="col-md-4">
              <img src="https://wallpaperaccess.com/full/2781173.jpg" class="img-fluid rounded-start" alt="...">
              </div>
                <div class="col-md-8">
                <div class="card-body">
                <h5 class="card-title">nombre:${escuela.nombre}</h5>
                <p class="card-text">Director: ${escuela.director}</p>
                <button class="enlaceCarreras btn btn-primary">Cambiar escuela</button>
                </div>
                </div>
                <div class="card-footer text-body-info">
                ${escuela.alumnos} alumnos
              </div>
              </div>
            </div>`;
                });
                $('#escuelaDatos').html(template);
            }
        });
    }
    //boton para regresar a la vista de escuelas
    $('#escuelaDatos').on('click', '.enlaceCarreras', function () {
        window.location.href = "http://localhost/biblioteca/escuelas";
    });
    $('#carrerasLista').on('click', '.enlaceCarreras', function () {
        var idCarrera = $(this).data('id');
        //guardamos el id de la escuela en el local storage para usarlo despues
        localStorage.setItem("idCarrera", idCarrera);
        $("#busqueda").trigger('reset');
        window.location.href = "http://localhost/biblioteca/alumnos";
    });
    // Función cargarEscuelas
    function cargarCarreras() {
        $.ajax({
            url: 'http://localhost/biblioteca/ajax/tablaCarreras.php?idEscuela=' + carrera,
            type: 'GET',
            success: function (response) {

                //console.log(response);
                let tabla = JSON.parse(response);
                let template = '';
                tabla.forEach(carrera => {
                    template += `
                   <div class="row p-3">
                   <div class="card ">
                   <div class="row">
                       <div class="card-header text-primary">
                           Codigo: ${carrera.carrera}
                       </div>
                       <div class="col-md-6 card-body">
                           <h5 class="card-title">Nombre: ${carrera.nombreCarrera}</h5>
                           <p class="card-text">Asignaturas: ${carrera.asignaturas}</p>
                       </div>
                       <div class="d-grid gap-2 col mx-auto">
                           <div class="row p-2">
                               <button data-id="${carrera.carrera}" class="enlaceCarreras btn btn-primary">ver
                                   alumnos[${carrera.alumnos}]</button>
                           </div>
                       </div>
                       <div class="d-grid gap-2 col mx-auto">
                           <div class="row p-2">
                               <button data-id="${carrera.carrera}" class="deleteBtn btn btn-danger">Eliminar carrera</button>
                           </div>
                       </div>
                       <div class="card-footer text-body-info">
                           ${carrera.alumnos} alumnos
                       </div>
                   </div>
               </div>
                   </div>`;
                });
                $('#carrerasLista').html(template);
            }
        });
    };

    //funcion para eliminar la escuela
    $('#carrerasLista').on('click', '.deleteBtn', function () {
        // Obtener el ID de la escuela
        var idCarrera = $(this).data('id');
        const data = {
            id: idCarrera,
            opcion: "eliminar"
        }
        // Ejemplo: Mostrar un mensaje de confirmación y eliminar la tarjeta de la escuela
        if (confirm('¿Estás seguro de que deseas eliminar esta escuela?')) {
            $.post('http://localhost/biblioteca/ajax/carrerasAjax.php', data,
                function (response) {
                    console.log(response);

                    // Mostrar mensaje de error si no se pudo eliminar la escuela
                    if (response.error) {
                        Swal.fire("Parece ocurrio un problema al intentar realizar al accion.");

                    } else {
                        Swal.fire({
                            html: response,
                            showCloseButton: true,
                            focusConfirm: false,
                            confirmButtonText: '<i class="fa fa-thumbs-up"></i> Great!',
                            confirmButtonAriaLabel: 'Thumbs up, great!',
                            backdrop: `
                                rgba(0,0,123,0.4)
                                url("https://i.gifer.com/PYh.gif")
                                left top
                                no-repeat
                            `
                        });
                    }

                    cargarCarreras();
                });

        }
    });

    function buscarCarreras() {
        let busqueda = $("#search");
        busqueda.keyup(function (e) {
            let search = busqueda.val();
            let idEscuelaCarrera=carrera;
            $.ajax({
                url: "http://localhost/biblioteca/ajax/carrerasAjax.php",
                type: 'POST',
                data: { search,idEscuelaCarrera, opcion: "buscar"},
                success: function (response) {
                    //console.log(response);
                    let tabla = JSON.parse(response);
                    let template = '';
                    tabla.forEach(carrera => {
                        template += `
                   <div class="row p-4">
                   <div class="card">
                   <div class="row p-4">
                       <div class="card-header text-primary">
                           Codigo: ${carrera.carrera}
                       </div>
                       <div class="col-md-6 card-body">
                           <h5 class="card-title">Nombre: ${carrera.nombreCarrera}</h5>
                           <p class="card-text">Asignaturas: ${carrera.asignaturas}</p>
                       </div>
                       <div class="d-grid gap-2 col mx-auto">
                           <div class="row p-2">
                               <button data-id="${carrera.carrera}" class="enlaceCarreras btn btn-primary">ver
                                   alumnos[${carrera.alumnos}]</button>
                           </div>
                       </div>
                       <div class="d-grid gap-2 col mx-auto">
                           <div class="row p-2">
                               <button data-id="${carrera.carrera}" class="deleteBtn btn btn-danger">Eliminar carrera</button>
                           </div>
                       </div>
                       <div class="card-footer text-body-info">
                           ${carrera.alumnos} alumnos
                       </div>
                   </div>
               </div>
                   </div>`;
                    });
                    $('#carrerasLista').html(template);
                }
            });
        });
    }

});

