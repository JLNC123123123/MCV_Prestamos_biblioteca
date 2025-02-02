<?php
// app/models/Libro.php
require_once "config/database.php";

class Libro {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Registrar libro
    public function registrarLibro($titulo, $autor, $portada) {
        $sql = "INSERT INTO libros (titulo, autor, portada) VALUES (:titulo, :autor, :portada)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['titulo' => $titulo, 'autor' => $autor, 'portada' => $portada]);
    }

    // Listar libros
    public function obtenerLibros() {
        $sql = "SELECT * FROM libros";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener libro por ID
    public function obtenerLibroPorId($id) {
        $sql = "SELECT * FROM libros WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
