<?php 

    namespace MVC;

    class Router {
        /*
            public function __construct()
            {
                echo "Creando router";
            }

            Vemos resultado en index.php con:
            $router = new Router();
        */

        public $rutasGET = [];
        public $rutasPOST = [];

        public function get($url, $fn)
        {
            $this->rutasGET[$url] = $fn;
        }

        public function post($url, $fn) {
            $this->rutasPOST[$url] = $fn;
        }

        public function comprobarRutas()
        {
            session_start();

            $auth = $_SESSION['login'] ?? null;

            //Arreglo de rutas protegidas
            $rutas_protegidas = [
                '/admin',
                '/propiedades/crear',
                '/propiedades/actualizar',
                '/propiedades/eliminar',
                '/vendedores/crear',
                '/vendedores/actualizar',
                '/vendedores/eliminar',
            ];

            $urlActual = $_SERVER['PATH_INFO'] ?? '/';

            $metodo = $_SERVER['REQUEST_METHOD'];

            //debuguear($metodo);

            if ($metodo === 'GET') {
                $fn = $this->rutasGET[$urlActual] ?? null;
            } else {
                $fn = $this->rutasPOST[$urlActual] ?? null;
            }

            //Proteger las rutas
            if (in_array($urlActual, $rutas_protegidas) && !$auth) {
                header('Location: /');
            }

            if ($fn) {
                /*
                    Manda llamar una funcion que 
                    no sabemos como se llama.
                    $hits = toma las variables rutasGET/POST
                */
                call_user_func($fn, $this);
            } else {
                echo "Página no encontrada";
            }
        }

        //Muestra una vista
        public function render($view, $datos = []) {
            foreach ($datos as $key => $value) {
                //$$key == variable de variable
                $$key = $value;
            }

            //Iniciar almacenamiento en memoria
            ob_start();

            //ob_start toma esta vista y la almacena en memoria
            include __DIR__ . "/views/$view.php";

            //Limpia el espacio en memoria
            $contenido = ob_get_clean();

            include __DIR__ . "/views/layout.php";
        }
    }