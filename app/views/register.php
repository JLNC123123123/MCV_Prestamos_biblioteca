<?php
include_once "header.php";
?>
<h2>Registro</h2>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form action="index.php?page=register" method="POST" enctype="multipart/form-data">
  <label>Nombre:</label>
  <input type="text" name="nombre" required>
  <br>
  <label>Email:</label>
  <input type="email" name="email" required>
  <br>
  <label>Password:</label>
  <input type="password" name="password" required>
  <br>
  <label>Foto de perfil:</label>
  <input type="file" name="foto">
  <br>
  <button type="submit">Registrarse</button>
</form>
<?php include_once "footer.php"; ?>
