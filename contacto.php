<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Contacto | Planning</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include 'header.php'; ?>

  <main class="contenido">
    <h2>Formulario de contacto</h2>
    <p>¿Tienes dudas, sugerencias o necesitas ayuda? Escríbenos.</p>

    <form action="enviar_contacto.php" method="POST" class="formulario">
      <input type="text" name="nombre" placeholder="Nombre" required>
      <input type="text" name="apellidos" placeholder="Apellidos" required>
      <input type="tel" name="telefono" placeholder="Teléfono" required>
      <input type="email" name="email" placeholder="Correo electrónico" required>
      <textarea name="mensaje" placeholder="Escribe tu mensaje..." rows="5" required></textarea>
      <button type="submit">Enviar</button>
    </form>
  </main>
</body>
</html>
