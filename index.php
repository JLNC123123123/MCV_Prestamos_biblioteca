<?php
session_start();

require_once "controllers/UsuarioController.php";
require_once "controllers/LibroController.php";

$usuarioController = new UsuarioController();
$libroController = new LibroController();

// Lógica de rutas y acciones
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre'])) {
    $usuarioController->registro($_POST['nombre'], $_POST['email'], $_POST['password']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'])) {
    $usuarioController->login($_POST['email'], $_POST['password']);
}

if ($_GET['action'] == 'logout') {
    $usuarioController->logout();
}

if ($_GET['action'] == 'list') {
    $libros = $libroController->listarLibros();
    foreach ($libros as $libro) {
        echo $libro['titulo'] . '<br>';
    }
}
?>
