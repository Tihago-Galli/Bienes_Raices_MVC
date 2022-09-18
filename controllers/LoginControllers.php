<?php

namespace Controllers;

use GuzzleHttp\Psr7\Header;
use MVC\Router;
use Model\Admin;


class LoginControllers{

    public static function login(Router $router){

        $errores = [];

        if($_SERVER['REQUEST_METHOD']=== 'POST'){

            //crea una nueva instancia con lo que hay en post, creando un nuevo objeto
            $auth =  new Admin($_POST);

            $errores = $auth->validar();

            if(empty($errores)){
                //verificar si el usuario existe
                $resultado = $auth->existeUsuario();

                if(!$resultado){

                    $errores = Admin::getErrores();
                }else{

                    $autenticado = $auth->validarPassword($resultado);
                       //verificar si la contraseña es correcta

                       if($autenticado){
                            //redireccionar al usuario
                            $auth->autenticacion();

                       }else{
                            $errores = Admin::getErrores();
                       }
                        

                }

             


            }
          
        }
        $router->render('auth/login',[
            'errores' => $errores
        ]);

    }
    public static function logout(){
        session_start();

        $_SESSION = [];

        Header('location: /');

    }
}