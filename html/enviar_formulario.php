<?php
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$mensaje = $_POST['mensaje'];

$destinatario = "bictortizon@gmail.com"; // Reemplaza con tu correo electrónico
$asunto = "Formulario de contacto";

// Configuración para conexión SMTP con TLS
$smtpServer = 'ssl://smtp.gmail.com';
$port = 465;
$username = 'bictortizon@gmail.com';
$password = 'hawl donk vief pzcq';

$context = stream_context_create([
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ],
]);

$socket = fsockopen($smtpServer, $port, $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $context); // Corregido el número de parámetros
if (!$socket) {
    echo "$errstr ($errno)<br />\n";
} else {
    // Conexión exitosa
    stream_set_timeout($socket, 30);

    // Autenticación con el servidor SMTP
    fwrite($socket, "EHLO example.com\r\n");
    fread($socket, 1024);
    fwrite($socket, "AUTH LOGIN\r\n");
    fread($socket, 1024);
    fwrite($socket, base64_encode($username) . "\r\n");
    fread($socket, 1024);
    fwrite($socket, base64_encode($password) . "\r\n");
    fread($socket, 1024);

    // Envío del correo
    fwrite($socket, "MAIL FROM: <$email>\r\n");
    fread($socket, 1024);
    fwrite($socket, "RCPT TO: <$destinatario>\r\n");
    fread($socket, 1024);
    fwrite($socket, "DATA\r\n");
    fread($socket, 1024);

    $message = "From: $nombre <$email>\r\n";
    $message .= "Subject: $asunto\r\n";
    $message .= "\r\n";
    $message .= "$mensaje\r\n";

    fwrite($socket, $message);

    fwrite($socket, ".\r\n");

    // Cierre de la conexión
    fwrite($socket, "QUIT\r\n");

    fclose($socket);

    echo "Gracias por enviar tu mensaje. Te responderemos lo más pronto posible.";
}
?>
