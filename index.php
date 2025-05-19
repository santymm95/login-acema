<?php
session_start();

// Conexión a la base de datos
$host = 'localhost';
$dbname = 'acema_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Procesar el inicio de sesión
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Por favor, ingresa todos los campos.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'email' => $user['email'],
                'role' => $user['role']
            ];
            header("Location: ./views/loading_dashboard.php");
            exit;
        } else {
            $_SESSION['error'] = "Correo o contraseña incorrectos 🤨";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ACEMA</title>
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Columna izquierda con información -->
        <div class="left-column">
            <div class="mockup-phone">
                <div class="text-overlay">
                    <h2 class="active">Bienvenido <br><strong>ACEMA ERP</strong></h2>
                    <h2>Sistema adaptado a dispositivos móviles.</h2>
                    <h2>Conexión directa, en tiempo real</h2>
                    <h2>Datos relacionales para mayor facilidad de búsqueda.</h2>
                    <h6>Visita nuestra web<br><a href="https://acemaingenieria.com/" target="_blank">acemaingenieria.com</a></h6>
                </div>
            </div>
        </div>

        <!-- Columna derecha con el login -->
        <div class="right-column">
            <div class="login-box">
                <h2>Iniciar sesión</h2>

                <!-- Mostrar mensaje de error si existe -->
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert error">
                        <?php 
                            echo $_SESSION['error']; 
                            unset($_SESSION['error']);
                        ?>
                    </div>
                <?php endif; ?>

                <form action="index.php" method="POST">
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="email" name="email" placeholder="Correo electrónico" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Contraseña" required>
                        <i class="fas fa-eye" id="toggle-password" style="cursor: pointer;"></i>
                    </div>
                    <div class="button-group">
                        <button type="submit">Iniciar sesión</button>
                    </div>
                </form>
                <div class="register-option">
                    <p>¿No tienes cuenta? <a href="./views/register.php">¡Regístrate aquí!</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const texts = document.querySelectorAll('.mockup-phone h2, .mockup-phone h6');
        let currentIndex = 0;

        function cycleTexts() {
            texts[currentIndex].classList.remove('active');
            currentIndex = (currentIndex + 1) % texts.length;
            texts[currentIndex].classList.add('active');
        }

        setInterval(cycleTexts, 4000); // Cambio cada 4 segundos

        // Mostrar/ocultar contraseña
        const togglePassword = document.getElementById('toggle-password');
        const passwordField = document.getElementById('password');

        togglePassword.addEventListener('click', () => {
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;
            togglePassword.classList.toggle('fa-eye');
            togglePassword.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
