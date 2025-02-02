<?php
include_once "header.php";
?>
<h2>Bienvenido a la Biblioteca Digital</h2>
<p>Explora nuestros libros y gestiona tus préstamos.</p>
<?php
// Obtener el contador de visitas desde la cookie
$cookie_name = "contador_visitas";
$contador = isset($_COOKIE[$cookie_name]) ? (int) $_COOKIE[$cookie_name] : 0;
?>
<p><strong>Has visitado esta página <?php echo $contador; ?> veces.</strong></p>

<?php include_once "footer.php"; ?>
