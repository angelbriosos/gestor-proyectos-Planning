<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}
$usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Home | Planning</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="home.css">
</head>
<body>
  <?php include 'header.php'; ?>

  <main class="home-content">
    <div class="bienvenida">
      <h2>Bienvenid@, <?php echo htmlspecialchars($usuario); ?> 👋</h2>
      <p class="eslogan">Planning es la herramienta perfecta para organizar tus equipos, gestionar tus proyectos y coordinar tareas de forma sencilla y eficaz.</p>
    </div>
  </main>
</body>
</html>
