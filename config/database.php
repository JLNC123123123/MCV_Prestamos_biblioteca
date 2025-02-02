<?php
// config/database.php
class Database {
    private $host = "localhost";
    private $dbname = "biblioteca_digital";
    private $username = "root";
    private $password = "";
    public $conn;

    public function connect() {
        $this->conn = null;
        try {
            // Conexión usando PDO
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->dbname, 
                $this->username, 
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            // Muestra una pantalla de error genérica manteniendo el menú
            include_once "app/views/header.php";
            echo "<h2>Ocurrió un error al acceder a la base de datos.</h2>";
            include_once "app/views/footer.php";
            exit;
        }
        return $this->conn;
    }
}
?>

