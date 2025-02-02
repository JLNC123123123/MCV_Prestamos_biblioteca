<?php
include_once "header.php";
?>
<h2>Administración de Libros</h2>
<!-- Formulario para añadir un libro -->
<form action="index.php?page=insertar_libro" method="POST" enctype="multipart/form-data">
  <label>Título:</label>
  <input type="text" name="titulo" required>
  <br>
  <label>Autor:</label>
  <input type="text" name="autor" required>
  <br>
  <label>Portada:</label>
  <input type="file" name="portada">
  <br>
  <button type="submit">Añadir Libro</button>
</form>
<hr>
<!-- Lista de libros -->
<h3>Listado de Libros</h3>
<table border="1">
  <tr>
    <th>ID</th>
    <th>Título</th>
    <th>Autor</th>
    <th>Disponible</th>
  </tr>
  <?php foreach($libros as $libro): ?>
    <tr>
      <td><?php echo $libro['id']; ?></td>
      <td><?php echo $libro['titulo']; ?></td>
      <td><?php echo $libro['autor']; ?></td>
      <td><?php echo $libro['disponible'] ? 'Sí' : 'No'; ?></td>
    </tr>
  <?php endforeach; ?>
</table>
<?php include_once "footer.php"; ?>
