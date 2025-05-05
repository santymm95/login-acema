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
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="estilos.css"> <!-- Tu CSS separado si lo deseas -->
</head>
<body>

  <?php include 'layout.php'; ?>

  <div class="main-content">
    <div class="card">
      <h1>Bienvenido, <?php echo $_SESSION['user']['first_name']; ?> 👋</h1>
      <p>Este es tu panel de control. Explora el menú lateral para navegar por el sistema.</p>
    </div>
  </div>

</body>
</html>
