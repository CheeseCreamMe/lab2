cargarEscuelas();

$(document).ready(function () {
    //ocultamos el formulario para mejorar la presentacion
    $('#showForm').hide();

    //funcion para mostrar y ocultar el formulario de resgistro
    $('#agregarEs').click(function () {
        if ($('#showForm').is(':hidden')) {
            $('#showForm').show();
        } else {
            $('#showForm').hide();
        }
    });

    //evento on click para redirigir a la pagina de carreras
    //el botn que utiliza esta funcion lo generamos en la funcion cargarEscuelas
    $('#escuelasLista').on('click', '.enlaceCarreras', function () {
        var idEscuela = $(this).data('id');
        //guardamos el id de la escuela en el local storage para usarlo despues
        localStorage.setItem("idEscuela", idEscuela);
        $("#busqueda").trigger('reset');
        window.location.href = "http://localhost/biblioteca/carreras";
    });

    //funcion para agregar escuela
    $("#add-form").submit(function (e) {
        //preventDedault evita que se recargue la pagina 
        e.preventDefault();
        //definimos el arreglo de datos que deseamos enviar atraves de ajax
        const data = {
            nombre: $('#nombreEscuela').val(),
            director: $('#directorEscuela').val(),
            opcion: "agregar"
        };

        //metodo abreviado de jquery para enviar solicitudes ajax
        $.post('http://localhost/biblioteca/ajax/escuelasAjax.php', data,
            function (response) {
                //sl obtener la respuesta obtenemos un html por lo que limpiamos los espacios en blaco que esten de mas y los saltos de linea 
                $('#respuesta').html(response.replace(/\r?\n|\r/g, ''));
                //mostramos las respuesta osea la imagen de rammus ok por un intervalo de 2.5s
                setTimeout(function () {
                    $('#respuesta').html('');
                }, 2500);
                //limpiamos los datos del formulario 
                $("#add-form").trigger('reset');
                //recargamos la tbla de las escuelas
                cargarEscuelas();
            });
    })
    //funcion para eliminar la escuela
    $('#escuelasLista').on('click', '.deleteBtn', function () {
        // Obtener el ID de la escuela
        var idEscuela = $(this).data('id');
        const data = {
            cod: idEscuela,
            opcion: "eliminar"
        }
        // Ejemplo: Mostrar un mensaje de confirmación y eliminar la tarjeta de la escuela
        if (confirm('¿Estás seguro de que deseas eliminar esta escuela?')) {
            $.post('http://localhost/biblioteca/ajax/escuelasAjax.php', data,
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
                    $("#busqueda").trigger('reset');
                    cargarEscuelas();
                });

        }
    });
    //hacemos uso de la funcion para obtner todas las escuelas y las guardamos en una tabla
    //si el texto del input de busqueda cambia buscamos la escuela y modificamos la tabla
    $("#search").keyup(function () {
        if ($(this).val() != "") {
            buscarEscuelas();
        } else {
            cargarEscuelas();
        }
    });
    function buscarEscuelas() {
        let busqueda = $("#search");
        busqueda.keyup(function (e) {
            let search = busqueda.val();
            //console.log(search);
            $.ajax({
                url: "http://localhost/biblioteca/ajax/escuelasAjax.php",
                type: 'POST',
                data: { search, opcion: "buscar" },
                success: function (response) {
                    //console.log(response);
                    let tabla = JSON.parse(response);
                    let template = '';
                    tabla.forEach(escuela => {
                        template += `
                        <div class="row p-3">
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
                <h5 class="card-title">${escuela.nombre}</h5>
                <p class="card-text">Director: ${escuela.director}</p>
                <button data-id="${escuela.idEscuela}" class="enlaceCarreras btn btn-primary">ver carreras[${escuela.carreras}]</button>
                <button data-id="${escuela.idEscuela}" class="deleteBtn btn btn-danger">Eliminar escuela</button>
                </div>
                </div>
                <div class="card-footer text-body-info">
                ${escuela.alumnos} alumnos
                </div>
                </div>
            </div>
                        </div>`;
                    });
                    $('#escuelasLista').html(template);
                }
            });
        })
    }
});

// Función cargarEscuelas
function cargarEscuelas() {
    $.ajax({
        url: 'http://localhost/biblioteca/ajax/tablaEscuelas.php',
        type: 'GET',
        success: function (response) {
            let tabla = JSON.parse(response);
            let template = '';
            tabla.forEach(escuela => {
                template += `
                <div class="row p-4">
                <div class="card  text-center ">
                <div class="row g-0">
                <div class="card-header text-primary">
                Codigo: ${escuela.idEscuela}
                </div>
                <div class="col-md-4">
                <img src="https://wallpaperaccess.com/full/2781173.jpg" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                <div class="card-body">
                <h5 class="card-title">${escuela.nombre}</h5>
                <p class="card-text">Director: ${escuela.director}</p>
                <button data-id="${escuela.idEscuela}" class="enlaceCarreras btn btn-primary">ver carreras[${escuela.carreras}]</button>
                <button data-id="${escuela.idEscuela}" class="deleteBtn btn btn-danger">Eliminar escuela</button>
                </div>
                </div>
                <div class="card-footer text-body-info">
                ${escuela.alumnos} alumnos
                </div>
                </div>
                </div>
                </div>`;
            });
            $('#escuelasLista').html(template);
        }
    });
}
