<head>
    <link rel="stylesheet" href="/public/build/css/app.css">
</head>
<div class="contenedor restablecer">
    <?php
        include_once __DIR__ .'/../templates/nombre-sitio.php' 
    ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Restablecer contraseña: Coloca tu nueva contraseña</p>
        <?php include_once __DIR__ .'/../templates/alertas.php' ?>
        <?php  if ($mostrar) { ?>
        <form class="formulario" method="POST">

            <div class= "campo">
                <label for= "password">Contraseña</label>
                <input
                    type ="password"
                    id = "password"
                    placeholder="Contraseña"
                    name = "password"
                >
            </div>

            <input
                type="submit" class= "boton" value="Guardar Contraseña"
            >
        </form>

        <?php } ?>

        <div class="acciones">
            <a href="/">¿Ya tienes cuenta? Iniciar Sesión</a>
            <a href="/crear">¿Eres nuevo? Obtenen tu cuenta</a>
        </div>
    </div> <!-- contenedor-sm -->
</div>