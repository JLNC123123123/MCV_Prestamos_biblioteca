<?php
include_once "header.php";
?>
<h2>Iniciar Sesión</h2>
<?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form action="index.php?page=login" method="POST">
  <label>Email:</label>
  <input type="email" name="email" required>
  <br>
  <label>Password:</label>
  <input type="password" name="password" required>
  <br>
  <button type="submit">Entrar</button>
</form>
<?php include_once "footer.php"; ?>
