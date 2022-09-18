<fieldset>
                <legend>Informacion General</legend>
                <label for="titulo">Titulo</label>
                <input type="text" placeholder="Titulo Propiedad" name="propiedad[titulo]" id="titulo" value="<?php echo s($propiedad->titulo);?>">

                <label for="precio">Precio</label>
                <input type="number" placeholder="Precio Propiedad" name="propiedad[precio]" id="precio" value="<?php echo s($propiedad->precio);?>">

                <label for="imagen">Imagen</label>
                <input type="file" accept="image/jpeg, image/png" name="propiedad[imagen]" id="imagen">

                <?php   if ($propiedad ->imagen): ?>
                    <img src="/imagenes/<?php echo $propiedad ->imagen ?>" alt="">
                <?php endif; ?>
                <label for="descripcion">Descripcion</label>
                <textarea id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion);?></textarea>

            </fieldset>

            <fieldset>
                <legend>Informacion Propiedad</legend>

                <label for="habitacion">Habitaciones</label>
                <input type="number" name="propiedad[habitaciones]" placeholder="Ejem: 3" id="habitacion" value="<?php echo s($propiedad->habitaciones);?>">

                <label for="wc">wc</label>
                <input type="number" name="propiedad[wc]" placeholder="Ejem: 3" id="wc" value="<?php echo s($propiedad->wc);?>">

                <label for="estacionamiento">Estacionamiento</label>
                <input type="number" name="propiedad[estacionamiento]" placeholder="Ejem: 3" id="estacionamiento" min="1" value="<?php echo s($propiedad->estacionamiento);?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                <label for="vendedor">Vendedor</label>
                <select name="propiedad[vendedorid]" id="vendedor">
                    <option selected value=""><-- Seleccione --></option>
                    <?php foreach($vendedores as $vendedor): ?>
                        <option <?php echo $propiedad->vendedorid === $vendedor->id ? 'selected' : ''; ?>
                        value="<?php echo s( $vendedor->id ); ?>">
                        <?php echo s($vendedor->nombre) ." ". s($vendedor->apellido) ?> </option>
                    <?php endforeach;?>    
                </select>
                
            </fieldset>