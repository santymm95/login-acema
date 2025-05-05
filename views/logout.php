<?php
session_start(); // Iniciar la sesión

// Eliminar todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redirigir después de 2 segundos
header("Refresh: 2; URL=/acema/index.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>    
    <meta charset="UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - ACEMA</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            margin: 0;
        }
        .logout-message {
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .logout-message h2 {
            color: #333;
        }
        .logout-message p {
            color: #666;
        }
        .loader {
            margin: 20px auto;
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <div class="logout-message">
        <h2>Has cerrado sesión con éxito</h2>
        <p>Redirigiendo a la página de inicio...</p>
        <div class="loader"></div>
    </div>
</body>
</html>
