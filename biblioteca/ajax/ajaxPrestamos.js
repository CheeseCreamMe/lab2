$(document).ready(function () {
    $('#task-result').hide();
    cargarTabla();
    cargarSelectLibros();cargarSelectAlumnos() 

    $('#busqueda').submit(function (e) {
        console.log('buscar');
        e.preventDefault();

    })
    //funcion de busqueda
    $('#search').keyup(function (e) {
        if ($('#search').val()) {
            let search = $("#search").val();
            $.ajax({
                url: 'http://localhost/biblioteca/ajax/prestamosAjax.php',
                type: 'POST',
                data: { search, opcion: "buscar" },
                success: function (response) {
                    console.log(response)
                    let tabla = JSON.parse(response);
                    let template = "";
                    tabla.forEach(tabla => {
                        template += `<tr>
                                        <td>${tabla.idPrestamo}</td>
                                        <td>${tabla.nombres}</td>
                                        <td>${tabla.titulo}</td>
                                        <td>${tabla.fechaDevolucion}</td>
                                    </tr>`;
                    });
                    $('#container').html(template);
                    $('#task-result').show();
                }
            })
        }
    });

    //funcion para agregar
    $('#task-form').submit(function (e) {
        console.log('agregar');
        e.preventDefault();
        const data = {
            idAlumno: $('#alumnosOption').val(),
            idLibro: $('#librosOption').val(),
            fechaPrestamo: $('#fechaP').val(),
            fechaDevolucion: $('#fechaD').val(),
            estado: $('#estado').val(),
            opcion: "agregar"
        }
        //console.log(data);

        $.post('http://localhost/biblioteca/ajax/prestamosAjax.php', data,
            function (response) {
                //console.log(response);
                $('#respuesta').html(response.replace(/\r?\n|\r/g, ''));
                setTimeout(function () {
                    $('#respuesta').html('');
                }, 2500);
                $('#task-form').trigger('reset');
                cargarTabla();
            }); 

    })

    function cargarTabla() {
        $.ajax({
            url: 'http://localhost/biblioteca/ajax/tablaPrestamos.php',
            type: 'GET',
            success: function (response) {
                let tabla = JSON.parse(response);
                let template = '';
                tabla.forEach(
                    prestamos => {
                        template += `<tr idG="${prestamos.id}" >
                    <td>${prestamos.id}</td>
                    <td>${prestamos.alumno}</td>
                    <td>${prestamos.libro}</td>
                    <td>${prestamos.fechaDevolucion}</td>
                    <td>${prestamos.estado}</td>
                    <td>
                    <button class="deleteBtn btn btn-danger">
                    Borrar
                    </button>
                    </td>
                                </tr>`
                    })
                //console.log(template);
                $('#tasks').html(template);
            }
        })
    }
    $(document).on('click', '.deleteBtn', function () {
        let element = $(this)[0].parentElement.parentElement;
        //console.log(elememt)
        let id = $(element).attr("idG");
        //console.log(id);
        const data = {
            cod: id,
            opcion: "eliminar"
        }
        $.post('http://localhost/biblioteca/ajax/prestamosAjax.php', data,
            function (response) {
                $('#respuesta').html(response.replace(/\r?\n|\r/g, ''));
                setTimeout(function () {
                    $('#respuesta').html('');
                }, 2500);
                $('#task-form').trigger('reset');

                cargarTabla();
            });
    })


    function cargarSelectLibros() {
        const select = document.getElementById("librosOption");

        fetch("http://localhost/biblioteca/ajax/tablaPrestamosLibros.php")
            .then(response => response.json())
            .then(data => {
                data.forEach(libro => {
                    const option = document.createElement("option");
                    option.value = libro.idLibro;
                    option.text = libro.titulo;
                    select.appendChild(option);
                });
            })
            .catch(error => {
                console.error(error);
            });
    } function cargarSelectAlumnos() {
        const select = document.getElementById("alumnosOption");

        fetch("http://localhost/biblioteca/ajax/tablaPrestamosAlumnos.php")
            .then(response => response.json())
            .then(data => {
                data.forEach(alumno => {
                    const option = document.createElement("option");
                    option.value = alumno.idAlumno;
                    option.text = alumno.nombres+" "+alumno.apellidos;
                    select.appendChild(option);
                });
            })
            .catch(error => {
                console.error(error);
            });
    }
});