<?php

namespace Controllers;

use MVC\Router;

class DashboardController{
    public static function index (Router $router){
        session_start();
        isAuth(); //llama a la funcion del archivo funciones
        $router->render ('dashboard/index', []);
    }
}