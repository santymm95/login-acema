<?php
if (!isset($_SESSION))
    session_start();
$first_name = $_SESSION['user']['first_name'] ?? '';
$last_name = $_SESSION['user']['last_name'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - ACEMA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/navbar.css">
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
        <div class="nav-item"><a href="proyectos.php"><i class="fas fa-folder-open"></i><span> Proyectos</span></a>
        </div>
        <div class="nav-item"><a href="usuarios.php"><i class="fas fa-users"></i><span> Usuarios</span></a></div>
        <div class="nav-item"><a href="reportes.php"><i class="fas fa-chart-line"></i><span> Reportes</span></a></div>
        <div class="nav-item"><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span> Salir</span></a></div>
    </div>

</body>