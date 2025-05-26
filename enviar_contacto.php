<?php
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$mensaje = $_POST['mensaje'];

$destinatario = "angelbriosos01@gmail.com";
$asunto = "Mensaje de contacto desde Planning";
$cuerpo = "
Nombre: $nombre $apellidos
Teléfono: $telefono
Correo: $email

Mensaje:
$mensaje
";

$headers = "From: $email\r\nReply-To: $email\r\n";

if (mail($destinatario, $asunto, $cuerpo, $headers)) {
    echo "<script>alert('Mensaje enviado correctamente'); window.location.href='contacto.php';</script>";
} else {
    echo "<script>alert('Error al enviar el mensaje'); window.location.href='contacto.php';</script>";
}
