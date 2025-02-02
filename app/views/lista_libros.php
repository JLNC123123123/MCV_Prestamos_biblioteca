<?php
include_once "header.php";
?>
<h2>Listado de Libros</h2>
<?php foreach($libros as $libro): ?>
  <div class="libro">
    <h3><?php echo $libro['titulo']; ?></h3>
    <p>Autor: <?php echo $libro['autor']; ?></p>
    <img src="public/img/<?php echo $libro['portada']; ?>" alt="Portada" width="100">
    <p>
      <a href="index.php?page=detalle_libro&id=<?php echo $libro['id']; ?>">Ver detalles</a>
      <?php if(isset($_SESSION['usuario']) && $libro['disponible']): ?>
          | <a href="index.php?page=solicitar_prestamo&libro_id=<?php echo $libro['id']; ?>">Solicitar Préstamo</a>
      <?php endif; ?>
    </p>
  </div>
<?php endforeach; ?>
<?php include_once "footer.php"; ?>
