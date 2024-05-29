<head>
    <link rel="stylesheet" href="/public/build/css/app.css">
</head>
<div class="contenedor mensaje">
    <?php
        include_once __DIR__ .'/../templates/nombre-sitio.php' 
    ?>

    <div class="contenedor-sm">
        <h3>
            Casi listo...
        </h3>
        <p class="descripcion-pagina">Se ha enviado las instrucciones para confirmar tu cuenta a tu email</p>
        <form class="formulario" method="POST" action="/mensaje">

    </div> <!-- contenedor-sm -->
</div>