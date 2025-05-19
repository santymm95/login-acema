<?php
session_start();
require_once('../includes/db.php'); // Asegúrate que aquí se define $pdo correctamente

// Verificar si hubo algún mensaje de éxito o error
if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
    echo "<script>alert('" . $_SESSION['success'] . "');</script>";
    unset($_SESSION['success']);
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

  <div class="container">

    <?php include 'layout.php'; ?>
    
    <div class="user-card-section">
      <?php include 'user_card.php'; ?>
    </div>
    
    <!-- Botón para agregar un nuevo usuario -->
   
  </div>
    
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
    document.querySelectorAll('.shortcut-card').forEach(card => {
      card.addEventListener('click', () => {
        const link = card.getAttribute('data-link');
        if (link) {
          window.location.href = link;
        }
      });
    });

    window.addEventListener('load', () => {
      // Mostrar el botón del asistente 3 segundos después
      setTimeout(() => {
        document.getElementById('asistente-boton').classList.add('mostrar');
      }, 2000);
    });

    const asistenteBoton = document.getElementById('asistente-boton');
    const asistentePopup = document.getElementById('asistente-popup');
    const cerrarAsistente = document.getElementById('cerrar-asistente');

    // Mostrar popup y ocultar botón
    asistenteBoton.addEventListener('click', () => {
      asistentePopup.classList.add('mostrar');
      asistenteBoton.style.display = 'none';
    });

    // Cerrar popup y mostrar botón otra vez
    cerrarAsistente.addEventListener('click', () => {
      asistentePopup.classList.remove('mostrar');
      asistenteBoton.style.display = 'flex';
    });
    new Sortable(document.querySelector('.shortcuts-container'), {
      animation: 150,
      ghostClass: 'dragging-card'
    });

    document.querySelectorAll('.shortcut-card').forEach(card => {
      card.addEventListener('click', () => {
        const destino = card.getAttribute('data-link');
        if (destino) window.location.href = destino;
      });
    });   
  </script>
</body>
</html>
