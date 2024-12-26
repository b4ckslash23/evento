<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', 'm1gu3lp2e', 'evento');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar credenciales de administrador
$sql = "SELECT * FROM admins WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['admin'] = $email;
        header("Location: escaneo.php");
    } else {
        echo "<div class='container mt-5'><h2>Contraseña incorrecta</h2></div>";
    }
} else {
    echo "<div class='container mt-5'><h2>El correo no está registrado como administrador</h2></div>";
}

$conn->close();
?>