<?php
    namespace Controllers;
    use MVC\Router;
    use Model\Vendedor;

    /*
        Static = no queremos una instancia, 
        se puede llamar desde ROUTER
    */
    class VendedorController {
        public static function crear(Router $router) {
            $errores = Vendedor::getErrores();
            
            $vendedor = new Vendedor;

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                //Crear nueva instancia
                $vendedor = new Vendedor($_POST['vendedor']);
        
                $errores = $vendedor->validar();
        
                if (empty($errores)) {
                    $vendedor->guardar();
                }
            }

            $router->render('vendedores/crear', [
                'errores' => $errores,
                'vendedor' => $vendedor
            ]);
        }

        public static function actualizar(Router $router) {
            $errores = Vendedor::getErrores();

            $id = validarORedireccionar('/admin');

            //Obtener datos del vendedor a actualizar
            $vendedor = Vendedor::find($id);    
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                //Asignar valores
                $args = $_POST['vendedor'];
        
                //Sincronizar objeto en memoria con lo que escriba el usuario
                $vendedor->sincronizar($args);
        
                //Validacion
                $errores = $vendedor->validar();
        
                if (empty($errores)) {
                    $vendedor->guardar();
                }
            }

            $router->render('vendedores/actualizar', [
                'errores' => $errores,
                'vendedor' => $vendedor
            ]);
        }

        public static function eliminar() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                //Validar el id
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);

                if ($id) {
                    //Valida el tipo a eliminar
                    $tipo = $_POST['tipo'];
                    //debuguear($_POST);
                    if (validarTipoContenido($tipo)) {
                        $vendedor = Vendedor::find($id);
                        $vendedor->eliminar();
                    }
                }
            }
        }
    }