
<fieldset>
        <legend>Informacion Personal</legend>
            <label for="nombre">Nombre</label>
                <input type="text" name="vendedor[nombre]" placeholder="Nombre Vendedor" id="nombre" value="<?php echo s($vendedor->nombre);?>">
                <label for="apellido">Apellido</label>
                <input type="text" name="vendedor[apellido]" placeholder="apellido Vendedor" id="apellido" value="<?php echo s($vendedor->apellido);?>">
                <label for="imagen">Imagen</label>
                <input type="file" accept="image/jpeg, image/png" name="vendedor[imagen]" id="imagen">

                <?php   if ($vendedor->imagen): ?>
                    <img src="/vendedoresPerfil/<?php echo $vendedor->imagen ?>" alt="">
                <?php endif; ?>
            </fieldset>
               
<fieldset>
<legend>Informacion de contacto</legend>
                <label for="telefono">Telefono</label>
                <input type="number" name="vendedor[telefono]" placeholder="Telefono" id="telefono" value="<?php echo s($vendedor->telefono);?>">
                <label for="email">E-Mail</label>
                <input type="email" name="vendedor[email]" placeholder="EMAIL" id="email" value="<?php echo s($vendedor->email);?>">

</fieldset>