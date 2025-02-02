<?php
// app/controllers/LibroController.php
require_once __DIR__ . '/../models/Libro.php';

class LibroController {
    private $libroModel;
    
    public function __construct() {
        $this->libroModel = new Libro();
    }
    
    // Mostrar lista de libros (zona pública)
    public function listar() {
        $libros = $this->libroModel->getAllLibros();
        include_once "app/views/lista_libros.php";
    }
    
    // Mostrar detalles de un libro
    public function detalle() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $libro = $this->libroModel->getLibroById($id);
            include_once "app/views/libro_detalle.php";
        } else {
            header("Location: index.php?page=lista_libros");
        }
    }
    
    // Administración de libros (solo admin)
    public function adminLibros() {
        session_start();
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 'admin') {
            header("Location: index.php?page=home");
            exit;
        }
        $libros = $this->libroModel->getAllLibros();
        include_once "app/views/admin_libros.php";
    }
    
    // Método para insertar un libro (desde un formulario de admin)
    public function insertar() {
        session_start();
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] != 'admin') {
            header("Location: index.php?page=home");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $titulo = $_POST['titulo'];
            $autor  = $_POST['autor'];
            if(isset($_FILES['portada']) && $_FILES['portada']['error'] == 0){
                $portada = time() . "_" . $_FILES['portada']['name'];
                move_uploaded_file($_FILES['portada']['tmp_name'], "public/img/" . $portada);
            } else {
                $portada = "default.jpg";
            }
            $exito = $this->libroModel->insertar($titulo, $autor, $portada);
            if ($exito) {
                header("Location: index.php?page=admin_libros&msg=libro_insertado");
            } else {
                $error = "Error al insertar el libro.";
                include_once "app/views/admin_libros.php";
            }
        } else {
            include_once "app/views/admin_libros.php";
        }
    }
}
?>
