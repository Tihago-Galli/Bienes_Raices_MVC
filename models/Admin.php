<?php

namespace Model;

class Admin extends ActiveRecord{
    
    protected static $tabla = 'usuario';
    protected static $columnasDB = ['id','email','password'];


    public $id;
    public $email;
    public $password;


    public function __construct($array= [])
    {
        $this->id = $array['id'] ?? null ;
        $this->email = $array['email'] ?? '' ;
        $this->password = $array['password'] ?? '' ;
    }

    public function validar(){
        if(!$this->email){
            self::$errores[] = "El email es obligatorio";
        }
        if(!$this->password){
            self::$errores[] = "El password es obligatorio";
        }

        return self::$errores;
    }


    public function existeUsuario(){
        $query = "SELECT * FROM ". static::$tabla ." WHERE email = '" . $this->email . "' LIMIT 1";


        $resultado = self::$db->query($query);

        
        if(!$resultado->num_rows){
            self::$errores[] = "El usuario no existe";
            return;
        }
        return $resultado;
        
    }

    public function validarPassword($resultado){
        //nos trea el resultado de lo que haya encontrado en la base de datos
        $usuario = $resultado->fetch_object();

        //funcion de php para verificar si un password esta bien
      $autenticado = password_verify($this->password, $usuario->password);
         //(lo que el usuario escribio)(lo que esta en la base de datos)

         if(!$autenticado){
            self::$errores[]="El password es incorrecto";
         }

         return $autenticado;
    }



    public function autenticacion(){
        //funcion para iniciar session
        session_start();

        //llenar el arreglo de session
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('location: /admin');


    }
}