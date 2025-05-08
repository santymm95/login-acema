<?php
session_start();
require_once('../includes/db.php'); // Asegúrate que aquí se define $pdo correctamente

try {
    $roles = $pdo->query("SELECT id, name FROM roles");
} catch (PDOException $e) {
    die("Error al obtener los roles: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Usuario - ACEMA</title>
  <link rel="stylesheet" href="../assets/css/create_user.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <?php include 'layout.php'; ?>

  <div class="container">
    <div class="login-box">
      <h2>Registro de Usuario</h2>
      <form action="../controllers/registerController.php" method="POST">
        <div class="input-group">
          <i class="fas fa-user"></i>
          <input type="text" name="first_name" placeholder="Nombre" required>
        </div>
        <div class="input-group">
          <i class="fas fa-user"></i>
          <input type="text" name="last_name" placeholder="Apellido" required>
        </div>
        <div class="input-group">
          <i class="fas fa-envelope"></i>
          <input type="email" name="email" placeholder="Correo electrónico" required>
        </div>
        <div class="input-group">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" placeholder="Contraseña" required>
        </div>
        <div class="input-group">
          <i class="fas fa-user-tag"></i>
          <select name="role_id" required>
            <option value="">Selecciona un rol</option>
            <?php while ($row = $roles->fetch(PDO::FETCH_ASSOC)): ?>
              <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
            <?php endwhile; ?>
          </select>
        </div>
        <div class="button-group">
          <button class="button" type="submit">Registrar</button>
        </div>
      </form>
    </div>

    <div class="user-card-section">
      <?php include 'user_card.php'; ?>
    </div>
  </div>

  <?php
  if (isset($_SESSION['error'])) {
      echo "<script>alert('" . $_SESSION['error'] . "');</script>";
      unset($_SESSION['error']);
  }

  if (isset($_SESSION['success'])) {
      echo "<script>alert('" . $_SESSION['success'] . "');</script>";
      unset($_SESSION['success']);
  }
  ?>
 <script>
  // Función para redirigir a la URL de la tarjeta
  document.querySelectorAll('.shortcut-card').forEach(card => {
    card.addEventListener('click', () => {
      const link = card.getAttribute('data-link');
      if (link) {
        window.location.href = link;
      }
    });
  });

  // Mostrar el botón del asistente 2 segundos después de cargar la página
  window.addEventListener('load', () => {
    setTimeout(() => {
      document.getElementById('asistente-boton').classList.add('mostrar');
    }, 2000);
  });

  // Mostrar y ocultar el popup del asistente
  const asistenteBoton = document.getElementById('asistente-boton');
  const asistentePopup = document.getElementById('asistente-popup');
  const cerrarAsistente = document.getElementById('cerrar-asistente');

  asistenteBoton.addEventListener('click', () => {
    asistentePopup.classList.add('mostrar');
    asistenteBoton.style.display = 'none';
  });

  cerrarAsistente.addEventListener('click', () => {
    asistentePopup.classList.remove('mostrar');
    asistenteBoton.style.display = 'flex';
  });

  // Hacer que las tarjetas sean arrastrables
  new Sortable(document.querySelector('.shortcuts-container'), {
    animation: 150,
    ghostClass: 'dragging-card'
  });

  // Cambiar entre modo oscuro y claro
  const themeToggleButton = document.getElementById('theme-toggle');
  const themeIcon = document.getElementById('theme-icon');

  // Comprobar el tema guardado en localStorage
  const savedTheme = localStorage.getItem('theme');
  if (savedTheme === 'dark') {
    document.body.classList.add('dark-mode');
    themeIcon.textContent = '☀️'; // Sol
  } else {
    document.body.classList.remove('dark-mode');
    themeIcon.textContent = '🌙'; // Luna
  }

  // Cambiar el tema al hacer clic en el botón
  themeToggleButton.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');

    // Actualizar el ícono y guardar la preferencia
    if (document.body.classList.contains('dark-mode')) {
      themeIcon.textContent = '☀️'; // Sol
      localStorage.setItem('theme', 'dark');
    } else {
      themeIcon.textContent = '🌙'; // Luna
      localStorage.setItem('theme', 'light');
    }
  });
</script>

</body>
</html>
