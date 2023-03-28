<?php
    require_once __DIR__ . '/../include/app.php';

    //Indicamos que usaremos el ROuter

    use Controllers\LoginController;

    use MVC\Router;

    use Controllers\PropiedadController;

    use Controllers\VendedorController;

    use Controllers\PaginasController;

    //es lo que tiene el construct
    $router = new Router();

    /*
        Nos trae el namespace de donde se encuentra esa función,
        es decir; en que clase se encuentra el método
        debuguear(PropiedadControllers::class);
    */

    //Zona privada
    $router->get('/admin', [PropiedadController::class, 'index']);

    $router->get('/propiedades/crear', [PropiedadController::class, 'crear']);
    $router->post('/propiedades/crear', [PropiedadController::class, 'crear']);

    $router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
    $router->post('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);

    $router->post('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

    $router->get('/vendedores/crear', [VendedorController::class, 'crear']);
    $router->post('/vendedores/crear', [VendedorController::class, 'crear']);

    $router->get('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
    $router->post('/vendedores/actualizar', [VendedorController::class, 'actualizar']);

    $router->post('/vendedores/eliminar', [VendedorController::class, 'eliminar']);
    
    //Zona pública
    $router->get('/', [PaginasController::class, 'index']);
    $router->get('/nosotros', [PaginasController::class, 'nosotros']);
    $router->get('/propiedades', [PaginasController::class, 'propiedades']);
    $router->get('/propiedad', [PaginasController::class, 'propiedad']);
    $router->get('/blog', [PaginasController::class, 'blog']);
    $router->get('/entrada', [PaginasController::class, 'entrada']);

    $router->get('/contacto', [PaginasController::class, 'contacto']);
    $router->post('/contacto', [PaginasController::class, 'contacto']);

    //Login y Autenticación
    $router->get('/login', [LoginController::class, 'login']);
    $router->post('/login', [LoginController::class, 'login']);

    $router->get('/logout', [LoginController::class, 'logout']);
    
    $router->comprobarRutas();


    /**
     * Primero se crea aqui el router ya se get o post
     * depues el controlador
     * despues el modelo
     * por ultimo la vista
     */