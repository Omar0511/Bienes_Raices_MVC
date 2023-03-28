<main class="contenedor">
        <h1>Administrador de Bienes Raíces</h1>
        
        <?php 
            $mensaje = mostrarNotificacion( intval($resultado));
            if ($mensaje) { ?>
                <p class="alerta exito"> <?php echo s($mensaje); ?> </p>
            <?php }
        ?>


        <!-- <a href="../admin/propiedades/crear.php" class="boton-verde">Nueva propiedad</a> -->
        <a href="/propiedades/crear" class="boton boton-verde">Nueva propiedad</a>        

        <h2>Propiedades</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Imágen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tbody>
                <?php foreach($propiedades as $propiedad): ?>
                    <tr>
                        <td> <?php echo $propiedad->id; ?> </td>
                        <td> <?php echo $propiedad->titulo; ?> </td>
                        <td> <img src="../../imagenes/<?php echo $propiedad->imagen; ?>" alt="Imágen de propiedad" class="imagen-tabla"> </td>
                        <td> $ <?php echo $propiedad->precio; ?>  </td>
                        <td>                            

                            <form method="POST" class="w-100" action="/propiedades/eliminar">
                                <!-- hidden = indica que es oculto, obtenemos el ID para ELIMINAR -->
                                <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">

                                <input type="hidden" name="tipo" value="propiedad">

                                <input type="submit" class="boton boton-rojo-block" value="Eliminar">
                            </form>

                            <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>            

        </table>

        <a href="/vendedores/crear" class="boton boton-verde">Nuevo(a) vendedor</a>

        <h2>Vendedores</h2>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Telefono</th>                    
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($vendedores as $vendedor): ?>
                    <tr>
                        <td> <?php echo $vendedor->id; ?> </td>
                        <td> <?php echo $vendedor->nombre . " " . $vendedor->apellido; ?> </td>
                        <td> <?php echo $vendedor->telefono; ?> </td>
                        <td>                            

                            <form method="POST" class="w-100" action="/vendedores/eliminar">                                
                                <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">

                                <input type="hidden" name="tipo" value="vendedor">

                                <input type="submit" class="boton boton-rojo-block" value="Eliminar">
                            </form>

                            <a href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>            

        </table>
</main>