<?php
include_once "header.php";
?>
<h2>Mi Perfil</h2>
<p>Bienvenido, <?php echo $_SESSION['usuario']['nombre']; ?>.</p>
<img src="public/img/<?php echo $_SESSION['usuario']['foto_perfil']; ?>" alt="Foto de Perfil" width="100">
<?php
// Mostrar mensajes de acción, por ejemplo préstamo exitoso
if(isset($_GET['msg'])){
    echo "<p>" . htmlspecialchars($_GET['msg']) . "</p>";
}
?>
<?php include_once "footer.php"; ?>
