<head>
    <link rel="stylesheet" href="/public/build/css/app.css">
</head>
<div class="contenedor confirmar">
    <?php
        include_once __DIR__ .'/../templates/nombre-sitio.php' 
    ?>

    <div class="contenedor-sm">
        <h3>
            ¡Felicidades! cuenta creada
        </h3>

        <?php
        include_once __DIR__ .'/../templates/alertas.php' 
        ?>

        <div class="acciones">
            <a href="/">Iniciar Sesíon
            </a>
        </div>
    </div> <!-- contenedor-sm -->
</div>