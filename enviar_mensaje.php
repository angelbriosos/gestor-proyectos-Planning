<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

$de = $_SESSION['usuario'];
$para = $_POST['para'];
$mensaje = $_POST['mensaje'];

echo "<script>alert('Mensaje enviado de $de a $para'); window.location.href = 'call.php';</script>";
a
