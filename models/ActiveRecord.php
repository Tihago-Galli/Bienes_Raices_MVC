<?php

namespace Model;

class ActiveRecord{

    protected static $db;
    protected static $columnasDB = [];
    protected static $errores = [];
    protected static $tabla = '';


    //definir la conexion a la base de datos
    public static function setDB($database){

        self::$db = $database;
}


    public function guardar(){

        if(!is_null($this->id)){
          //si tiene un id, entonces estoy actualizando
          $this->actualizar();
        }else{
            //si no tiene id, estoy creadno
            $this->crear();
        }
    }

    public function crear(){

        //sanitizar los datos

        $atributos = $this->sanitizar();

        //al ser variables public se las manda a llamar usando el this con la flecha
        $query = "INSERT INTO ". static::$tabla ." ( ";
        $query .= join(', ', array_keys($atributos)); 
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values ($atributos)); 
        $query .= " ') ";


        //insertar los valores a la base de datos
    
        $resultado = self::$db->query($query);
           
       //MENSAJE 
   if($resultado){
    //redireccionar a una pagina una vez cargado el registro
    header('location: /admin?resultado=1');
}
  
           
}

public function actualizar(){
    $atributos = $this->sanitizar();

    $valores = [];
    foreach($atributos as $key => $value){
        $valores []= "{$key} = '{$value}'";
    }

    $query = "UPDATE ". static::$tabla ." SET ";
    $query .= join(", ",$valores);
    $query .= "WHERE id = '" .self::$db->escape_string($this->id) . "' ";
    $query .= "LIMIT 1";

    //insertar query en base de datos
   $resultado = self::$db->query($query);

    //MENSAJE 
   if($resultado){
    //redireccionar a una pagina una vez cargado el registro
    header('location: /admin?resultado=2');
}

}

//funcion para identificar y unir los valores de la DB con las columnas
public function atributos(){
    $atributos = [];
    foreach(static::$columnasDB as $columna){

        if($columna === 'id') continue; //si el campo es igual al id lo saltea y sigue iterando el resto
        $atributos[$columna] = $this->$columna;
    }

    return $atributos;
    
}

//sanitiza los valores del formulario para que nadie inyecte nada a la base de datos
public function sanitizar(){
    $atributos = $this->atributos();
    
    $sanitizado= [];

    foreach($atributos as $key => $value){
 
        $sanitizado[$key] = self::$db->escape_string($value); //en caso de que alguien quiera hacer una inyeccion de codigo este codigo lo espaca con una diagonal
    }

    return $sanitizado;
   
}

//funcion para eliminar un archivo
public function eliminar(){

    //query para eliminar un registro
    $query = " DELETE FROM ". static::$tabla ." WHERE id = ". self::$db->escape_string($this->id) . " LIMIT 1";
   
    
    //asignar la consulta a un resultado y colocar la query en la BD
    $resultado = self::$db->query($query);

    
    
    //REDIRECCIONAR
    if($resultado){
        $this->borrarImagen();
        header('location: /admin?resultado=3');
    }
    }

//subida de imagen
public function setImagen($imagen){

    //eliminar imagen previa
    if( !is_null($this->id) ){
        $this->borrarImagen();
        
    }    
//asignar al atributo de imagen el nombre de la imagen
    if($imagen){
        $this->imagen = $imagen;
       
    }
}

//FUNCION PARA BORRAR UNA IMAGEN
public function borrarImagen(){
//comprobar si la imagen existe

    if(static::$tabla === "vendedores"){
        $existeImagen = file_exists(CARPETA_VENDEDORES . $this->imagen);
       
        if($existeImagen){
            //BORRAR LA IMAGEN QUE SE ENCUENTRE EN ESA CARPETA
            unlink(CARPETA_VENDEDORES . $this->imagen);
    }

        
    }
    elseif(static::$tabla === "propiedades"){
        $existeImagen = file_exists(CARPETA_IMAGENES . $this->imagen);



        if($existeImagen){
                //BORRAR LA IMAGEN QUE SE ENCUENTRE EN ESA CARPETA
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }elseif(static::$tabla === "entrada"){
        $existeImagen = file_exists(CARPETA_BLOG . $this->imagen);

        if($existeImagen){
                //BORRAR LA IMAGEN QUE SE ENCUENTRE EN ESA CARPETA
            unlink(CARPETA_BLOG . $this->imagen);
        }
    }
    
}

//validacion
public static function getErrores(){
    //RETORNAR EL ARRAY VACIO
    return static::$errores;
}

    //VALIDA 1 POR 1 QUE QUE HAYA INSERTADO CADA UNO DE LOS VALORES SINO RETORNA EL ERROR CON EL MENSAJE
public function validar(){
  
        static::$errores = [];
      return static::$errores;
}

//funcion para retornar todos los valores de una tabla
public static function all(){

    //el metodo static a diferencia del self es que el self,
    // hace referencia a la clase en la que se encuentra y el static a la clase que lo manda a llamar
    $query = "SELECT * FROM ". static::$tabla;
 
    //pasamos la consulta a otro metodo
   $resultado = self::consultarSQL($query);

   return $resultado;
}

public static function get($cantidad){

    //el metodo static a diferencia del self es que el self,
    // hace referencia a la clase en la que se encuentra y el static a la clase que lo manda a llamar
    $query = "SELECT * FROM ". static::$tabla . " LIMIT ". $cantidad;
 
    //pasamos la consulta a otro metodo
   $resultado = self::consultarSQL($query);

   return $resultado;
}

//funcion para retornar una propiedad segun el id
public static function find($id){
    $query = "SELECT * FROM ". static::$tabla ." WHERE id = ${id}";

    $resultado = self::consultarSQL($query);

    return array_shift($resultado);//es una funcion que retorna el primer valor de un array
}

public static function consultarSQL($query){
        //consultar base de datos
    $resultado = self::$db ->query($query);


        //iterar sobre los registros
    $array = [];
    while($registro = $resultado->fetch_assoc()){
        $array[] = static::crearObjeto($registro);
    }

    //liberar la memoria
    $resultado->free();

    //retornar resultado

    return $array;

}

//convierte el arreglo en objeto
protected static function crearObjeto($registro){

    //trae todos los campos de la propiedad Ejem: titulo, precio, descripcion
    $objeto = new static;

    foreach($registro as $key => $value){
        //comprueba en aca iteracion si el nombre del objeto es igual al campo que hay en la DB y se esta evaluando EJEM: titulo = titulo
        //y los va a ir mapeando de arreglos a objetos
        if(property_exists($objeto, $key)){
            $objeto->$key = $value;
        }
    }
    return $objeto;
}

//sincroniza el objeto en memoria con los cambios que realizados por el usuarios
public function sincronizar($array = []){

    foreach($array as $key => $value){
        //validamos de que nuestro array tenga los atributos de la propiedad
        if(property_exists($this,$key)&& !is_null($value)){
                $this->$key = $value;
        }
    }
}


}

?>