<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . './templates');
$dotenv->safeLoad();

require 'funciones.php';
require 'config/database.php';


//conectar a la base de datos
$db = conectarDB();

use Model\ActiveRecord;

ActiveRecord::setDB($db);



?>