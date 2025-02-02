<?php
// index.php
// Iniciar la sesión (si no se ha iniciado ya en cada vista)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Función simple para limpiar la variable GET
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Rutas y llamadas a controladores
switch($page) {
    case 'home':
        include_once "app/views/home.php";
        break;
    case 'login':
        require_once "app/controllers/UsuarioController.php";
        $usuarioController = new UsuarioController();
        $usuarioController->login();
        break;
    case 'register':
        require_once "app/controllers/UsuarioController.php";
        $usuarioController = new UsuarioController();
        $usuarioController->register();
        break;
    case 'logout':
        require_once "app/controllers/UsuarioController.php";
        $usuarioController = new UsuarioController();
        $usuarioController->logout();
        break;
    case 'profile':
        require_once "app/controllers/UsuarioController.php";
        $usuarioController = new UsuarioController();
        $usuarioController->profile();
        break;
    case 'lista_libros':
        require_once "app/controllers/LibroController.php";
        $libroController = new LibroController();
        $libroController->listar();
        break;
    case 'detalle_libro':
        require_once "app/controllers/LibroController.php";
        $libroController = new LibroController();
        $libroController->detalle();
        break;
    case 'solicitar_prestamo':
        require_once "app/controllers/PrestamoController.php";
        $prestamoController = new PrestamoController();
        $prestamoController->solicitar();
        break;
    case 'admin_usuarios':
        require_once "app/controllers/UsuarioController.php";
        $usuarioController = new UsuarioController();
        $usuarioController->adminUsuarios();
        break;
    case 'admin_libros':
        require_once "app/controllers/LibroController.php";
        $libroController = new LibroController();
        $libroController->adminLibros();
        break;
    case 'insertar_libro':
        require_once "app/controllers/LibroController.php";
        $libroController = new LibroController();
        $libroController->insertar();
        break;
    default:
        include_once "app/views/home.php";
        break;
}
?>
