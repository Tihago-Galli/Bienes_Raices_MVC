<main class="contenedor seccion">   
        
    <h2 data-cy="heading-nosotros">Mas sobre nosotros</h2>

        <?php include 'iconos.php' ?>


<section class="seccion contenedor">

<?php  include 'listado.php';?>  

<a href="/propiedades" class="boton-verde" data-cy="boton-propiedades">VER PROPIEDADES</a>
</section>

    </main>

    <section class="imagen-contacto" data-cy="imagen-contacto">

        <h3>Envianos un Mail y contactanos!</h3>
        <p>Lorem ipsdebitis harum? Sequi corrupti aperiam nobis ducimus unde. Alias, architecto sit?</p>
        <a href="/contacto" class="boton-amarillo-block">Contacto</a>
    </section>

<div class="contenedor seccion seccion-inferior">
    <section data-cy="blog" class="blog">
        <h3>Nuestro Blog</h3>

        <?php foreach ($entradas as $entrada): 
        
        include 'blogs.php';
         
        endforeach; ?>

    </section>

    <section data-cy="testimoniales" class="testimoniales">
        <h3>Testimoniales</h3>
        <div class="testimonio">
            <blockquote>
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquid iure tenetur doloribus tempore, possimus quidem sapiente, voluptates sunt nobis inventore vitae, temporibus numquam earum natus ipsum hic eius eveniet. Deserunt!
            </blockquote>
            <p class="entrevistado">- Tihago Adriel Galli</p>
        </div>
    </section>
</div>