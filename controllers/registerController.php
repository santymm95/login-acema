<?php
session_start();
require_once('../includes/db.php'); // Asegúrate de que esta ruta es correcta y que `$pdo` está definido allí.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role_id    = $_POST['role_id'];

    try {
        // Verificar si ya existe el email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->fetch()) {
            $_SESSION['error'] = "El correo electrónico ya está registrado.";
            header('Location: ../views/register.php');
            exit;
        }

        // Insertar nuevo usuario
        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password, role_id) 
                               VALUES (:first_name, :last_name, :email, :password, :role_id)");
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role_id', $role_id);
        $stmt->execute();

        $_SESSION['success'] = "Registro exitoso. Puedes iniciar sesión ahora.";
        header('Location: ../index.php');
        exit;

    } catch (PDOException $e) {
        $_SESSION['error'] = "Error en el registro: " . $e->getMessage();
        header('Location: ../views/register.php');
        exit;
    }
}
?>
