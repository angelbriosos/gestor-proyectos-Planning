<?php
include 'conexion.php';
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

// Obtener todos los usuarios
$usuarios = $conexion->query("SELECT * FROM usuarios");

// Obtener todos los equipos con sus proyectos
$equipos = $conexion->query("
  SELECT e.id, e.nombre_equipo, p.nombre AS proyecto
  FROM equipos e
  JOIN proyectos p ON e.id_proyecto = p.id
");

// Obtener miembros por equipo
$equipo_usuarios = [];
$res = $conexion->query("
  SELECT eu.id_equipo, u.nombre
  FROM equipo_usuarios eu
  JOIN usuarios u ON eu.id_usuario = u.id
");

while ($row = $res->fetch_assoc()) {
  $equipo_usuarios[$row['id_equipo']][] = $row['nombre'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Equipos | Planning</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include 'header.php'; ?>

  <main class="contenido">
    <h2>Equipos de trabajo</h2>

    <?php while ($equipo = $equipos->fetch_assoc()): ?>
      <div class="tarjeta">
        <h3><?php echo htmlspecialchars($equipo['nombre_equipo']); ?></h3>
        <p><strong>Proyecto:</strong> <?php echo htmlspecialchars($equipo['proyecto']); ?></p>
        <p><strong>Miembros:</strong>
          <?php
          $miembros = $equipo_usuarios[$equipo['id']] ?? [];
          echo implode(", ", $miembros);
          ?>
        </p>
      </div>
    <?php endwhile; ?>

    <h2>Crear nuevo equipo</h2>
    <form action="crear_equipo.php" method="POST" class="formulario">
      <input type="text" name="nombre_equipo" placeholder="Nombre del equipo" required>

      <label for="proyecto">Proyecto:</label>
      <select name="id_proyecto" required>
        <?php
        $proyectos = $conexion->query("SELECT * FROM proyectos");
        while ($p = $proyectos->fetch_assoc()):
        ?>
          <option value="<?php echo $p['id']; ?>"><?php echo htmlspecialchars($p['nombre']); ?></option>
        <?php endwhile; ?>
      </select>

      <label>Selecciona los miembros:</label>
      <?php
      $usuarios->data_seek(0); // Reiniciar el puntero
      while ($u = $usuarios->fetch_assoc()):
      ?>
        <div>
          <input type="checkbox" name="usuarios[]" value="<?php echo $u['id']; ?>">
          <?php echo htmlspecialchars($u['nombre']); ?>
        </div>
      <?php endwhile; ?>

      <button type="submit">Crear equipo</button>
    </form>
  </main>
</body>
</html>
