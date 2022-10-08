<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Model\Entrada;
use Intervention\Image\ImageManagerStatic as Imagen;

class PropiedadControllers{

    public static function index(Router $router){

        //consultamos la base de datos para traer todos los registros
        //guardamos toda la informacion en la variable
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $entradas = Entrada::all();
        $resultado = $_GET['resultado'] ?? null;

        $router->render('admin/admin', [
            //pasamos toda la informacion a la vista
            'propiedades' => $propiedades,
            'entradas' => $entradas,
            'resultado' => $resultado,
            'vendedores' => $vendedores

        ]);
    }

    

    public static function crear(Router $router){

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        //arrary con mensajes de error
        $errores = Propiedad::getErrores(); //mandamos a llamar a la propiedad statica para que no nos marque un undefine

        //METODO POST PARA CREAR UNA PROPIEDAD
        if($_SERVER['REQUEST_METHOD'] ==='POST'){

            $propiedad = new Propiedad($_POST['propiedad']); //creamos una nueva instancia almacenandola en post en memoria
            
            
              //creando la carpeta para guardar imagen
              //comprobamos de que si la carpeta no existe, la creamos
              if(!is_dir(CARPETA_IMAGENES)){
                  mkdir(CARPETA_IMAGENES);
              }
            
              $url = CARPETA_IMAGENES;
              //generar nombre unico a la imagen
              $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            
            
                        //subida de imagen
                        //realiza un resize a la imagen con intervention
                        if($_FILES['propiedad']['tmp_name']['imagen']){
                        $imagen = Imagen::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                        $propiedad->setImagen($nombreImagen, $url);
                        }
                    //validar 
                    $errores = $propiedad->validar();
            
                //validar de que errores este vacio para enviar datos al servidor
                if(empty($errores)){
            
                   
                        //guardar imagen
                        $imagen->save(CARPETA_IMAGENES . $nombreImagen);
            
                        //guardar en la base de datos
                      $propiedad->guardar();
                }
            
            };

        $router->render('propiedades/crear', [
            //pasamos toda la informacion a la vista
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores

        ]);
    }

    public static function actualizar(Router $router){


        $id = validarOredireccionar('/admin');

        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();

        //arrary con mensajes de error
        $errores = Propiedad::getErrores();

        //METODO POST PARA ACTUALIZAR UNA PROPIEDAD
        if($_SERVER['REQUEST_METHOD'] ==='POST'){

            //asignar valores
        $array = $_POST['propiedad'];
        
        $propiedad->sincronizar($array);
        
            //validacion
           $errores = $propiedad->validar();
        
        
            //SUBIDA DE ARCHIVO
             //generar nombre unico a la imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
        
       
          
           if($_FILES['propiedad']['tmp_name']['imagen']){
            $imagen = Imagen::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
            }
        
            //validar de que errores este vacio para enviar datos al servidor
            if(empty($errores)){
        
                if($_FILES['propiedad']['tmp_name']['imagen']){
                //almacenar imagen
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $propiedad->guardar();
            
        
            }
        
        };

        $router->render('propiedades/actualizar', [
            //pasamos toda la informacion a la vista
            'propiedad' => $propiedad,
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
          
            $propiedad = Propiedad::find($id);
                $propiedad ->eliminar($tipo);
        }
        

}

}
    }
}
?>