<?php
include 'phpqrcode/qrlib.php'; // Asegúrate de tener la biblioteca phpqrcode

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if ($password !== $confirm_password) {
    die("<div class='container mt-5'><h2>Las contraseñas no coinciden</h2></div>");
}

// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', 'm1gu3lp2e', 'evento');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el correo ya está registrado
$sql = "SELECT * FROM asistentes WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='container mt-5'><h2>El correo ya está registrado</h2></div>";
} else {
    // Generar un código QR único
    do {
        $codigoQR = 'QR_' . uniqid();
        $sql = "SELECT * FROM asistentes WHERE codigo_qr='$codigoQR'";
        $result = $conn->query($sql);
    } while ($result->num_rows > 0);

    // Hashear la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Guardar datos en la base de datos con status 0 (deshabilitado)
    $sql = "INSERT INTO asistentes (nombre, apellido, email, telefono, password, codigo_qr, status) VALUES ('$nombre', '$apellido', '$email', '$telefono', '$hashed_password', '$codigoQR', 0)";
    if ($conn->query($sql) === TRUE) {
        // Generar el código QR
        $qrFilePath = 'qrcodes/' . $codigoQR . '.png';
        QRcode::png($codigoQR, $qrFilePath);

        echo "<div class='container mt-5'><h2>Registro exitoso</h2>";
        echo "<p>Aquí está tu código QR:</p>";
        echo '<img src="' . $qrFilePath . '" class="img-fluid">';
        echo "</div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>