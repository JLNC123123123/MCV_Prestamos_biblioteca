<?php
// app/controllers/LibroController.php
require_once "models/Libro.php";

class LibroController {

    // Listar libros
    public function listarLibros() {
        $libro = new Libro();
        $libros = $libro->obtenerLibros();
        return $libros;
    }

    // Ver detalle de libro
    public function verLibro($id) {
        $libro = new Libro();
        $libroDetalle = $libro->obtenerLibroPorId($id);
        return $libroDetalle;
    }
}
?>
