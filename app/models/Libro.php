<?php
// app/models/Libro.php
require_once __DIR__ . '/../../config/database.php';

class Libro {
    private $conn;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }
    
    // Insertar un nuevo libro (solo admin)
    public function insertar($titulo, $autor, $portada = 'default.jpg') {
        $sql = "INSERT INTO libros (titulo, autor, portada) VALUES (:titulo, :autor, :portada)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'titulo'   => $titulo,
            'autor'    => $autor,
            'portada'  => $portada
        ]);
    }
    
    // Obtener todos los libros
    public function getAllLibros() {
        $sql = "SELECT * FROM libros";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Obtener detalles de un libro
    public function getLibroById($id) {
        $sql = "SELECT * FROM libros WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    // Actualizar disponibilidad del libro
    public function actualizarDisponibilidad($id, $disponible) {
        $sql = "UPDATE libros SET disponible = :disponible WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['disponible' => $disponible, 'id' => $id]);
    }
}
?>
