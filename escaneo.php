<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Código QR</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 400px;
            margin: auto;
        }
        .top-right {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <a href="index.php" class="btn btn-secondary top-right">Volver a Inicio</a>
        <div class="form-container">
            <h2 class="mb-4 text-center">Verificación de Código QR</h2>
            <form action="verif.php" method="post">
                <div class="form-group">
                    <label for="codigo_qr">Código QR:</label>
                    <input type="text" class="form-control" id="codigo_qr" name="codigo_qr" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Verificar</button>
            </form>
            <form action="logout.php" method="post" class="mt-3">
                <button type="submit" class="btn btn-danger btn-block">Cerrar sesión</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>