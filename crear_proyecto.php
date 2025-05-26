<?php
include 'conexion.php';

$nombre = $_POST['nombre'];
$estado = $_POST['estado'];
$progreso = $_POST['progreso'];
$usuarios = $_POST['usuarios'] ?? [];

// Crear proyecto
$stmt = $conexion->prepare("INSERT INTO proyectos (nombre, estado, progreso) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $nombre, $estado, $progreso);
$stmt->execute();
$id_proyecto = $stmt->insert_id;

// Crear equipo automáticamente con los usuarios
if (count($usuarios) > 0) {
    $stmt_eq = $conexion->prepare("INSERT INTO equipos (nombre_equipo, id_proyecto) VALUES (?, ?)");
    $nombre_equipo = $nombre . " - Equipo";
    $stmt_eq->bind_param("si", $nombre_equipo, $id_proyecto);
    $stmt_eq->execute();
    $id_equipo = $stmt_eq->insert_id;

    $stmt_rel = $conexion->prepare("INSERT INTO equipo_usuarios (id_equipo, id_usuario) VALUES (?, ?)");
    foreach ($usuarios as $id_usuario) {
        $stmt_rel->bind_param("ii", $id_equipo, $id_usuario);
        $stmt_rel->execute();
    }
}

header("Location: proyectos.php");
exit();
