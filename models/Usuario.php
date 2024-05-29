<?php

namespace Model;

class Usuario extends ActiveRecord{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = [
        'id', 'nombre', 'email', 'password', 'token', 'confirmado'];

    // Declarar visibilidad
    public $id;
    public $nombre;
    public $email;
    public $password;
    public $password2;
    public $token;
    public $confirmado;

        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->nombre = $args['nombre'] ?? '';
            $this->email = $args['email'] ?? '';
            $this->password = $args['password'] ?? '';
            $this->password2 = $args['password'] ?? '';
            $this->token = $args['token'] ?? '';
            $this->confirmado = $args['confirmado'] ?? 0;
        }

        //Validacion el login de usuarios
        public function validarLogin(){
            if(!$this->email){
                self::$alertas['error'][] = 'El Email el Usuario es Obligatiorio';
            }

            if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                self::$alertas['error'][] = 'Email no valido';
            }

            if(!$this->password){
                self::$alertas['error'][] = 'La contraseña no puede estar vacia';
            }

            return self::$alertas;
        }

        //validacion para nuevas cuentas
        public function validarNuevaCuenta(){
            if(!$this->nombre){
                self::$alertas['error'][] = 'El Nombre el Usuario es Obligatiorio';
            }

            if(!$this->email){
                self::$alertas['error'][] = 'El Email el Usuario es Obligatiorio';
            }

            if(!$this->password){
                self::$alertas['error'][] = 'La contraseña no puede estar vacia';
            }

            if(strlen($this->password) <6){
                self::$alertas['error'][] = 'La contraseña debe tener al menos 6 caracteres';
            }

            if($this->password !== $this->password2){
                self::$alertas['error'][] = 'La contraseña es diferente';
            }

            return self::$alertas;
        }

        //validar email
        public function validarEmail(){
            if(!$this->email){
                self::$alertas['error'][] = 'El Email es Obligatorio';
            }

            if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                self::$alertas['error'][] = 'Email no valido';
            }
            return self::$alertas;
        }

        //valida password
        public function validarPassword(){
            if(!$this->password){
                self::$alertas['error'][] = 'La contraseña no puede estar vacia';
            }
            if(strlen($this->password) <6){
                self::$alertas['error'][] = 'La contraseña debe tener al menos 6 caracteres';
            }

            return self::$alertas;
        }

        //hash de pasword
        public function hashPassword(){
            $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        }

        //generar token
        public function crearToken(){
            $this->token = uniqid();
        }
}

?>