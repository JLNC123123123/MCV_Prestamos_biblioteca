<?php
// config/database.php
class Database {
    private $host = "localhost";
    private $dbname = "biblioteca_digital";  // Nombre de la base de datos
    private $username = "root";  // Usuario de la base de datos
    private $password = "";      // Contraseña del usuario
    public $conn;

    // Método para establecer la conexión a la BD
    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
        return $this->conn;
    }
}
?>

