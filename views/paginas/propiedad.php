<main class="contenedor seccion">
        

     <div class="propiedad">
        <div class="propiedad__imagen">
        <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen de la propiedad">
        
        <?php 
             $url = $_SERVER["HTTP_REFERER"];

            if(strpos($url,'propiedades') === false){ //revisa si la cadena de texto contiene la palabra blog
            ?>  
            
            <a href="/" class="boton boton-violeta">Volver al inicio</a>
            
            <?php } else{  ?>
            
            <a href="/propiedades" class="boton boton-violeta">Volver a las propiedades</a>
            <?php }; ?>
    </div>
        <div class="resumen-propiedad">
        <h1 class="titulo-propiedad"><?php echo $propiedad->titulo; ?></h1>
        <p class ="descripcion"><?php echo $propiedad->descripcion; ?></p>
        

            <p class="valor" >Valor de la propiedad: <span class="precio">$<?php echo $propiedad->precio; ?></span></p>
            <p>Caracteristicas de la propiedad:</p>
            <ul class="iconos-caracteristicas">
            
                <li>
                   
                    <img class="propiedad__icono" loading="lazy" src="build/img/bano.png" alt="icono wc">
                    <p class="caracteristicas"><?php echo $propiedad->wc; ?></p>
                </li>
                <li>
                    <img class="propiedad__icono" loading="lazy" src="build/img/coche.png" alt="icono estacionamiento">
                    <p class="caracteristicas"><?php echo $propiedad->estacionamiento; ?></p>
                </li>
                <li>
                    <img class="propiedad__icono"  loading="lazy" src="build/img/cama.png" alt="icono habitaciones">
                    <p class="caracteristicas"><?php echo $propiedad->habitaciones; ?></p>
                </li>
            </ul>

            
        </div>

        </div>
    </main>