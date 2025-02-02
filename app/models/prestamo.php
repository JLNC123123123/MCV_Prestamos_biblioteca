<?php
// app/models/Prestamo.php
require_once __DIR__ . '/../../config/database.php';

class Prestamo {
    private $conn;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }
    
    // Registrar un préstamo
    public function solicitarPrestamo($usuario_id, $libro_id) {
        $sql = "INSERT INTO prestamos (usuario_id, libro_id) VALUES (:usuario_id, :libro_id)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'usuario_id' => $usuario_id,
            'libro_id'   => $libro_id
        ]);
    }
    
    // Obtener préstamos de un usuario
    public function getPrestamosPorUsuario($usuario_id) {
        $sql = "SELECT p.*, l.titulo FROM prestamos p 
                JOIN libros l ON p.libro_id = l.id 
                WHERE p.usuario_id = :usuario_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['usuario_id' => $usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
