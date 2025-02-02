<?php
// app/views/header.php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Biblioteca Digital</title>
  <link rel="stylesheet" href="public/css/estilos.css">
</head>
<body>
  <header>
    <h1>Biblioteca Digital</h1>
    <nav>
      <ul>
        <li><a href="index.php?page=home">Inicio</a></li>
        <li><a href="index.php?page=lista_libros">Libros</a></li>
        <?php if (isset($_SESSION['usuario'])): ?>
          <li><a href="index.php?page=profile">Mi Perfil</a></li>
          <?php if($_SESSION['usuario']['rol'] == 'admin'): ?>
              <li><a href="index.php?page=admin_usuarios">Usuarios</a></li>
              <li><a href="index.php?page=admin_libros">Administrar Libros</a></li>
          <?php endif; ?>
          <li><a href="index.php?page=logout">Cerrar Sesión</a></li>
        <?php else: ?>
          <li><a href="index.php?page=login">Iniciar Sesión</a></li>
          <li><a href="index.php?page=register">Registrarse</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>
  <main>
