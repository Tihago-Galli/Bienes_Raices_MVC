<?php

namespace MVC;

class Router{

    public $rutasGet = [];
    public $rutasPost = [];

    //estta funcion va a ir llenando el arreglo de rutasGet con la url y la funcion asociada al url como valor
    public function get($url, $fn){
        //transforma en arreglo el url con el valor que seria la funcion 
       $this->rutasGet[$url] = $fn;
    }

    public function post($url, $fn){
        //transforma en arreglo el url con el valor que seria la funcion 
       $this->rutasPost[$url] = $fn;
    }

   public function comprobarRutas(){

    //iniciamos sesion
    session_start();

    //URL que no pueden acceder si no estan autenticados
    $rutasProtegidas = ['/admin','/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar',
                        '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar', 
                        '/entradas/crear', '/entradas/actualizar', '/entradas/eliminar'];
  
    //creamos la variable con el valor de login si esta autenticado o no                    
    $auth = $_SESSION['login'] ?? null;

    //nos muestra el url actual de la pagina
    $urlActual = strtok($_SERVER["REQUEST_URI"], '?') ?? '/';
    //nos retorna si el metodo es GET o POST
    $metodo = $_SERVER['REQUEST_METHOD'];

   


    if($metodo === 'GET'){
    $fn = $this->rutasGet[$urlActual] ?? null;
        
    }else{
      
        $fn = $this->rutasPost[$urlActual] ?? null;
    }

        //si es una url protegida y no esta autenticado lo redireccionamos
    if(in_array($urlActual, $rutasProtegidas) && !$auth){

        header('location: /');
    }

    if($fn)  {

    //LA URL existe y hay una funcion asociada
        //es una funcion ques permite llamar una funcion que no sabemos como se llama
        call_user_func($fn, $this);
   }else{
    echo "Pagina no encontrada";
   }
}

        public function render($view, $datos = []) {
            // Leer lo que le pasamos  a la vista
            foreach ($datos as $key => $value) {
                $$key = $value;  // Doble signo de dolar significa: variable variable, básicamente nuestra variable sigue siendo la original, pero al asignarla a otra no la reescribe, mantiene su valor, de esta forma el nombre de la variable se asigna dinamicamente
            }
    
            ob_start(); // Almacenamiento en memoria durante un momento...
    
            // entonces incluimos la vista en el layout
            include_once __DIR__ . "/views/$view.php";
            $contenido = ob_get_clean(); // Limpia el Buffer
            include_once __DIR__ . '/views/layout.php';
        }
   } 

  

?>