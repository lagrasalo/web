<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar correo>/title>
</head>
<style>
    body {
        text-align: center;
    }
</style>

<body>
    <h2>Formulario de contacto</h2>
    <form action="" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre"><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br>
        <label for="mensaje">Mensaje</label>
        <textarea name="mensaje" id="mensaje" cols="30" rows="10"></textarea><br>
        <input type="submit" value="enviar" name="enviar">
    </form>
</body>
</html>

<?php
if (isset($_POST["enviar"])) {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"]; #correo de la persona que escribe el mensaje
    $mensaje = $_POST["mensaje"];

    $destinatario = "victo8078@gmail.com"; #aqui insertar el correo al que deseas que llegue el mensaje que envies en el formulario
    $asunto = "nuevo mensaje de $email";

    $contenido = "Nombre: $nombre \n";
    $contenido .= "Email: $email \n";
    $contenido .= "Mensaje: $mensaje";

    $header = "From: ejemplo@correo.com"; #aqui insertas el correo del remitente en el encabezado del correo.

    $mail = mail($destinatario, $asunto, $contenido, $header);

    if ($mail) {
        echo "<script>alert('El correo se envio correctamente :)')</script>";
    } else {
        echo "<script>alert('El correo no se pudo enviar, intente nuevamente :(')</script>";
    }
}
?>