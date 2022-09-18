<main class="contenedor seccion">   
        
        <h1>Login</h1>  

        <?php foreach($errores as $error): ?>
            <div data-cy="alerta" class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach;?>
        <form data-cy="formulario-login" method="POST" class="formulario contenido-centrado" action="/login">
        <fieldset>
            <legend>Email y contraseña</legend>

            <label for="email">E-Mail</label> 
            <input type="email" placeholder="Tu Email"  name="email" id="email" required>

            <label for="password">Contraseña</label> 
            <input type="password" placeholder="Tu password" name="password" id="password" required>



        </fieldset>
        <input type="submit" class="boton-verde" value="Iniciar Secion"  >
        </form>

    </main>