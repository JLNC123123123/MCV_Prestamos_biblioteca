<?php
// app/controllers/UsuarioController.php
require_once __DIR__ . '/../models/Usuario.php';

class UsuarioController {
    private $usuarioModel;
    
    public function __construct() {
        $this->usuarioModel = new Usuario();
    }
    
    // Registro de usuario
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Recoger datos del formulario
            $nombre = $_POST['nombre'];
            $email  = $_POST['email'];
            $password = $_POST['password'];
            // Gestión de la imagen de perfil
            if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0){
                $foto_perfil = time() . "_" . $_FILES['foto']['name'];
                move_uploaded_file($_FILES['foto']['tmp_name'], "public/img/" . $foto_perfil);
            } else {
                $foto_perfil = "default_perfil.jpg";
            }
            $exito = $this->usuarioModel->registrar($nombre, $email, $password, 'general', $foto_perfil);
            if ($exito) {
                header("Location: index.php?page=login&msg=registro_exitoso");
            } else {
                $error = "Error al registrar el usuario.";
                include_once "app/views/register.php";
            }
        } else {
            include_once "app/views/register.php";
        }
    }
    
    // Login de usuario
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email    = $_POST['email'];
            $password = $_POST['password'];
            $usuario = $this->usuarioModel->login($email, $password);
            if ($usuario) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                // Guardar cookie (opcional) para recordar al usuario
                setcookie("user", $usuario['email'], time() + (86400 * 30), "/");
                header("Location: index.php?page=profile");
            } else {
                $error = "Credenciales incorrectas.";
                include_once "app/views/login.php";
            }
        } else {
            include_once "app/views/login.php";
        }
    }
    
    // Cerrar sesión
    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?page=home");
    }
    
    // Mostrar perfil
    public function profile() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?page=login");
            exit;
        }
        $usuario = $_SESSION['usuario'];
        include_once "app/views/profile.php";
    }
    
    // Administración de usuarios (solo admin)
    public function adminUsuarios() {
        session_start();
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 'admin') {
            header("Location: index.php?page=home");
            exit;
        }
        $usuarios = $this->usuarioModel->getAllUsuarios();
        include_once "app/views/admin_usuarios.php";
    }
}
?>
