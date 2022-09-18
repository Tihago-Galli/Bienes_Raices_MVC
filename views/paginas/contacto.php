<main class="contenedor seccion">   
        
        <h1>Contacto</h1>
        <pinture>
            
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="">
        </picture>


    <h2>Completa el formulario para continuar</h2>

    <?php if($mensaje): ?>
        <p data-cy="alerta" class="alerta exito"><?php echo $mensaje ?> </p>
        <?php endif; ?>

    <form data-cy="formulario-contacto" class="formulario" action="/contacto" method="POST">
        <fieldset>
            <legend>Informacion Personal</legend>

            <label for="nombre">Nombre</label> 
            <input data-cy="input-nombre" type="text" placeholder="Tu Nombre"  id="nombre" name="contacto[nombre]" required>

            <label for="mensaje">Mensaje</label>
            <textarea data-cy="input-mensaje" id="mensaje" name="contacto[mensaje]" required></textarea>


        </fieldset>

        <fieldset>
            <legend>Informacion Sobre la propiedad</legend>
            <label for="opciones" >Vende o compra</label>
            <select data-cy="input-opciones" id="opciones" name="contacto[tipo]" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Comprar</option>
                <option value="Vende">Vender</option>
            </select>

            <label for="precio">Presupuesto</label> 
            <input data-cy="input-precio" type="number" placeholder="Su presupuesto"  id="precio" name="contacto[precio]" required>
        </fieldset>

        <fieldset>
            <legend>Informacion de Contacto</legend>
            <p>Como desea ser contactado?</p>

            <div class="forma-contacto">

                <label for="contacto-telefono">Telefono</label>
                <input data-cy="input-contacto"  type="radio" value="telefono" id="contacto-telefono" name="contacto[contacto]" required>
                <label for="contacto-Email">E-Mail</label>
                <input data-cy="input-contacto"  type="radio" value="Email" id="contacto-Email" name="contacto[contacto]" required>


            </div>

            <div id="contacto"></div>

           
            
        </fieldset>
        <input type="submit" value="enviar" class="boton-verde">
    </form>
    </main>
