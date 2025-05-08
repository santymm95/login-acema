<?php
if (isset($_POST['update_user'])) {
    // Obtener datos del formulario
    $userId = $_POST['id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "acema_db");
    $conn->set_charset("utf8mb4");

    // Validar correo duplicado (excluyendo el usuario actual)
    $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
    $checkEmail->bind_param("si", $email, $userId);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if ($result->num_rows > 0) {
        // Correo duplicado
        echo "<p style='color: red;'>El correo electrónico ya está en uso por otro usuario.</p>";
        echo "<a href='../views/edit_user.php?id=$userId'>Volver</a>";
    } else {
        // Actualizar datos del usuario
        $sql = "UPDATE users SET first_name = ?, last_name = ?, email = ?, role_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $firstName, $lastName, $email, $role, $userId);

        if ($stmt->execute()) {
            header("Location: ../views/create_user.php?mensaje=actualizado");
            exit();
        } else {
            echo "<p style='color: red;'>Hubo un error al actualizar el usuario.</p>";
            echo "<a href='../views/edit_user.php?id=$userId'>Volver</a>";
        }

        $stmt->close();
    }

    $conn->close();
} else {
    // Acceso indebido
    header("Location: ../views/usuarios.php");
    exit();
}
?>
