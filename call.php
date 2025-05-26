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
  <title>Call | Planning</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include 'header.php'; ?>

  <main class="contenido">
    <h2>Comunicación entre usuarios</h2>

    <section class="call-section">
      <h3>Videollamada</h3>
      <p>Puedes iniciar una reunión a través de Zoom pulsando el botón:</p>
      <a href="https://zoom.us" target="_blank" class="btn-zoom">Unirse a una reunión Zoom</a>
    </section>

    <section class="email-section">
      <h3>Enviar un mensaje</h3>
      <form action="enviar_mensaje.php" method="POST" class="formulario">
        <input type="text" name="para" placeholder="Usuario destinatario" required>
        <textarea name="mensaje" rows="4" placeholder="Escribe tu mensaje aquí..." required></textarea>
        <button type="submit">Enviar mensaje</button>
      </form>
    </section>
  </main>
</body>
</html>

