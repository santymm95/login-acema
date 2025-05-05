<?php
session_start();

// Verifica si hay sesión activa
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$nombre = $_SESSION['user']['first_name'];
$apellido = $_SESSION['user']['last_name'];

// Redirige al dashboard después de 3 segundos
header("Refresh: 3; URL=dashboard.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido - ACEMA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        p {
            color: #7f8c8d;
            margin-bottom: 30px;
        }

        .loader {
            border: 10px solid #f3f3f3;
            border-top: 10px solid #3498db;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1.5s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <h2>Bienvenido, <?php echo htmlspecialchars($nombre . ' ' . $apellido); ?></h2>
    <p>Redirigiendo a tu panel de principal...</p>
    <div class="loader"></div>
</body>
</html>
