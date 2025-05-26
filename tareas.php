<?php
include 'conexion.php';
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

// Obtener todos los proyectos
$proyectos = $conexion->query("SELECT * FROM proyectos");

// Obtener tareas agrupadas por proyecto
$tareas_proyecto = [];
$tareas = $conexion->query("SELECT * FROM tareas");
while ($t = $tareas->fetch_assoc()) {
  $tareas_proyecto[$t['id_proyecto']][] = $t;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Tareas | Planning</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include 'header.php'; ?>

  <main class="contenido">
    <h2>Panel de Tareas por Proyecto</h2>

    <?php while ($p = $proyectos->fetch_assoc()): ?>
      <div class="tarjeta">
        <h3><?php echo htmlspecialchars($p['nombre']); ?></h3>

        <?php
        $tareas = $tareas_proyecto[$p['id']] ?? [];
        if (count($tareas) === 0): ?>
          <p>No hay tareas asignadas a este proyecto.</p>
        <?php else: ?>
          <table class="tabla-tareas">
            <tr>
              <th>Descripción</th>
              <th>Estado</th>
            </tr>
            <?php foreach ($tareas as $t): ?>
              <tr class="<?php echo $t['estado']; ?>">
                <td><?php echo htmlspecialchars($t['descripcion']); ?></td>
                <td><?php echo ucfirst($t['estado']); ?></td>
              </tr>
            <?php endforeach; ?>
          </table>
        <?php endif; ?>
      </div>
    <?php endwhile; ?>
  </main>
</body>
</html>
