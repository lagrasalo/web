<?php
if(isset($_POST['texto'])) {
    $texto = $_POST['texto'];
    $archivo = 'texto_guardado.txt';
    $contenido = file_get_contents($archivo);
    $contenido .= $texto . "\n";
    file_put_contents($archivo, $contenido);
    echo "Texto guardado correctamente.";
} else {
    echo "No se recibió ningún texto para guardar.";
}
?>
