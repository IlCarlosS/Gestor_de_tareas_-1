<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use Controllers\DashboardController;
use MVC\Router;
$router = new Router();

// Login

$router->get ('/', [LoginController::class, 'login']);
$router->post ('/', [LoginController::class, 'login']);

$router->get ('/logout', [LoginController::class, 'logout']);

//Crear cuenta
$router->get ('/crear', [LoginController::class, 'crear']);
$router->post ('/crear', [LoginController::class, 'crear']);

//Formulario contraseña olvidada
$router->get ('/olvide', [LoginController::class, 'olvide']);
$router->post ('/olvide', [LoginController::class, 'olvide']);

//Nueva contraseña -> Formulario contraseña olvidada
$router->get ('/restablecer', [LoginController::class, 'restablecer']);
$router->post ('/restablecer', [LoginController::class, 'restablecer']);

//Confirmacion de cuenta 
$router->get ('/mensaje', [LoginController::class, 'mensaje']);
$router->get ('/confirmar', [LoginController::class, 'confirmar']);

//zonas de proyectos
$router->get('/dashboard', [DashboardController::class , 'index']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();