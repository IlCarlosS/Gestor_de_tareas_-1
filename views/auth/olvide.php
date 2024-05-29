<head>
    <link rel="stylesheet" href="/public/build/css/app.css">
</head>
<div class="contenedor olvide">
    <?php
        include_once __DIR__ .'/../templates/nombre-sitio.php' 
    ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Recupera tu Contraseña</p>
        <?php include_once __DIR__ .'/../templates/alertas.php' ?>
        <form class="formulario" method="POST" action="/olvide">
            
            <div class= "campo">
                <label for= "email">Email</label>
                <input
                    type ="email"
                    id = "email"
                    placeholder="Email"
                    name = "email"
                >
            </div>

            <input
                type="submit" class= "boton" value="Enviar Instrucciones"
            >
        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes cuenta? Iniciar Sesión</a>
            <a href="/crear">¿Eres nuevo? Obtener tu cuenta</a>
        </div>
    </div> <!-- contenedor-sm -->
</div>