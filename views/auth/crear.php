<head>
    <link rel="stylesheet" href="/public/build/css/app.css">
</head>
<div class="contenedor crear">
    <?php
        include_once __DIR__ .'/../templates/nombre-sitio.php' 
    ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crear Cuenta</p>
        <?php include_once __DIR__ .'/../templates/alertas.php' ?>
        <form class="formulario" method="POST" action="/crear">

            <div class= "campo">
                <label for= "nombre">Nombre</label>
                <input
                    type ="text"
                    id = "nombre"
                    placeholder="Nombre"
                    name = "nombre"
                    value = "<?php echo $usuario-> nombre; ?>"
                >
            </div>

            <div class= "campo">
                <label for= "email">Email</label>
                <input
                    type ="email"
                    id = "email"
                    placeholder="Email"
                    name = "email"
                    value = "<?php echo $email-> email; ?>"
                >
            </div>
            <div class= "campo">
                <label for= "password">Contraseña</label>
                <input
                    type ="password"
                    id = "password"
                    placeholder="Contraseña"
                    name = "password"
                >
            </div>

            <div class= "campo">
                <label for= "password2">Confirmar Contraseña</label>
                <input
                    type ="password"
                    id = "password2"
                    placeholder="Confirmar Contraseña"
                    name = "password2"
                >
            </div>

            <input
                type="submit" class= "boton" value="Crear Cuenta"
            >
        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes cuenta? Iniciar Sesión</a>
            <a href="/olvide">¿Olvidaste tu contraseña?</a>
        </div>
    </div> <!-- contenedor-sm -->
</div>