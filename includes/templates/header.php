<?php 

if(!isset($_SESSION)){

    session_start();

 
}

$auth = $_SESSION['login'] ?? false;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/build/css/app.css">
    <link rel="icon" type="image/x-icon" href="/build/img/favicon.svg">
    <title>Bienes Raices</title>
</head>
<body>
    
    <header class="header <?php echo $inicio ? 'inicio' : ' '; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
            <a href="index.php">
                <img src="/build/img/logo.svg" alt="Logotipo Bienes Raices">
            </a>
            <div class="mobile_menu">
                <img src="/build/img/barras.svg" alt="Boton Menu desplegable">
            </div>

            <div class="derecha">
                <img class="dark-mode" src="/build/img/dark-mode.svg" alt="modo oscuro">
                <nav class="navegacion">
                    <a href="nosotros.php">Nosotros</a>
                    <a href="anuncios.php">Anuncios</a>
                    <a href="blog.php">Blog</a>
                    <a href="contacto.php">Contacto</a>
                        <?php if($auth): ?>
                        <a href="cerrar-sesion.php">Cerrar Sesion</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>  
        </div>
    </header>
