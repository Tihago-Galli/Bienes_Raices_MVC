<?php

namespace Controllers;
use Model\Propiedad;
use Model\Entrada;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;


class PaginasControllers{

    public static function index(Router $router) {
        $propiedades = propiedad::get(3);
        $entradas = Entrada::get(2);
        $inicio = true;

        $router->render('paginas/index',[
            'propiedades' => $propiedades,
            'entradas' => $entradas,
            'inicio' => $inicio
        ]);
    }
    public static function propiedades(Router $router) {

        $propiedades = Propiedad::get(9);
        $router->render('paginas/propiedades',[
            'propiedades' => $propiedades
            
        ]);
    }
    public static function propiedad(Router $router) {
       $id = validarOredireccionar('/admin');

       $propiedad = Propiedad::find($id);

       $router->render('paginas/propiedad',[
        'propiedad' => $propiedad
        
    ]);
    }
    public static function blog(Router $router) {
        $entradas = Entrada::get(10);
        $router->render('paginas/blog',[
            'entradas' => $entradas
            
        ]);
    }
    public static function entrada(Router $router) {
       


        $id = validarOredireccionar('/admin');

        $entrada = Entrada::find($id);
 
        $router->render('paginas/entrada',[
            'entrada' => $entrada
         
     ]);
    }
    public static function contacto(Router $router) {
        
        $mensaje =  null;
        if($_SERVER['REQUEST_METHOD']=== 'POST'){

           
            $respuestas = $_POST['contacto'];


            //crear una instancia de PHPMailer
            $mail = new PHPMailer();

            //configurar SMTP
            $mail->isSMTP();
            $mail->Host = "smtp.mailtrap.io";
            $mail->SMTPAuth = true;
            $mail->Username = "2bf89637ae8ad1";
            $mail->Password = "0922310919f21a";
            $mail->SMTPSecure = 'tls';
            $mail->Port= 2525;

            //configurar el contenido del EMAIL
            $mail->setFrom('admin@admin.com');
            $mail->addAddress('admin@admin.com', 'Bienes Raices');
            $mail->Subject='Tienes un Nuevo mensaje';

            //Habilitar html
            $mail->isHTML(true);
            $mail->CharSet='UTF-8';

            //definir el contenido

            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje de: '.$respuestas['nombre'] .'</p>';
            
            $contenido .= '<p>Mensaje: '.$respuestas['mensaje'] .'</p>';

            if($respuestas['contacto'] === 'telefono'){
                $contenido .= '<p>Eligio ser contactado por '.$respuestas['contacto'] .'</p>';
                $contenido .= '<p>Su telefono: '.$respuestas['telefono'] .'</p>';
                $contenido .= '<p>En el dia: '.$respuestas['fecha'] .'</p>';
                $contenido .= '<p>En este horario: '.$respuestas['hora'] .'</p>';
            }else{
                $contenido .= '<p>Eligio ser contactado por '.$respuestas['contacto'] .'</p>';
                $contenido .= '<p>Su Email de contacto es: '.$respuestas['email'] .'</p>';
            }
            
            $contenido .= '<p>Tiene interes en: '.$respuestas['tipo'] .'</p>';
            $contenido .= '<p>Precio o presupuesto: $'.$respuestas['precio'] .'</p>';

            
            $contenido .= '</html>';

            //cuando el servicio de correo soporta html muestra este mensaje
            $mail->Body = $contenido;
            //Sino muestra este mensaje sin html solo el mensaje
            $mail->AltBody = 'Esto es texto alternativo';

            //Enviar mail
            if($mail->send()){
                $mensaje = "Email enviado correctamente";
            }else{
                $mensaje = "Mensaje no enviado";
            }
        };

        $router->render('paginas/contacto',[
            'mensaje' => $mensaje
        ]);
    }

    public static function nosotros(Router $router) {
        $router->render('paginas/nosotros');
    }

   
}
?>