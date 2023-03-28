<?php

    namespace Controllers;

    use MVC\Router;

    use Model\Propiedad;

    use Model\Vendedor;

    use Intervention\Image\ImageManagerStatic as Image;

    class PropiedadController {
        /*
            public function index() {
                echo "Asi tenemos que aplicar una instancia";
            }
            Si la cambiamos con static, ya no es necesario instanciar
        */
        public static function index(Router $router) {
            $propiedades = Propiedad::all();

            $vendedores = Vendedor::all();

            $resultado = $_GET['resultado'] ?? null;

            $router->render('/propiedades/admin', [
                'propiedades' => $propiedades,
                'resultado' => $resultado,
                'vendedores' => $vendedores
            ]);
        }

        public static function crear(Router $router) {
            $propiedad = new Propiedad;
            $vendedores = Vendedor::all();
            //Arreglo con mensaje de errores
            $errores = Propiedad::getErrores();

            //Ejecuta el código después de que el usuario envía el formulario
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                //Crea una nueva instancia
                $propiedad = new Propiedad($_POST['propiedad']);
        
                $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
        
                //Setear la imagen
                //Realiza un resize a la imagen con intervention, 800 ancho, 600 alto
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);            
                    $propiedad->setImagen($nombreImagen);
                }
        
                //Se mandan a llamar desde Clases Propiedad
                $errores = $propiedad->validar();
        
                //Revisar que el arreglo de errores este vacío
                if (empty($errores)) {            
                    //Crear la carpeta para subir imagenes
                    if (!is_dir(CARPETA_IMAGENES)) {
                        mkdir(CARPETA_IMAGENES);
                    }    
                    //Guardar imágen en el servidpr
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
        
                    //Guardar en la BD
                    $propiedad->guardar();
                }
            }
            
            $router->render('/propiedades/crear', [
                'propiedad' => $propiedad,
                'vendedores' => $vendedores,
                'errores' => $errores
            ]);
        }

        public static function actualizar(Router $router) {
            /*
                Se hace prueba ponniendo en la ur:
                original: http://localhost:3000/propiedades/actualizar?id=1
                prueba: http://localhost:3000/propiedades/actualizar?id=hola
                y te manda al admin
            */
            $id = validarORedireccionar('/admin');

            $propiedad = Propiedad::find($id);
            
            /*
                Del modelo: $vendedores = Vendedor::all();
                lo pasamos a la vista:
                $router->render('/propiedades/actualizar', [
                'propiedad' => $propiedad,
                'vendedores' => $vendedores,
                'errores' => $errores
            ]);
            */
            $vendedores = Vendedor::all();

            $errores = Propiedad::getErrores();

            //Método POST para actualizar
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                //Asignar los atributos
                $args = $_POST['propiedad'];
        
                $propiedad->sincronizar($args);        
        
                $errores = $propiedad->validar();
        
                $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
                //Setear la imagen
                //Realiza un resize a la imagen con intervention, 800 ancho, 600 alto
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);            
                    $propiedad->setImagen($nombreImagen);
                }
                
                if (empty($errores)) {
                    if ($_FILES['propiedad']['tmp_name']['imagen']) {
                        //Almacenar la imagen
                        $image->save(CARPETA_IMAGENES . $nombreImagen);
                    }
        
                    $propiedad->guardar();
                }
            }

            $router->render('/propiedades/actualizar', [
                'propiedad' => $propiedad,
                'vendedores' => $vendedores,
                'errores' => $errores
            ]);
        }

        public static function eliminar() {
            //Eliminar propiedades
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                //Validar id
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);

                if ($id) {
                    $tipo = $_POST['tipo'];

                    if(validarTipoContenido($tipo)) {
                        $propiedad = Propiedad::find($id);

                        $propiedad->eliminar();
                    }
                }
            }
        }
    }