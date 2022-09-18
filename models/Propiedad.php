<?php 

namespace Model;

class Propiedad extends ActiveRecord{

    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamiento','creado','vendedorid'];

    public $id;
    public $titulo;
    public $precio;
    public $descripcion;
    public $imagen;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorid;

    public function __construct($array = [])
    {
            $this->id = $array['id'] ?? NULL;
            $this->titulo = $array['titulo'] ?? '';
            $this->precio = $array['precio'] ?? '';
            $this->descripcion = $array['descripcion'] ?? '';
            $this->imagen = $array['imagen'] ?? '';
            $this->habitaciones = $array['habitaciones'] ?? '';
            $this->wc = $array['wc'] ?? '';
            $this->estacionamiento = $array['estacionamiento'] ?? '';
            $this->creado = date('y/m/d');
            $this->vendedorid = $array['vendedorid'] ?? '';
        
    }

    public function validar(){
        if(!$this->titulo){
            self::$errores[] = 'Debes añadir un titulo';
          }
          if(!$this->precio){
              self::$errores[] = 'Debes añadir un precio';
          }
          if(strlen($this->descripcion) < 50 ){
              self::$errores[] = 'Debes añadir una descripcion y al menos ser mayor a 50 caracteres';
          }
          if(!$this->habitaciones){
              self::$errores[] = 'Debes añadir al menos una habitacion';
          }
          if(!$this->wc){
              self::$errores[] = 'Debes añadir al menos un wc';
          }
          if(!$this->estacionamiento){
              self::$errores[] = 'Debes añadir al menos un estacionamiento';
          }
          if(!$this->vendedorid){
              self::$errores[] = 'Debes selecionar un vendedor';
          }
    
          if(!$this->imagen){
            self::$errores[] = 'Debes selecionar un vendedor';
        }
              //si name esta vacio significa que no se cargo ninguna imagen
              //el error significa que hubo un error al cargar la imagen por alguna configuracion o error del programa
        
    
          return self::$errores;
    }
    
}

