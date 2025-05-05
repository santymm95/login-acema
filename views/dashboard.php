<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: index.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Panel de Control</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>

<body>

  <?php include 'layout.php'; ?>

  <div class="main-content">
    <div class="card">
      <h1>Bienvenido, <?php echo $_SESSION['user']['first_name']; ?></h1>
      <p><strong>Dashboard principal.</strong> Explora el menú lateral para realizar acciones o crea tarjetas con accesos directos.</p>
    </div>

    <div class="shortcuts-container">
      <div class="shortcut-card" data-link="horas.php">
        <i class="fas fa-clock"></i>
        <span>Horas</span>
      </div>
      <div class="shortcut-card" data-link="proyectos.php">
        <i class="fas fa-project-diagram"></i>
        <span>Proyectos</span>
      </div>
      <div class="shortcut-card" data-link="solicitudes.php">
        <i class="fas fa-user-check"></i>
        <span>Solicitudes</span>
      </div>
      <div class="shortcut-card" data-link="reportes.php">
        <i class="fas fa-chart-line"></i>
        <span>Reportes</span>
      </div>
      <div class="shortcut-card" data-link="admin.php">
        <i class="fas fa-users-cog"></i>
        <span>Admin</span>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
  <script>
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