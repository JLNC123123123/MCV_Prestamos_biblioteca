-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS biblioteca_digital;

-- Usar la base de datos
USE biblioteca_digital;

-- Eliminar las tablas si ya existen
DROP TABLE IF EXISTS prestamos, libros, usuarios;

-- Crear la tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('invitado', 'general', 'admin') DEFAULT 'general',
    foto_perfil VARCHAR(255) DEFAULT 'default.jpg'
);

-- Crear la tabla de libros
CREATE TABLE libros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    portada VARCHAR(255) DEFAULT 'default.jpg',
    disponible BOOLEAN DEFAULT 1
);

-- Crear la tabla de préstamos
CREATE TABLE prestamos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    libro_id INT,
    fecha_prestamo DATE DEFAULT (CURRENT_DATE),
    fecha_devolucion DATE NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (libro_id) REFERENCES libros(id)
);

-- Insertar usuarios de prueba (contraseñas hasheadas con bcrypt en PHP)
INSERT INTO usuarios (nombre, email, password, rol, foto_perfil) VALUES
('Administrador', 'admin@biblioteca.com', '$2b$12$KGThWKNBvHyWg6yI8DGc9.eP5kjz2hZtKbswoq81ZI8nnWFUZC7Mi', 'admin', 'admin.jpg'),
('Juan Pérez', 'juan@gmail.com', '$2b$12$oeSvw0g4TrQO2LnxaeP0IeuUKSXL8EeO28DzRSndwx.unsmguLQnO', 'general', 'juan.jpg'),
('María López', 'maria@gmail.com', '$2b$12$HQl0wJpUiVVedDBkX9zxr.fuoKz6XrTJd3mI5idv..EeE.czJ/iZK', 'general', 'maria.jpg');

--Las contraseñas son root, pepo y pepa respectivamente

-- Insertar libros de prueba
INSERT INTO libros (titulo, autor, portada, disponible) VALUES
('Cien años de soledad', 'Gabriel García Márquez', 'cien_anos.jpg', 1),
('1984', 'George Orwell', '1984.jpg', 1),
('El Quijote', 'Miguel de Cervantes', 'quijote.jpg', 1),
('Harry Potter y la piedra filosofal', 'J.K. Rowling', 'hp1.jpg', 1),
('Los juegos del hambre', 'Suzanne Collins', 'juegos_hambre.jpg', 1);

