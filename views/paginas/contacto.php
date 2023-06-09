<main class="contenedor">
    <h1>Contacto</h1>

    <?php if ($mensaje) { ?>
            <p class='alerta exito'> <?php echo $mensaje; ?> </p>;
    <?php } ?>

    <picture>   
        <source srcset="/build/img/destacada3.webp" type="image/webp">
        <source srcset="/build/img/destacada3.jpg" type="image/jpeg">
        <img src="/build/img/destacada3.jpg" alt="Imagen Contacto" loading="lazy">
    </picture>

    <h2>LLene el formulario de contacto</h2>

    <form class="formulario" action="/contacto" method="POST">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Escribe tu Nombre" id="nombre" name="contacto[nombre]" required>

            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" name="contacto[mensaje]" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <label for="opciones">Vende o Compra:</label>
            <select id="opciones" name="contacto[tipo]" required>
                <option value="" disabled selected> --> Seleccione <-- </option>
                <option value="">Compra</option>
                <option value="">Vende</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input type="number" placeholder="Escribe tu precio o presupuesto" id="presupuesto" name="contacto[precio]" required>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <p>Como desea ser contactado</p>

            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" id="contactar-telefono" value="telefono" name="contacto[contacto]" required>

                <label for="contactar-email">Email</label>
                <input type="radio" id="contactar-email" value="email" name="contacto[contacto]" required>  
            </div>

            <div id="contacto"></div>
        </fieldset>

        <input class="boton-verde" type="submit" value="Enviar">

    </form>

</main>