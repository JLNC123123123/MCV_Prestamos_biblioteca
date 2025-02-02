<?php
// app/models/Usuario.php
require_once __DIR__ . '/../../config/database.php';

class Usuario {
    private $conn;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Registrar un nuevo usuario
    public function registrar($nombre, $email, $password, $rol = 'general', $foto_perfil = 'default_perfil.jpg') {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuarios (nombre, email, password, rol, foto_perfil) VALUES (:nombre, :email, :password, :rol, :foto_perfil)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'nombre'       => $nombre,
            'email'        => $email,
            'password'     => $passwordHash,
            'rol'          => $rol,
            'foto_perfil'  => $foto_perfil
        ]);
    }

    // Autenticar usuario
    public function login($email, $password) {
        $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario;
        }
        return false;
    }
    
    // Obtener usuario por ID
    public function getUsuarioById($id) {
        $sql = "SELECT * FROM usuarios WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Obtener todos los usuarios (para administración)
    public function getAllUsuarios() {
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
