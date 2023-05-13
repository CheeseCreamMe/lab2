<script>
    const themeBtn = document.getElementById("theme");
    const htmlTag = document.querySelector("html");
    const sect1 = document.getElementById("sect1");

    // Obtener el valor del tema de la sesión de PHP
    const theme = "<?php echo $theme; ?>";

    // Ahora puedes usar la variable theme en tu código JavaScript
    console.log(theme);
    // Establecer el valor del atributo data-bs-theme de acuerdo al valor del tema de la sesión
    if (theme === "dark") {
        htmlTag.setAttribute("data-bs-theme", "dark");
        themeBtn.innerHTML = '<i class="bi bi-brightness-high"></i>change mode';

        if (document.querySelector('#sect1') !== null) {
            // El elemento existe en la página
            const img = document.createElement("img");
            img.className = "background";
            img.src = "<?php echo URL; ?>imagenes/temaOscuro.jpg";
            img.alt = "imagen del tema claro";

            // Agregar la etiqueta img a la sección con id "sect1"
            sect1.appendChild(img);
        }
        // Crear la etiqueta img con la imagen de fondo correspondiente

    } else {
        themeBtn.innerHTML = '<i class="bi bi-brightness-high-fill"></i>change mode';

        // Eliminar el atributo data-bs-theme
        htmlTag.removeAttribute("data-bs-theme");


        if (document.querySelector('#sect1') !== null) {
            // El elemento existe en la página
            const img = document.createElement("img");
            img.className = "background";
            img.src = "<?php echo URL; ?>imagenes/temaClaro.jpg";
            img.alt = "imagen del tema oscuro";

            // Agregar la etiqueta img a la sección con id "sect1"
            sect1.appendChild(img);
        }
        // Crear la etiqueta img con la imagen de fondo correspondiente

    }


</script>