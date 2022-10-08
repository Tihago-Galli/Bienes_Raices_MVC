

<main class="contenedor seccion ">   
        

        <h1 class="entrada__titulo"><?php echo $entrada->titulo ?></h1>

<div class="entrada">
            <div class="entrada__imagen">
        <pinture>
            
            <source srcset="build/img/blog2.webp" type="image/webp">
            <source srcset="build/img/blog2.jpg" type="image/jpeg">
            <img loading="lazy" src="/imagenesblog/<?php echo $entrada->imagen; ?>" alt="">
        </picture>
        </div>
        <div class="entrada__descripcion">
        <p class="info-meta">Escrito el: <span> <?php echo $entrada->fecha ?> </span> por:<span> <?php echo $entrada->creador ?></span></p>
        <div class="resumen_propiedad">
          
            <p class="descripcion"><?php echo $entrada->descripcion ?></p>
            </div>
        </div>

        <?php 
   $url = $_SERVER["HTTP_REFERER"];

        if(strpos($url,'blog') === false){ //revisa si la cadena de texto contiene la palabra blog
            ?>  
            
            <a href="/" class="boton boton-violeta">Volver al inicio</a>
            
            <?php } else{  ?>
            
            <a href="/blog" class="boton boton-violeta">Volver al blog</a>
            <?php }; ?>
            </div>
    </main>
    