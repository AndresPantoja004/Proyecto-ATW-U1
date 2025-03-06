<?php
    session_start(); // Iniciar sesión

    // Leer usuarios desde usuarios.json
    $usuarios_json = file_get_contents("json/usuarios.json");
    $usuarios = json_decode($usuarios_json, true);

    // Verificar si el usuario ya ha iniciado sesión
    if (isset($_SESSION['usuario'])) {
        header("Location: index.php"); // Redirige al index si ya está logueado
        exit();
    }

    // Procesar formulario de inicio de sesión
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $usuario = $_POST["usuario"];  // Corregido para coincidir con el formulario
        $password = $_POST["password"];
        
        $usuario_encontrado = false;

        // Buscar el usuario en el array
        foreach ($usuarios as $user) {
            if ($user['usuario'] === $usuario) {
                echo "Usuario encontrado";
                // Comparar la contraseña con la almacenada
                if (password_verify($password, $user["password"])) {
                    $_SESSION['usuario'] = $usuario; // Guarda el usuario en la sesión
                    header("Location: index.php"); // Redirige al índice
                    exit();
                } else {
                    $error = "Contraseña incorrecta";
                }
                $usuario_encontrado = true;
                break;
            }
        }

        if (!$usuario_encontrado) {
            $error = "Usuario no encontrado";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EspeStore - Crear Cuenta</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script defer src="js/bootstrap.bundle.min.js"></script>
    <script src="js/JQueryV3.7.1.js"></script>
    <script src="gdsmith-jquery.easing-82496a9/jquery.easing.1.3.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            font-size: 14px;
        }

        button {
            border-radius: 4px;
        }

        button:hover {
            border: 1px solid #ccc;
        }

        body {
            font-size: 14px;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            margin-top: 50px;
        }

        .step {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 8px;
            transition: background 0.3s ease;
        }

        .step:hover {
            background: #f1f1f1;
        }

        .step i {
            font-size: 20px;
            color: #007bff;
            margin-right: 10px;
        }

        .validate-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .validate-button:hover {
            background-color: #0056b3;
        }

        /* Ajustes para navbar */
        .navbar {
            background-color: black;
        }

        .navbar-brand {
            font-size: 30px;
            font-weight: 700;
        }

        .navbar .navbar-brand {
            color: white;
        }

        .navbar .navbar-nav .nav-link {
            color: white;
        }

        .navbar .navbar-nav .nav-link:hover {
            color: #f8f9fa;
        }

        .navbar .navbar-toggler-icon {
            background-color: white;
        }

        .CrearCuenta {
            border: solid 1px #499cde;
            background-color: #3192e1;
            color: white;
            width: 98%;
            height: 40px;
            text-align: center;
        }

        .CrearCuenta:hover {
            background-color: #0f87e9;
            border: solid 1px #388bcf;
            color: white;
        }

        .caja1 {
            border: solid 1px #a3abb1;
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2);
            padding: 10px;
        }

        .caja {
            border: solid 1px #388bcf;

        }

        .errores {
            margin-top: 5px;
            background-color: rgb(250, 241, 188);
            border-radius: solid 5px;
            height: 25px;
            display: none;
        }
    </style>
    <script>
        $(document).ready(function () {
            $("#crearcuenta").click(function () {
                var correo = $("#email").val();
                var contraseña = $("#password").val();
                let formatoNombre = /^[A-Za-z]{3,20} [A-Za-z]{3,20} [A-Za-z]{3,20} [A-Za-z]{3,20}/

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo)) {
        $("#mensaje1").fadeIn();
        event.preventDefault();
        return false;
    } else {
        $("#mensaje1").fadeOut();
    }

    if (contraseña === "") {
        $("#mensaje4").fadeIn();
        event.preventDefault();
        return false;
    } else {
        $("#mensaje4").fadeOut();
    }
                window.location.href = 'detalleCompra.html';
            });
        }); 
    </script>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <img src="img/logoEspe2.png" width="50" height="40" alt="blue">
            <a class="navbar-brand" href="index.php" style="color: #27e03d;">EspeStore</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ofertas</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Temporadas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Temporada 24-25</a></li>
                            <li><a class="dropdown-item" href="#">Temporada 23-24</a></li>
                            <li><a class="dropdown-item" href="#">Temporada 22-23</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="container-car d-flex gap-3 justify-content-between p-2 m-2">
                    <div>
                        <svg width="24px" height="24px" stroke-width="1.5" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" color="#ffffff">
                            <path
                                d="M19.5 22C20.3284 22 21 21.3284 21 20.5C21 19.6716 20.3284 19 19.5 19C18.6716 19 18 19.6716 18 20.5C18 21.3284 18.6716 22 19.5 22Z"
                                fill="#ffffff" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path
                                d="M9.5 22C10.3284 22 11 21.3284 11 20.5C11 19.6716 10.3284 19 9.5 19C8.67157 19 8 19.6716 8 20.5C8 21.3284 8.67157 22 9.5 22Z"
                                fill="#ffffff" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M5 4H22L20 15H7L5 4ZM5 4C4.83333 3.33333 4 2 2 2" stroke="#ffffff"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path
                                d="M20 15H7H5.23077C3.44646 15 2.5 15.7812 2.5 17C2.5 18.2188 3.44646 19 5.23077 19H19.5"
                                stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            </path>
                        </svg>
                    </div>
                    <div>
                        $ <span id="totalAcumulado"> 55555</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Formulario de inicio de sesión o bienvenida -->
    <div class="container caja1">
        <?php if (isset($_SESSION['usuario'])): ?>
            <h3>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?>!</h3>
            <a href="cerrarSesion.php" class="btn btn-danger">Cerrar Sesión</a>
        <?php else: ?>
            <h3>Completa los datos para iniciar sesión</h3>
            <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
            <form id="loginForm" method="post">
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" class="caja form-control" name="usuario" id="usuario" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="caja form-control" name="password" id="password" required>
                </div>
                <input type="submit" class="btn btn-success" value="Iniciar Sesión">
            </form>
            <a href="registrarse.php" class="btn btn-primary">Crear cuenta</a>
        <?php endif; ?>
    </div>
    <!-- Footer -->
    <footer
        class="row footer bg-black text-white d-flex align-items-center justify-content-center row p-3 text-center mt-5 row">
        <div class="information-footer d-flex flex-column gap-3 col-6 text-center d-flex align-items-center justify-content-center p-3">
            <div class="row">
                <h3 class="m-0 ">EspeFlex</h3>
            </div>
            <svg width="44px" height="44px" viewBox="0 0 24 24" stroke-width="1.5" fill="none"
                xmlns="http://www.w3.org/2000/svg" color="#000000">
                <path
                    d="M6 4H9C9 4 9 7 12 7C15 7 15 4 15 4H18M18 11V19.4C18 19.7314 17.7314 20 17.4 20H6.6C6.26863 20 6 19.7314 6 19.4L6 11"
                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path
                    d="M18 4L22.4429 5.77717C22.7506 5.90023 22.9002 6.24942 22.7772 6.55709L21.1509 10.6228C21.0597 10.8506 20.8391 11 20.5938 11H18"
                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path
                    d="M5.99993 4L1.55701 5.77717C1.24934 5.90023 1.09969 6.24942 1.22276 6.55709L2.84906 10.6228C2.94018 10.8506 3.1608 11 3.40615 11H5.99993"
                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <div class="row">
                <span>Preguntas Frecuentes</span>
            </div>
            <div class="row">
                <div class="col gap-3 d-flex">
                    <span>Terms and Conditions (T&C)</span>
                    <span>Privacy policy</span>
                </div>
            </div>
            <div class="d-flex d-md-none contact-sm">
                <span id="btnContact">Contactanos</span>
            </div>
            <div class="row payment-permit">
                <img src="img/payment-methods-2.png" alt="">
            </div>
        </div>
    </footer>
    <script>
        $("#mensajeValidacion").hide();
        document.getElementById('signupForm').addEventListener('submit', function (e) {
            e.preventDefault();
            // Obtener los valores del formulario
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            // Guardar los datos en localStorage
            localStorage.setItem('email', email);
            localStorage.setItem('password', password);
            // Redirigir a la página de verificación de datos
            window.location.href = 'registrarse.php';
            $(function () { // Cerrar el modal al hacer clic en el botón 
                $("#closeModal").on("click", function () {
                    $("#notFoundModal").fadeOut();
                });
                $("#closeModal2").on("click", function () {
                    $("#notFoundModal2").fadeOut();
                });
                $(".modal-overlay").on("click", function (e) {
                    if (e.target === this) {
                        $(this).fadeOut();
                    }
                });
                $("#btnContact").click(function () {
                    $("#notFoundModal2").fadeIn();
                });
            })
        });  
    </script>
</body>

</html>