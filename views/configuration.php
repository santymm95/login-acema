<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user'])) {
    header('Location: login.php'); // Redirigir al login si no está autenticado
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Configuración</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css"> <!-- Asegúrate de que la ruta sea correcta -->
</head>

<body>
  <?php include 'layout.php'; ?> <!-- Incluir el layout.php -->

  <div class="main-content">
    <!-- Card de bienvenida -->
    <div class="card">
      <h1>Bienvenido, <?php echo $_SESSION['user']['first_name']; ?></h1>
      <p><strong>Panel de Configuración.</strong> Explora el menú lateral para realizar acciones o configura las opciones administrativas.</p>
    </div>

    <!-- Contenedor de accesos directos -->
    <div class="shortcuts-container">
      <div class="shortcut-card" data-link="create_user.php">
        <i class="fas fa-user-plus"></i>
        <span>Gestionar Usuarios</span>
      </div>
       
    </div>
  </div>

  <!-- Script para hacer las tarjetas interactivas y reordenables -->
  <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
  <script>
    document.querySelectorAll('.shortcut-card').forEach(card => {
      card.addEventListener('click', () => {
        const link = card.getAttribute('data-link');
        if (link) {
          window.location.href = link;
        }
      });
    });

    window.addEventListener('load', () => {
      setTimeout(() => {
        document.getElementById('asistente-boton').classList.add('mostrar');
      }, 2000);
    });

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

    new Sortable(document.querySelector('.shortcuts-container'), {
      animation: 150,
      ghostClass: 'dragging-card'
    });
  </script>

</body>

</html>
