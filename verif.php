<?php
$codigoQR = $_POST['codigo_qr'];

// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', 'm1gu3lp2e', 'evento');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar código QR y su estado
$sql = "SELECT * FROM asistentes WHERE codigo_qr='$codigoQR' AND status=1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Cambiar el estado a 0 (deshabilitado)
    $updateSql = "UPDATE asistentes SET status=0 WHERE codigo_qr='$codigoQR'";
    if ($conn->query($updateSql) === TRUE) {
        echo "<div class='container mt-5'><h2>Acceso permitido</h2></div>";
    } else {
        echo "<div class='container mt-5'><h2>Error al actualizar el estado del código QR</h2></div>";
    }
} else {
    echo "<div class='container mt-5'><h2>Código QR no válido o deshabilitado</h2></div>";
}

$conn->close();
?>