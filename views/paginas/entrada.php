

<main class="contenedor seccion contenido-centrado">   
        
        <h1><?php echo $entrada->titulo ?></h1>
        

        <pinture>
            
            <source srcset="build/img/blog2.webp" type="image/webp">
            <source srcset="build/img/blog2.jpg" type="image/jpeg">
            <img loading="lazy" src="/imagenesblog/<?php echo $entrada->imagen; ?>" alt="">
        </picture>

        <p class="info-meta">Escrito el: <span> <?php echo $entrada->fecha ?> </span> por:<span> <?php echo $entrada->creador ?></span></p>
        <div class="resumen_propiedad">
            <p class="precio">$3.000.000</p>


            <p><?php echo $entrada->descripcion ?></p>
            
        </div>

        <?php 
   $url = $_SERVER["HTTP_REFERER"];

        if(strpos($url,'blog') === false){ //revisa si la cadena de texto contiene la palabra blog
            ?>  
            
            <a href="/" class="boton boton-verde">Volver al inicio</a>
            
            <?php } else{  ?>
            
            <a href="/blog" class="boton boton-verde">Volver al blog</a>
            <?php }; ?>
        
    </main>
    