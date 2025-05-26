<?php
include 'conexion.php';

$nombre_equipo = $_POST['nombre_equipo'];
$id_proyecto = $_POST['id_proyecto'];
$usuarios = $_POST['usuarios'] ?? [];

// Crear equipo
$stmt = $conexion->prepare("INSERT INTO equipos (nombre_equipo, id_proyecto) VALUES (?, ?)");
$stmt->bind_param("si", $nombre_equipo, $id_proyecto);
$stmt->execute();
$id_equipo = $stmt->insert_id;

// Relacionar usuarios con el equipo
$stmt_usuarios = $conexion->prepare("INSERT INTO equipo_usuarios (id_equipo, id_usuario) VALUES (?, ?)");

foreach ($usuarios as $id_usuario) {
    $stmt_usuarios->bind_param("ii", $id_equipo, $id_usuario);
    $stmt_usuarios->execute();
}

header("Location: equipos.php");
exit();
