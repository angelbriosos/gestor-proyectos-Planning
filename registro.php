<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Hashear la contraseña
    $hash = password_hash($contrasena, PASSWORD_DEFAULT);

    // Insertar usuario
    $stmt = $conexion->prepare("INSERT INTO cuentas (usuario, contrasena) VALUES (?, ?)");
    $stmt->bind_param("ss", $usuario, $hash);

    if ($stmt->execute()) {
        echo "<script>alert('Registro exitoso. Puedes iniciar sesión.'); window.location.href='login.html';</script>";
    } else {
        echo "<script>alert('Error al registrar: " . $stmt->error . "'); window.location.href='registro.html';</script>";
    }

    $stmt->close();
    $conexion->close();
}
?>
