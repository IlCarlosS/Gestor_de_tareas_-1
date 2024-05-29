<?php 
    namespace Classes;

    use PHPMailer\PHPMailer\PHPMailer;

    class Email {
        protected $email;
        protected $nombre;
        protected $token;

        public function __construct($email, $nombre, $token)
        {
            $this->email = $email; // Aquí se corrige
            $this->nombre = $nombre; // Aquí se corrige
            $this->token = $token; // Aquí se corrige
        }

        public function enviarConfirmacion(){
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = 'eec62e435ca7d1';
            $mail->Password = 'f7d889c6e35740';

            $mail->setFrom('cuentas@gestiontareas.com');
            $mail->addAddress($this->email, $this->nombre);
            $mail->Subject = 'Confirma tu cuenta';

            $mail->isHTML(TRUE);
            $mail->CharSet = 'UTF-8'; // Aquí se corrige para que salgan comas y puntos en español

            $contenido = '<html>';
            $contenido .="<p><strong> Hola " . $this->nombre . "</strong>
                            , haz creado tu cuenta correctamente, confirma en el siguiente enlace</p>";
            $contenido .="<p> Presiona aquí: <a href= 'http://localhost:3000/confirmar?token=" 
            . $this->token . "'>Confirmar cuenta </a></p>";                
            $contenido .= "<p>Si no haz creado esta cuenta, ignora este correo</p>";
            $contenido .='</html>';

            $mail->Body = $contenido;

            //enviar mail
            $mail->send();
        }

        public function enviarInstrucciones(){
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = 'eec62e435ca7d1';
            $mail->Password = 'f7d889c6e35740';

            $mail->setFrom('cuentas@gestiontareas.com');
            $mail->addAddress($this->email, $this->nombre);
            $mail->Subject = 'Reestablecer contraseña';

            $mail->isHTML(TRUE);
            $mail->CharSet = 'UTF-8'; // Aquí se corrige para que salgan comas y puntos en español

            $contenido = '<html>';
            $contenido .="<p><strong> Hola " . $this->nombre . "</strong>
                            , Sigue el siguiente enlace para reestablecer tu contraseña</p>";
            $contenido .="<p> Presiona aquí: <a href= 'http://localhost:3000/restablecer?token=" 
            . $this->token . "'>Reestablecer contraseña </a></p>";                
            $contenido .= "<p>Si no haz creado esta cuenta, ignora este correo</p>";
            $contenido .='</html>';

            $mail->Body = $contenido;

            //enviar mail
            $mail->send();
        }
    }

?>