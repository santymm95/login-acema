<?php
$conn = new mysqli("localhost", "root", "", "acema_db");
$conn->set_charset("utf8mb4");

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $sql = "SELECT users.id, users.first_name, users.last_name, users.email, roles.id AS role_id
            FROM users
            JOIN roles ON users.role_id = roles.id
            WHERE users.id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
} else {
    header("Location: usuarios.php");
    exit();
}

$rolesResult = $conn->query("SELECT id, name FROM roles");
$roles = [];
while ($role = $rolesResult->fetch_assoc()) {
    $roles[] = $role;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Usuario</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f0f0f0;
      color: #333;
      display: flex;
      flex-direction: column;
      padding: 20px;
    }

    .form-container {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      width: 300px;
      margin: 0 auto;
    }

    input, select {
      width: 100%;
      padding: 8px;
      margin: 10px 0;
      font-size: 16px;
      border-radius: 5px;
    }

    button {
      background-color: #007bff;
      color: white;
      padding: 10px;
      border-radius: 5px;
      border: none;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

<h1>Editar Usuario</h1>

<form action="../controllers/update_user.php" method="POST" class="form-container">
  <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

  <label for="first_name">Nombre</label>
  <input type="text" name="first_name" id="first_name" value="<?php echo $user['first_name']; ?>" required>

  <label for="last_name">Apellido</label>
  <input type="text" name="last_name" id="last_name" value="<?php echo $user['last_name']; ?>" required>

  <label for="email">Correo Electrónico</label>
  <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" required>

  <label for="role">Rol</label>
  <select name="role" id="role" required>
    <?php foreach ($roles as $role): ?>
      <option value="<?php echo $role['id']; ?>" <?php echo $role['id'] == $user['role_id'] ? 'selected' : ''; ?>>
        <?php echo $role['name']; ?>
      </option>
    <?php endforeach; ?>
  </select>

  <button type="submit" name="update_user">Actualizar Usuario</button>
</form>

</body>
</html>
