
<main class="contenedor seccion"> 
        <h1>Administrador</h1>


        
        <?php $mensaje = mostrarMensaje(intval($resultado)); 
        //intval convierte el valor en entero
            if($mensaje):?>
            <p class="alerta exito"> <?php echo s($mensaje) ?></p>
        <?php endif; ?>

        
        <a href="/propiedades/crear" class="boton boton-verde">Crear Propiedad</a>
        <a href="/vendedores/crear" class="boton boton-amarillo">Crear Vendedor</a>
        <a href="/entradas/crear" class="boton boton-amarillo">Crear Entrada</a>
 
    <h2>Propiedades</h2>
    <table class="propiedades">
        <thead>
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>IMAGEN</th>
            <th>PRECIO</th>
            <th>ACCION</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($propiedades as $propiedad): ?>
            <tr>
                <td> <?php echo $propiedad->id ?> </td>
                <td> <?php echo $propiedad->titulo ?> </td>
                <td><img src="imagenes/<?php echo $propiedad->imagen; ?> " alt="" class="imagen"></td>
                <td> <?php echo $propiedad->precio ?> </td>
                <td>
                    <a href="/propiedades/actualizar?id=<?php echo $propiedad->id ?>" class="boton-amarillo-block">Actualizar</a>
                    <form method="POST" action="/propiedades/eliminar">
                        <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                        <input type="hidden" name="tipo" value="propiedad">
                        <input type="submit" value="ELIMINAR" class="boton-rojo-block">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
      
    </table>

    <h2>Vendedores</h2>
    <table class="propiedades">
        <thead>
        <tr>
            <th>ID</th>
            <th>NOMBRE y APELLIDO</th>
            <th>TELEFONO</th>
            <th>EMAIL</th>
            <th>IMAGEN</th>
            <th>ACCION</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($vendedores as $vendedor): ?>
            <tr>
                <td> <?php echo $vendedor->id ?> </td>
                <td> <?php echo $vendedor->nombre ." ". $vendedor->apellido?> </td>
                <td> <?php echo $vendedor->telefono ?> </td>
                <td> <?php echo $vendedor->email ?> </td>
                <td><img src="imagenesvendedores/<?php echo $vendedor->imagen; ?> " alt="" class="imagen"></td>
                <td>
                    <a href="/vendedores/actualizar?id=<?php echo $vendedor->id ?>" class="boton-amarillo-block">Actualizar</a>
                    <form method="POST" action="/vendedores/eliminar">
                        <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                        <input type="hidden" name="tipo" value="vendedor">
                        <input type="submit" value="ELIMINAR" class="boton-rojo-block">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
      
    </table>

    <h2>Blogs</h2>
    <table class="propiedades">
        <thead>
        <tr>
            <th>ID</th>
            <th>TITULO</th>
            <th>DESCRIPCION</th>
            <th>FECHA</th>
            <th>IMAGEN</th>
            <th>CREADOR</th>
            <th>ACCION</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($entradas as $entrada): ?>
            <tr>
                <td> <?php echo $entrada->id ?> </td>
                <td> <?php echo $entrada->titulo?> </td>
                <td> <?php echo $entrada->creador ?> </td>
                <td> <?php echo $entrada->fecha ?> </td>
                <td><img src="imagenesblog/<?php echo $entrada->imagen; ?> " alt="" class="imagen"></td>
                <td>
                    <a href="/entradas/actualizar?id=<?php echo $entrada->id ?>" class="boton-amarillo-block">Actualizar</a>
                    <form method="POST" action="/entradas/eliminar">
                        <input type="hidden" name="id" value="<?php echo $entrada->id; ?>">
                        <input type="hidden" name="tipo" value="entrada">
                        <input type="submit" value="ELIMINAR" class="boton-rojo-block">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
      
    </table>

</main>