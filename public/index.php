<?php 

require_once __DIR__ . '../../includes/app.php';

use MVC\Router;
use Controllers\PropiedadControllers;
use Controllers\VendedorControllers;
use Controllers\PaginasControllers;
use Controllers\EntradaControllers;
use Controllers\LoginControllers;


$router = new Router();


//zona privada para el administrador
$router->get('/admin', [PropiedadControllers::class, 'index']);//esta pripiedad nos indica el namespace donde se va a encontrar la funcion 
$router->get('/propiedades/crear', [PropiedadControllers::class, 'crear']);//Al visitar una URL cada una de ellas va a tener un controlador y a la vez va a tener un metodo
$router->post('/propiedades/crear', [PropiedadControllers::class, 'crear']);
$router->get('/propiedades/actualizar', [PropiedadControllers::class, 'actualizar']);//ese metodo lo definimos en la clase de cada uno
$router->post('/propiedades/actualizar', [PropiedadControllers::class, 'actualizar']);
$router->post('/propiedades/eliminar', [PropiedadControllers::class, 'eliminar']);

$router->get('/vendedores', [VendedorControllers::class, 'index']);
$router->get('/vendedores/crear', [VendedorControllers::class, 'crear']);
$router->post('/vendedores/crear', [VendedorControllers::class, 'crear']);
$router->get('/vendedores/actualizar', [VendedorControllers::class, 'actualizar']);
$router->post('/vendedores/actualizar', [VendedorControllers::class, 'actualizar']);
$router->post('/vendedores/eliminar', [VendedorControllers::class, 'eliminar']);

$router->get('/entradas', [EntradaControllers::class, 'index']);
$router->get('/entradas/crear', [EntradaControllers::class, 'crear']);
$router->post('/entradas/crear', [EntradaControllers::class, 'crear']);
$router->get('/entradas/actualizar', [EntradaControllers::class, 'actualizar']);
$router->post('/entradas/actualizar', [EntradaControllers::class, 'actualizar']);
$router->post('/entradas/eliminar', [EntradaControllers::class, 'eliminar']);



//zona publica para los usuarios

$router->get('/', [PaginasControllers::class, 'index']);
$router->get('/propiedades', [PaginasControllers::class, 'propiedades']);
$router->get('/propiedad', [PaginasControllers::class, 'propiedad']);
$router->get('/blog', [PaginasControllers::class, 'blog']);
$router->get('/entrada', [PaginasControllers::class, 'entrada']);
$router->get('/nosotros', [PaginasControllers::class, 'nosotros']);
$router->get('/contacto', [PaginasControllers::class, 'contacto']);
$router->post('/contacto', [PaginasControllers::class, 'contacto']);

//login y auntenticacion

$router->get('/login', [LoginControllers::class, 'login']);
$router->post('/login', [LoginControllers::class, 'login']);
$router->get('/logout', [LoginControllers::class, 'logout']);


$router->comprobarRutas();



?>