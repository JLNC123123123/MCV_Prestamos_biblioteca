<?php
// app/models/Usuario.php
require_once "config/database.php";

class Usuario {
    private $conn;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Registro de usuario
    public function registrarUsuario($nombre, $email, $password, $rol = 'general', $foto_perfil = 'default.jpg') {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuarios (nombre, email, password, rol, foto_perfil) VALUES (:nombre, :email, :password, :rol, :foto_perfil)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'nombre' => $nombre, 
            'email' => $email, 
            'password' => $passwordHash, 
            'rol' => $rol, 
            'foto_perfil' => $foto_perfil
        ]);
    }

    // Obtener usuario por correo
    public function obtenerUsuarioPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Obtener todos los usuarios (solo admin)
    public function obtenerUsuarios() {
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
