<?php
require_once "config/database.php";

class Usuario {
    private $conn;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function registrarUsuario($nombre, $email, $password, $rol = 'general') {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuarios (nombre, email, password, rol) VALUES (:nombre, :email, :password, :rol)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['nombre' => $nombre, 'email' => $email, 'password' => $passwordHash, 'rol' => $rol]);
    }

    public function obtenerUsuarios() {
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
