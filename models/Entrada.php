<?php 

namespace Model;

class Entrada extends ActiveRecord{

    protected static $tabla = "entrada";

    protected static $columnasDB = ['id','titulo','descripcion', 'fecha', 'creador', 'imagen'];


    public $id;
    public $titulo;
    public $descripcion;
    public $fecha;
    public $creador;
    public $imagen;

    public function __construct($array = [])
    {
            $this->id = $array['id'] ?? NULL;
            $this->titulo = $array['titulo'] ?? '';
            $this->descripcion = $array['descripcion'] ?? '';
            $this->fecha = date('y/m/d');
            $this->creador = $array['creador'] ?? '';
            $this->imagen = $array['imagen'] ?? '';
           
        
    }


    public function validar(){
        if(!$this->titulo){
            self::$errores[] = 'Debes añadir un titulo';
          }
          if(!$this->descripcion){
            self::$errores[] = 'Debes añadir un descripcion';
          }
          if(!$this->creador){
            self::$errores[] = 'Debes añadir un creador';
          }
          if(!$this->imagen){
            self::$errores[] = 'Debes añadir una imagen';
        }
          

          return self::$errores;
        }
        
}
