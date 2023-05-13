$(document).ready(function () {
    let carrera=localStorage.getItem("idCarrera");
    $('#showForm').hide();
    //funcion para mostrar y ocultar el formulario de resgistro
    $('#agregarEs').click(function () {
        if ($('#showForm').is(':hidden')) {
            $('#showForm').show();
        } else {
            $('#showForm').hide();
        }
    });
    //funcion para agregar escuela
    $("#add-form").submit(function (e) {
        //preventDedault evita que se recargue la pagina 
        e.preventDefault();
        //definimos el arreglo de datos que deseamos enviar atraves de ajax
        const data = {
            nombres: $('#nombre').val(),
            apellidos: $('#apellidos').val(),
            direccion: $('#direccion').val(),
            telefonos: $('#telefonos').val(),
            idCarreraAlumno: carrera,
            opcion: "agregar"
        };

        //metodo abreviado de jquery para enviar solicitudes ajax
        $.post('http://localhost/biblioteca/ajax/alumnosAjax.php', data,
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
                //cargarEscuelas();
            });
    })
})





