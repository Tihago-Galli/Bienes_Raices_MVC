<div class="contenedor-anuncios">

<?php foreach($propiedades as $propiedad): ?>
        <div class="anuncios" data-cy="anuncio">
            
            <img loading="lazy" width="200" height="300" src="imagenes/<?php echo $propiedad->imagen; ?>" alt="">
         

             <div class="contenido-anuncio">
                <h3><?php echo $propiedad->titulo; ?></h3>
                <p><?php echo truncate($propiedad->descripcion, 120); ?></p>
                <p class="precio">$<?php echo $propiedad->precio; ?></p>

                <ul class="iconos-caracteristicas">
                    <li>
                        <img loading="lazy" src="build/img/icono_wc.svg" alt="Baño">
                        <p><?php echo $propiedad->wc; ?></p>
                    </li>
                    <li>
                        <img loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Estacionamiento">
                        <p><?php echo $propiedad->estacionamiento; ?></p>
                    </li>
                    <li>
                        <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="Dormitorio">
                        <p><?php echo $propiedad->habitaciones; ?></p>
                    </li>
                </ul>

                <a href="/propiedad?id=<?php echo $propiedad->id;?>" class="boton-amarillo" data-cy="anuncio-boton">Ver Anuncio</a>

            </div> <!--Fin Contenido Anuncios-->
        </div><!--Fin Anuncios-->
        <?php endforeach; ?>
    </div> <!--Fin Contenedor Anuncios-->