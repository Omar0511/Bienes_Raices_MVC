<?php
    define('TEMPLATES_URL', __DIR__ . './templates');    
    define('FUNCIONES_URL', __DIR__ . '/${nombre}.php');
    define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

    function incluirTemplate(string $nombre, bool $inicio = false) {
        include TEMPLATES_URL . "/${nombre}.php";
    }

    function estaAutenticado() : bool {
        session_start();        
        
        if (!$_SESSION['login']) {
            header('Location: /');
        }

        return false;
    }

    function debuguear($variable) {
        echo "<pre>";
            var_dump($variable);
        echo "</pre>";
    }

    //Escapa HTML / Sanitizar
    function s($html) : string {
        $s = htmlspecialchars($html);
        return $s;
    }

    //Validar tipo de contenido
    function validarTipoContenido($tipo) {
        $tipos = ['vendedor', 'propiedad'];

        //Validar un string en un array
        return in_array($tipo, $tipos);
    }

    //Muestra los mensajes
    function mostrarNotificacion($codigo) {
        $mensaje = '';

        switch($codigo) {
            case 1: 
                $mensaje = 'Creado exitosamente';
                break;
            case 2: 
                $mensaje = 'Actualizado exitosamente';
                break;
            case 3: 
                $mensaje = 'Eliminado exitosamente';
                break;
            default:
                $mensaje = false;
                break;
        }

        return $mensaje;
    }

    function validarORedireccionar(string $url) {
        //Validar URL por ID válido
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) {
            //Cuando necesitamos leer una variable ponemos dobles comillas "$variable"
            //header("Location: /amdmin");
            header("Location: $url");
        }

        return $id;
    }