<?php
include 'conexion.php';
session_start();

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

$stmt = $conexion->prepare("SELECT contrasena FROM cuentas WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($hash);
    $stmt->fetch();

    if (password_verify($contrasena, $hash)) {
        $_SESSION['usuario'] = $usuario;
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href = 'login.html';</script>";
    }
} else {
    echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href = 'login.html';</script>";
}
?>
