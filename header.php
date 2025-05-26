<?php
if (!isset($_SESSION)) session_start();
$usuario = $_SESSION['usuario'] ?? 'Invitad@';
?>

<header class="header-app">
  <div class="header-container">
    <h1 class="logo">Planning</h1>
    <nav class="nav-links">
      <a href="index.php">Home</a>
      <a href="equipos.php">Equipos</a>
      <a href="proyectos.php">Proyectos</a>
      <a href="tareas.php">Tareas</a>
      <a href="call.php">Call</a>
      <a href="contacto.php">Contacto</a>
      <a href="logout.php" class="logout-btn">Cerrar sesión</a>
    </nav>
  </div>
</header>
