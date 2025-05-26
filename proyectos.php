<?php
include 'conexion.php';
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

// Obtener proyectos
$proyectos = $conexion->query("SELECT * FROM proyectos");

// Obtener usuarios
$usuarios = $conexion->query("SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Proyectos | Planning</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include 'header.php'; ?>

  <main class="contenido">
    <h2>Proyectos actuales</h2>

    <?php while ($p = $proyectos->fetch_assoc()): ?>
      <div class="tarjeta">
        <h3><?php echo htmlspecialchars($p['nombre']); ?></h3>
        <p><strong>Estado:</strong> <?php echo $p['estado']; ?></p>
        <div class="barra-progreso">
          <div class="progreso" style="width: <?php echo $p['progreso']; ?>%;"></div>
        </div>
        <p><?php echo $p['progreso']; ?>% completado</p>
      </div>
    <?php endwhile; ?>

    <h2>Crear nuevo proyecto</h2>
    <form action="crear_proyecto.php" method="POST" class="formulario">
      <input type="text" name="nombre" placeholder="Nombre del proyecto" required>

      <label for="estado">Estado:</label>
      <select name="estado" required>
        <option value="sin empezar">Sin empezar</option>
        <option value="en curso">En curso</option>
        <option value="finalizado">Finalizado</option>
      </select>

      <label for="progreso">Progreso (%):</label>
      <input type="number" name="progreso" min="0" max="100" required>

      <label>Asignar usuarios:</label>
      <?php
      while ($u = $usuarios->fetch_assoc()):
      ?>
        <div>
          <input type="checkbox" name="usuarios[]" value="<?php echo $u['id']; ?>">
          <?php echo htmlspecialchars($u['nombre']); ?>
        </div>
      <?php endwhile; ?>

      <button type="submit">Crear proyecto</button>
    </form>
  </main>
</body>
</html>

