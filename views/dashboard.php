<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}
$first_name = $_SESSION['user']['first_name'];
$last_name = $_SESSION['user']['last_name'];
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
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f8;
      color: #333;
    }

    /* Navbar superior */
    .navbar-modern {
      width: 100%;
      height: 60px;
      /* From https://css.glass */
background: rgba(255, 255, 255, 0.65);

box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
backdrop-filter: blur(5px);
-webkit-backdrop-filter: blur(5px);
border: 1px solid rgba(255, 255, 255, 0.3);
      backdrop-filter: blur(6px);
      color:#215ba0;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
      position: fixed;
      top: 0;
      z-index: 1000;
    }

    .navbar-logo img {
      height: 60px;
    }

    .navbar-left {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .user-icon {
      width: 40px;
      height: 40px;
      background-color:#215ba0;
      color: #fff;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      font-size: 18px;
    }

    .user-name {
      font-size: 16px;
      font-weight: 500;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    /* Sidebar */
    .sidebar {
      position: fixed;
      top: 60px;
      left: 0;
      width: 80px;
      height: calc(100vh - 60px);
      background-color:#215ba0;
      display: flex;
      flex-direction: column;
      align-items: center;
      transition: width 0.3s ease;
      overflow: hidden;
    }

    .sidebar:hover {
      width: 220px;
      align-items: flex-start;
    }

    .nav-item {
      width: 100%;
      padding: 15px 20px;
      display: flex;
      align-items: center;
      gap: 15px;
      color:#215ba0;
      transition: background 0.3s;
      cursor: pointer;
      text-decoration: none;
    }

    .nav-item:hover {
      background-color:rgb(159, 159, 159);
    }

    .nav-item i {
      min-width: 20px;
      text-align: center;
      font-size: 18px;
    }

    .nav-item span {
      display: none;
      font-size: 16px;
    }

    .sidebar:hover .nav-item span {
      display: inline;
    }

    .nav-item a {
      color: white;
      text-decoration: none;
    }

    .main-content {
      margin-left: 80px;
      padding: 100px 20px 20px 20px;
      transition: margin-left 0.3s ease;
    }

    .sidebar:hover ~ .main-content {
      margin-left: 220px;
    }

    .card {
      background-color: white;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.05);
      max-width: 600px;
      margin: 0 auto;
    }

    h1 {
      margin-bottom: 20px;
      font-size: 26px;
    }

    /* Responsive */
    @media (max-width: 600px) {
      .navbar-modern {
        flex-direction: column;
        height: auto;
        padding: 10px 20px;
        align-items: flex-start;
        gap: 10px;
      }

      .sidebar {
        width: 100%;
        height: auto;
        flex-direction: row;
        justify-content: space-around;
        padding: 10px 0;
        top: auto;
        bottom: 0;
        position: fixed;
      }

      .sidebar .nav-item {
        flex-direction: column;
        align-items: center;
        padding: 10px;
      }

      .navbar-logo img {
      display: none;
    }

      .sidebar .nav-item span {
        display: block;
        font-size: 12px;
        text-align: center;
      }

      .main-content {
        margin-left: 0;
        padding: 80px 20px 80px 20px;
      }

      .sidebar:hover {
        width: 100%;
      }

      .sidebar:hover ~ .main-content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar-modern">
    <div class="navbar-logo">
      <img src="../assets/images/logo-acema.webp" alt="Logo">
    </div>
    <div class="navbar-left">
      <div class="user-icon"><?php echo strtoupper(substr($first_name, 0, 1)); ?></div>
      <div class="user-name"><?php echo $first_name . ' ' . $last_name; ?></div>
    </div>
  </nav>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="nav-item"><a href="index.php"><i class="fas fa-home"></i><span> Inicio</span></a></div>
    <div class="nav-item"><a href="proyectos.php"><i class="fas fa-folder-open"></i><span> Proyectos</span></a></div>
    <div class="nav-item"><a href="usuarios.php"><i class="fas fa-users"></i><span> Usuarios</span></a></div>
    <div class="nav-item"><a href="reportes.php"><i class="fas fa-chart-line"></i><span> Reportes</span></a></div>
    <div class="nav-item"><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span> Salir</span></a></div>
</div>


  <!-- Contenido -->
  <div class="main-content">
    <div class="card">
      <h1>Bienvenido, <?php echo $first_name; ?> 👋</h1>
      <p>Este es tu panel de control. Explora el menú lateral para navegar por el sistema.</p>
    </div>
  </div>

</body>
</html>
