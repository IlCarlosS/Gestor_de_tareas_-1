<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function login(Router $router){
        $alertas=[];
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarLogin();

            if(empty($alertas)){
                //verificar que exista el usuario
                $usuario = Usuario::where('email', $usuario->email);
                if(!$usuario || !$usuario->confirmado){
                    Usuario::setAlerta('error','El usuario no Existe o no esta Confirmado');
                }else{
                    //el usuario existe
                    if(password_verify($_POST['password'], $usuario->password)){
                        //iniciar sesion
                        session_start();
                        $_SESSION['id']= $usuario->id;
                        $_SESSION['nombre']= $usuario->nombre;
                        $_SESSION['email']= $usuario->emial;
                        $_SESSION['login']= true;

                        //redireccionar
                        header('Location: /dashboard');
                    }else{
                    Usuario::setAlerta('error','Contraseña incorrecta');
                    }
                }
            }
        }
        $alertas = Usuario::getAlertas();

        //render a la vista
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas
        ]);
    }

    public static function logout(){
        session_start();
        $_SESSION = [];
        header('Location: /');
    }

    public static function crear(Router $router) {
        $alertas = [];
        $usuario = new Usuario;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            if(empty($alertas)) {
                $existeUsuario = Usuario::where('email', $usuario->email);

                if($existeUsuario) {
                    Usuario::setAlerta('error', 'El Usuario ya esta registrado');
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear el password
                    $usuario->hashPassword();

                    // Eliminar password2
                    unset($usuario->password2);

                    // Generar el Token
                    $usuario->crearToken();

                    // Crear un nuevo usuario
                    $resultado =  $usuario->guardar();

                    // Enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();
                    

                    if($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }


        //render a la vista
        $router->render('auth/crear', [
            'titulo' => 'Crear Cuenta',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function olvide($router){
        $alertas =[];
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if(empty($alertas)){
                    //buscar usuario
                $usuario = Usuario::where('email', $usuario->email);

                if($usuario && $usuario->confirmado === "1"){
                    // se encuentra usuario y generar nuevo token
                    $usuario->crearToken();
                    // actualizar usuario
                    $usuario->guardar();
                    //enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();
                    //imprimir la alerta
                    Usuario::setAlerta('exito', 'Revisa tu email');
                } else{
                    Usuario::setAlerta('error', 'El usuario no existe');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        //muestra vista pag olvide contraseña. Render a la vista
        $router->render('auth/olvide',[
            'titulo' => 'Olvide Contraseña',
            'alertas'=>$alertas
        ]);
    }

    public static function restablecer($router){
        $token = s($_GET['token']);
        $mostrar = true;
        if(!$token) header('Location: /');

        //identificar token de usuario
        $usuario = Usuario::where('token', $token);
        if (empty($usuario)){
            Usuario::setAlerta('error', 'Token No Válido');
            $mostrar = false;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            //añadir nueva password
            $usuario->sincronizar($_POST);
            
            //validar password nueva
            $alertas = $usuario->validarPassword();
            if (empty($alertas)){
                //hasear nueva contraseña
                $usuario->hashPassword();
                unset ($usuario->password2);
                //eliminar token
                $usuario->token = '';
                //guardar nueva contraseña
                $resultado = $usuario->guardar();
                //redireccionar
                if ($resultado){
                    header('Location: /');
                }
            } 
        }

        $alertas = Usuario::getAlertas();
        //muestra pag restablecer contraseña. Render a la vista
        $router->render('auth/restablecer',[
            'titulo' => 'Restablecer contraseña',
            'alertas'=> $alertas,
            'mostrar'=> $mostrar
        ]);
    }

    public static function mensaje($router){
        $router->render('auth/mensaje',[
            'titulo' => 'Cuenta creada'
        ]);
    }

    public static function confirmar($router){
        $token = s($_GET['token']);

        if (!$token) header('Location: /');

        //Encontrar al usuario con el token
        $usuario = Usuario::where('token', $token);

        if (empty($usuario)){
            //cuando no se encuentra usario con token
            Usuario::setAlerta('error', 'Token No valido');
        } else{
            // confirmar cuenta
            $usuario->confirmado = 1;
            $usuario->token = '';
            unset($usuario->password2);

            //guardar en BD
            $usuario->guardar();
            
            Usuario::setAlerta('exito', 'Cuenta comprobado con exito ');
        }

        $alertas = Usuario::getAlertas();
        
        $router->render('auth/confirmar',[
            'titulo' => 'Confirmacion de cuenta',
            'alertas' => $alertas
        ]);
    }
}