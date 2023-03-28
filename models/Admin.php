<?php 

    namespace Model;

    class Admin extends ActiveRecord {
        //protected porque solo necesitamos acceder a ellos desde esta clase
        protected static $tabla = 'usuarios';
        protected static $columnasDB = ['id', 'email', 'password'];

        /*
            public porque accederemos desde el modelo como en el controlador
            Recomendado poner el mismo nombre que tienen las mismas columnas de la BD
        */
        public $id;
        public $email;
        public $password;

        public function __construct($args = [])
        {
            $this->id = $args['id'] ?? null;
            $this->email = $args['email'] ?? '';
            $this->password = $args['password'] ?? '';
        }

        public function validar()
        {
            if (!$this->email) {
            self::$errores[] = 'El Email es obligatorio';
            }         

            if (!$this->password) {
                self::$errores[] = 'El Password es obligatorio';
            }

            return self::$errores;
        }

        public function existeUsuario() {
            //Revisar si existe usuario
            $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1;";
            // debuguear($query);
            
            $resultado = self::$conexion->query($query);
            // debuguear($resultado);
            // exit;

            if (!$resultado->num_rows) {
                self::$errores[] = 'El usuario no existe';
                return;
            }

            return $resultado;
        }

        public function comprobarPassword($resultado) {
            //Trae el resultado de lo que encontro en la BD: fetch_object();
            $usuario = $resultado->fetch_object();
            // debuguear($usuario);
            // exit;

            $autenticado = password_verify($this->password, $usuario->password);

            if (!$autenticado) {
                self::$errores[] = 'El password es incorrecto';                
            }

            return $autenticado;
        }

        public function autenticar() {
            session_start();

            //LLenar el arreglo de session
            $_SESSION['usuario'] = $this->email;
            $_SESSION['login'] = true;

            header('Location: /admin');
        }
    }