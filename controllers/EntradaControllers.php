<?php 

namespace Controllers;
use Model\Vendedor;
use Model\Entrada;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Imagen;

class EntradaControllers{



        public static function index(Router $router){
    
            //consultamos la base de datos para traer todos los registros
            //guardamos toda la informacion en la variable
            $entradas = Entrada::all();

            $resultado = $_GET['resultado'] ?? null;
    
            $router->render('entradas/index', [
                //pasamos toda la informacion a la vista
                'entradas' => $entradas,
                'resultado' => $resultado,

    
            ]);
        }
    
        
    
        public static function crear(Router $router){
    
            $entrada = new Entrada;
            $vendedores = Vendedor::all();
            //arrary con mensajes de error
            $errores = Entrada::getErrores(); //mandamos a llamar a la propiedad statica para que no nos marque un undefine
    
            //METODO POST PARA CREAR UNA PROPIEDAD
            if($_SERVER['REQUEST_METHOD'] ==='POST'){
    
                $entrada = new Entrada($_POST['entrada']); //creamos una nueva instancia almacenandola en post en memoria
                
                
                  //creando la carpeta para guardar imagen
                  //comprobamos de que si la carpeta no existe, la creamos
                  if(!is_dir(CARPETA_BLOG)){
                      mkdir(CARPETA_BLOG);
                  }
                
                  //generar nombre unico a la imagen
                  $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
                
                
                            //subida de imagen
                            //realiza un resize a la imagen con intervention
                            if($_FILES['entrada']['tmp_name']['imagen']){
                            $imagen = Imagen::make($_FILES['entrada']['tmp_name']['imagen'])->fit(800,600);
                            $entrada->setImagen($nombreImagen);
                            }
                        //validar 
                        $errores = $entrada->validar();
                
                    //validar de que errores este vacio para enviar datos al servidor
                    if(empty($errores)){
                
                       
                            //guardar imagen
                            $imagen->save(CARPETA_BLOG . $nombreImagen);
                
                            //guardar en la base de datos
                          $entrada->guardar();
                    }
                
                };
    
            $router->render('entradas/crear', [
                //pasamos toda la informacion a la vista
                'entrada' => $entrada,
                'vendedores' => $vendedores,
                'errores' => $errores
    
            ]);
        }
    
        public static function actualizar(Router $router){
    
    
            $id = validarOredireccionar('/admin');
    
            $entrada = Entrada::find($id);
            $vendedores = Vendedor::all();
    
            //arrary con mensajes de error
            $errores = Entrada::getErrores();
    
            //METODO POST PARA ACTUALIZAR UNA PROPIEDAD
            if($_SERVER['REQUEST_METHOD'] ==='POST'){
    
                //asignar valores
            $array = $_POST['entrada'];
            
            $entrada->sincronizar($array);
            
                //validacion
               $errores = $entrada->validar();
            
            
                //SUBIDA DE ARCHIVO
                 //generar nombre unico a la imagen
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            
              
               if($_FILES['entrada']['tmp_name']['imagen']){
                $imagen = Imagen::make($_FILES['entrada']['tmp_name']['imagen'])->fit(800,600);
                $entrada->setImagen($nombreImagen);
                }
            
                //validar de que errores este vacio para enviar datos al servidor
                if(empty($errores)){
            
                    if($_FILES['entrada']['tmp_name']['imagen']){
                    //almacenar imagen
                    $imagen->save(CARPETA_BLOG . $nombreImagen);
                    }
                    $entrada->guardar();
                
            
                }
            
            };
    
            $router->render('entradas/actualizar', [
                //pasamos toda la informacion a la vista
                'entrada' => $entrada,
                'vendedores' => $vendedores,
                'errores' => $errores
    
            ]);
        }
    
        public static function eliminar(){
    
            if($_SERVER['REQUEST_METHOD']=== 'POST'){
    
    
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        
    
        if($id){
    
            $tipo = $_POST['tipo'];
       
            //validamos de que el tipo ingresado sea correcto y no uno modificado
            if(validarTipo($tipo)){
               
                $entrada = Entrada::find($id);
                    $entrada ->eliminar();
            }
            
    
    }
    
    }
        }
    
}

?>