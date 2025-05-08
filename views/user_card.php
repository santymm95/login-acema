<?php
// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "acema_db");
$conn->set_charset("utf8mb4");

$usuarios = $conn->query("SELECT users.id, CONCAT(users.first_name, ' ', users.last_name) AS nombre_completo, email, roles.name AS rol 
FROM users 
JOIN roles ON users.role_id = roles.id");

$usuarios_data = [];
while ($row = $usuarios->fetch_assoc()) {
    $usuarios_data[] = $row;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Usuarios</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f0f0f0;
      color: #333;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .card {
      width: 300px;
      padding: 20px;
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      cursor: pointer;
      margin: 20px auto;
      text-align: center;
    }

    select {
      width: 100%;
      padding: 8px;
      font-size: 16px;
      border-radius: 5px;
      margin: 10px 0;
    }

    .info {
      background: #ffffff;
      padding: 10px;
      border-radius: 10px;
      margin-top: 10px;
      box-shadow: 0 0 5px rgba(0,0,0,0.1);
      display: none;
    }

    .action-btn {
      background-color: #007bff;
      color: white;
      padding: 10px;
      border-radius: 5px;
      border: none;
      cursor: pointer;
      margin: 5px;
    }
  </style>
</head>
<body>

<div class="card">
  <h2>Total de Usuarios</h2>
  <p style="font-size: 2em; font-weight: bold;"><?php echo count($usuarios_data); ?></p>
</div>

<div>
  <select id="user-dropdown" onchange="showInfo(this)">
    <option value="">-- Selecciona un usuario --</option>
    <?php foreach ($usuarios_data as $usuario): ?>
      <option value='<?php echo $usuario['id']; ?>'><?php echo $usuario['nombre_completo']; ?></option>
    <?php endforeach; ?>
  </select>
</div>

<div id="user-info" class="info">
  <p><strong>Nombre:</strong> <span id="name"></span></p>
  <p><strong>Email:</strong> <span id="email"></span></p>
  <p><strong>Rol:</strong> <span id="role"></span></p>
  <button class="action-btn" onclick="editUser()">Editar Usuario</button>
  <button class="action-btn" onclick="deleteUser()">Eliminar Usuario</button>
</div>

<script>
  // Función que maneja la selección del usuario
  function showInfo(select) {
    const userId = select.value;
    const infoDiv = document.getElementById("user-info");

    // Verificar que se haya seleccionado un usuario
    if (userId) {
      // Simulamos la respuesta del servidor con un objeto de usuario
      const selectedUser = <?php echo json_encode($usuarios_data); ?>.find(user => user.id == userId);

      if (selectedUser) {
        document.getElementById("name").innerText = selectedUser.nombre_completo;
        document.getElementById("email").innerText = selectedUser.email;
        document.getElementById("role").innerText = selectedUser.rol;

        // Mostrar la información del usuario
        infoDiv.style.display = "block";
      }
    } else {
      infoDiv.style.display = "none"; // Ocultar la info si no se selecciona un usuario
    }
  }

  // Función de editar usuario
  function editUser() {
    const userSelect = document.getElementById("user-dropdown");
    const userId = userSelect.value;
    
    if (userId) {
        window.location.href = `edit_user.php?id=${userId}`;
    } else {
        alert("Por favor, selecciona un usuario para editar.");
    }
  }

  // Función de eliminar usuario
  function deleteUser() {
    const userSelect = document.getElementById("user-dropdown");
    const userId = userSelect.value;

    if (userId) {
        alert("Eliminando usuario con ID: " + userId);
    } else {
        alert("Por favor, selecciona un usuario para eliminar.");
    }
  }
</script>

</body>
</html>
