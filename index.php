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
                    <h2>Datos relacionales para mayor facilidad de busqueda.</h2>
                    <h6>Visita nuestra web<br><a href="https://acemaingenieria.com/"
                            target="_blank">acemaingenieria.com</a></h6>
                </div>
            </div>
        </div>

        <!-- Columna derecha con el login -->
        <div class="right-column">
            <div class="login-box">
                <h2>Iniciar sesión</h2>
                <form action="login.php" method="POST">
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
                    <p>¿No tienes cuenta? <a href="#">¡Regístrate aquí!</a></p>
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

        setInterval(cycleTexts, 5000); // Cambio cada 5 segundos

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