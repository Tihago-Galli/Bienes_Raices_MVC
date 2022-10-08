<?php 

namespace Controllers;
use Model\Vendedor;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Imagen;

class VendedorControllers{

    public static function index(Router $router) {
        $vendedores = Vendedor::all();

        // Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('vendedores/index', [
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router){


        $vendedores = new Vendedor();
        $errores = Vendedor::getErrores();

        if($_SERVER['REQUEST_METHOD'] ==='POST'){

            $vendedor = new Vendedor($_POST['vendedor']); //creamos una nueva instancia almacenandola en post en memoria
            
            
              //creando la carpeta para guardar imagen
              //comprobamos de que si la carpeta no existe, la creamos
              if(!is_dir(CARPETA_VENDEDORES)){
                  mkdir(CARPETA_VENDEDORES);
              }
            
              //generar nombre unico a la imagen
              $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
              $url = CARPETA_VENDEDORES;
            
                        //subida de imagen
                        //realiza un resize a la imagen con intervention
                        if($_FILES['vendedor']['tmp_name']['imagen']){
                        $imagen = Imagen::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800,600);
                        $vendedor->setImagen($nombreImagen, $url);
                        }
                    //validar 
                    $errores = $vendedor->validar();
            
                //validar de que errores este vacio para enviar datos al servidor
                if(empty($errores)){
            
                   
                        //guardar imagen
                        $imagen->save(CARPETA_VENDEDORES . $nombreImagen);
            
                        //guardar en la base de datos
                      $vendedor->guardar();
                }
            
          
          };
        $router->render('vendedores/crear', [
            //pasamos toda la informacion a la vista
            'vendedor' => $vendedores,
            'errores' => $errores

        ]);
        
    }

    public static function actualizar(Router $router){


        $id = validarOredireccionar("/admin");
        //obtener el array del vendedor
        $vendedor = Vendedor::find($id);


//arrary con mensajes de error
$errores = Vendedor::getErrores();


if($_SERVER['REQUEST_METHOD'] ==='POST'){

  //asignar valores
$array = $_POST['vendedor'];

$vendedor->sincronizar($array);

  //validacion
 $errores = $vendedor->validar();


  //SUBIDA DE ARCHIVO
   //generar nombre unico a la imagen
  $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";


 if($_FILES['vendedor']['tmp_name']['imagen']){
  $imagen = Imagen::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800,600);
  $vendedor->setImagen($nombreImagen);
  }

  //validar de que errores este vacio para enviar datos al servidor
  if(empty($errores)){

      if($_FILES['vendedor']['tmp_name']['imagen']){
      //almacenar imagen
      $imagen->save(CARPETA_VENDEDORES . $nombreImagen);
      }
      $vendedor->guardar();
  

  }

}

$router->render('/vendedores/actualizar',[

    'vendedor' => $vendedor,
    'errores' => $errores

]);
        
    }

    public static function eliminar(){

        if($_SERVER['REQUEST_METHOD']=== 'POST'){

            //validamos que el id sea valido
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    

    if($id){

        //validamos el tipo a eliminar, si es vendedor o propiedad
        $tipo = $_POST['tipo'];
   
        //validamos de que el tipo ingresado sea correcto y no uno modificado
        if(validarTipo($tipo)){
          
            $vendedor = Vendedor::find($id);
                $vendedor ->eliminar($tipo);
        }
        

}

}
    }
}
?>