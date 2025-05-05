<?php
// Configuración de la base de datos
$host = 'localhost';      // El host de la base de datos (puede ser localhost o una IP)
$dbname = 'acema_db';        // Nombre de la base de datos
$username = 'root';       // Nombre de usuario para acceder a la base de datos (por defecto en XAMPP es 'root')
$password = '';           // Contraseña para acceder a la base de datos (en XAMPP por defecto es vacío)

// Crear una instancia de PDO para la conexión
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Establecer el modo de error de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Codificación de caracteres
    $pdo->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    // Si ocurre un error, muestra un mensaje
    die("Connection failed: " . $e->getMessage());
}
?>
