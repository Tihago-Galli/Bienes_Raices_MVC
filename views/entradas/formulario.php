<fieldset>
                <legend>Informacion General</legend>
                <label for="titulo">Titulo</label>
                <input type="text" placeholder="Titulo entrada" name="entrada[titulo]" id="titulo" value="<?php echo s($entrada->titulo);?>">

                <label for="descripcion">Descripcion</label>
                <textarea id="descripcion" name="entrada[descripcion]"><?php echo s($entrada->descripcion);?></textarea>

                <label for="imagen">Imagen</label>
                <input type="file" accept="image/jpeg, image/png" name="entrada[imagen]" id="imagen">

                <?php   if ($entrada ->imagen): ?>
                    <img src="/imagenesblog/<?php echo $entrada ->imagen ?>" alt="">
                <?php endif; ?>
                



                <label for="Creador">Creador</label>
                <input type="text" name="entrada[creador]" placeholder="Ejem: Carlos" id="creador" value="<?php echo s($entrada->creador);?>">

               


            </fieldset>
           