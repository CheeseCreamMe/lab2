$(document).ready(function () {
    $('#task-result').hide();

    $('#busqueda-fecha').submit(function (e) {
        e.preventDefault();
        let fechaI = $("#fechaDevolucion").val();
        const data = {
            fecha:$("#fechaDevolucion").val(),
            opcion: "buscar-fecha-i"
        }
        $.post('http://localhost/biblioteca/ajax/historialAjax.php', data,
        function (response) {
            console.log(response);
            let template = '';
            tabla = JSON.parse(response);
            tabla.forEach(
                prestamos => {
                    template += `<tr idG="${prestamos.id}" >
                    <td>${prestamos.idPrestamo}</td>
                    <td>${prestamos.nombres+" "+prestamos.apellidos}</td>
                    <td>${prestamos.titulo}</td>
                    <td>${prestamos.fechaDevolucion}</td>
                    <td>${prestamos.estado}</td>
                    <td>
                    <button class="deleteBtn btn btn-danger">
                    Borrar
                    </button>
                    </td>
                    </tr>`
                }); 
            $('#tasks').html(template);
        });
    });

    $('#busqueda').submit(function (e) {
        e.preventDefault();
        const data = {
            nombre:$("#search").val(),
            opcion: "buscar-alumno"
        }
        $.post('http://localhost/biblioteca/ajax/historialAjax.php', data,
        function (response) {
            console.log(response);
            let template = '';
            tabla = JSON.parse(response);
            tabla.forEach(
                prestamos => {
                    template += `<tr idG="${prestamos.id}" >
                    <td>${prestamos.idPrestamo}</td>
                    <td>${prestamos.nombres+" "+prestamos.apellidos}</td>
                    <td>${prestamos.titulo}</td>
                    <td>${prestamos.fechaDevolucion}</td>
                    <td>${prestamos.estado}</td>
                    <td>
                    <button class="deleteBtn btn btn-danger">
                    Borrar
                    </button>
                    </td>
                    </tr>`
                }); 
            $('#tasks').html(template);
        });
    });
})