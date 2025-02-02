<?php
// app/controllers/UsuarioController.php
require_once "models/Usuario.php";

class UsuarioController {

    // Registro de nuevo usuario
    public function registro($nombre, $email, $password) {
        $usuario = new Usuario();
        $resultado = $usuario->registrarUsuario($nombre, $email, $password);
        if ($resultado) {
            echo "Usuario registrado con éxito.";
        } else {
            echo "Error al registrar el usuario.";
        }
    }

    // Iniciar sesión
    public function login($email, $password) {
        $usuario = new Usuario();
        $user = $usuario->obtenerUsuarioPorEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nombre'] = $user['nombre'];
            $_SESSION['usuario_rol'] = $user['rol'];
            header("Location: /panel");
        } else {
            echo "Credenciales incorrectas.";
        }
    }

    // Cerrar sesión
    public function logout() {
        session_destroy();
        header("Location: /");
    }
}
?>
