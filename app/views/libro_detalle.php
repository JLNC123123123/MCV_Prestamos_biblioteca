<?php
include_once "header.php";
?>
<h2>Detalle del Libro</h2>
<h3><?php echo $libro['titulo']; ?></h3>
<p>Autor: <?php echo $libro['autor']; ?></p>
<img src="public/img/<?php echo $libro['portada']; ?>" alt="Portada" width="150">
<p>Disponible: <?php echo $libro['disponible'] ? 'Sí' : 'No'; ?></p>
<?php if(isset($_SESSION['usuario']) && $libro['disponible']): ?>
  <p><a href="index.php?page=solicitar_prestamo&libro_id=<?php echo $libro['id']; ?>">Solicitar Préstamo</a></p>
<?php endif; ?>
<?php include_once "footer.php"; ?>
