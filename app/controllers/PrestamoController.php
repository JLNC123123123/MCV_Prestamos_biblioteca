<?php
// app/controllers/PrestamoController.php
require_once __DIR__ . '/../models/Prestamo.php';
require_once __DIR__ . '/../models/Libro.php';

class PrestamoController {
    private $prestamoModel;
    private $libroModel;
    
    public function __construct() {
        $this->prestamoModel = new Prestamo();
        $this->libroModel = new Libro();
    }
    
    // Solicitar préstamo de un libro
    public function solicitar() {
        session_start();
        if (!isset($_SESSION['usuario'])) {
            header("Location: index.php?page=login");
            exit;
        }
        if (isset($_GET['libro_id'])) {
            $libro_id = $_GET['libro_id'];
            // Verificar si el libro está disponible
            $libro = $this->libroModel->getLibroById($libro_id);
            if ($libro && $libro['disponible']) {
                // Registrar el préstamo
                $exito = $this->prestamoModel->solicitarPrestamo($_SESSION['usuario']['id'], $libro_id);
                if ($exito) {
                    // Actualizar disponibilidad
                    $this->libroModel->actualizarDisponibilidad($libro_id, 0);
                    header("Location: index.php?page=profile&msg=prestamo_exitoso");
                } else {
                    header("Location: index.php?page=lista_libros&msg=error_prestamo");
                }
            } else {
                header("Location: index.php?page=lista_libros&msg=no_disponible");
            }
        } else {
            header("Location: index.php?page=lista_libros");
        }
    }
}
?>
