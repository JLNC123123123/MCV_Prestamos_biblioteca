<?php
include_once "header.php";
?>
<h2>Gestión de Usuarios</h2>
<table border="1">
  <tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Email</th>
    <th>Rol</th>
  </tr>
  <?php foreach($usuarios as $usuario): ?>
    <tr>
      <td><?php echo $usuario['id']; ?></td>
      <td><?php echo $usuario['nombre']; ?></td>
      <td><?php echo $usuario['email']; ?></td>
      <td><?php echo $usuario['rol']; ?></td>
    </tr>
  <?php endforeach; ?>
</table>
<?php include_once "footer.php"; ?>
