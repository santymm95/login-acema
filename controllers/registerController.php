<?php
session_start();
require_once('../includes/db.php'); // Aquí debe estar la variable $pdo definida

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $email      = trim($_POST['email']);
    $password   = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role_id    = $_POST['role_id'];

    try {
        // Validar si el correo ya existe
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->fetch()) {
            $_SESSION['error'] = "El correo electrónico ya está registrado.";
            header('Location: ../views/create_user.php');
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

        $_SESSION['success'] = "Registro exitoso.";
        header('Location: ../views/create_user.php');
        exit;

    } catch (PDOException $e) {
        $_SESSION['error'] = "Error en el registro: " . $e->getMessage();
        header('Location: ../views/create_user.php');
        exit;
    }
}
?>
