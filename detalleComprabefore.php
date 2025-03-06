<?php
// Iniciar la sesión
session_start();
// Leer el contenido del archivo JSON
$json = file_get_contents("json/camisetas.json");
// Convertir el JSON en un array de PHP
$camisetas = json_decode($json, true);

// Obtener el ID de la camiseta
$id = isset($_GET["id"]) ? $_GET["id"] : null;
// Buscar la camiseta con el ID especificado
$camiseta = null;

if ($id !== null) {
    foreach ($camisetas as $c) {
        if ($c["id"] == $id) {
            $camiseta = $c;
            break;
        }
    }
}


// Verificar si el usuario está logueado
$usuarioLogueado = isset($_SESSION['usuario']);  // Esto verifica si la variable de sesión 'usuario' existe
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EspeStore</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script defer src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            font-size: 14px;
        }

        .contenedor {
            height: auto;
            padding: 10px;
        }

        .columna,
        .columnacarrito {
            background-color: white;
            border: 1px solid rgb(102, 145, 173);
            border-radius: 4px;
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2);
            padding: 10px;
        }

        .principal {
            height: auto;
            padding: 30px;
        }

        .barra {
            background-color: #dfe1e2;
            padding: 10px;
        }

        .carrito {
            overflow-x: auto;
        }

        .cupon {
            margin-top: 15px;
        }

        .hacerPago,
        .Aplicar {
            width: 100%;
            height: 40px;
            border-radius: 5px;
            color: white;
        }

        .hacerPago {
            background-color: #499cde;
            border: solid 1px #499cde;
        }

        .hacerPago:hover {
            background-color: #2e92e4;
            border: solid 1px #388bcf;
        }

        .Aplicar {
            background-color: black;
            border: solid 1px black;
        }

        .codigo {
            width: 100%;
            height: 40px;
            text-align: center;
            border-radius: 5px;
            border: solid 2px rgb(161, 160, 160);

        }

        @media (max-width: 768px) {
            .row {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .carrito {
                overflow-x: auto;
                display: block;
                white-space: nowrap;
            }

            .columna img {
                width: 80px;
                height: auto;
            }

            .columnacarrito {
                margin-top: 10px;
            }
        }

        #error-message {
            display: none;
            background-color: rgb(255, 255, 175);
            color: black;
            padding: 10px;
            text-align: center;
            margin-top: 10px;
            border-radius: 5px;
            font-weight: bold;
        }

        .agrandada:hover {
            transform: scale(1.2);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <img src="img/logoEspe2.png" width="50" height="40" alt="logo">
            <a class="navbar-brand" href="index.php" style="color: #27e03d;">EspeStore</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link active" style="color: white;" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" style="color: white;" href="#">Ofertas</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: white;" href="#" role="button"
                            data-bs-toggle="dropdown">Temporadas</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Temporada 24-25</a></li>
                            <li><a class="dropdown-item" href="#">Temporada 23-24</a></li>
                            <li><a class="dropdown-item" href="#">Temporada 22-23</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="container-car d-flex gap-3 justify-content-between p-2 m-2">
                    <div>
                        <svg width="24px" height="24px" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#ffffff">
                            <path d="M19.5 22C20.3284 22 21 21.3284 21 20.5C21 19.6716 20.3284 19 19.5 19C18.6716 19 18 19.6716 18 20.5C18 21.3284 18.6716 22 19.5 22Z" fill="#ffffff" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M9.5 22C10.3284 22 11 21.3284 11 20.5C11 19.6716 10.3284 19 9.5 19C8.67157 19 8 19.6716 8 20.5C8 21.3284 8.67157 22 9.5 22Z" fill="#ffffff" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M5 4H22L20 15H7L5 4ZM5 4C4.83333 3.33333 4 2 2 2" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M20 15H7H5.23077C3.44646 15 2.5 15.7812 2.5 17C2.5 18.2188 3.44646 19 5.23077 19H19.5" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </div>
                    <div>
                        $ <span id="totalAcumulado"> 55555</span>
                    </div>
                </div>
                <?php if ($usuarioLogueado): ?>
                    <div id="perfilUsuario" class="usuario">
                        <p id="inicialUsuario"><?= strtoupper($_SESSION['usuario'][0]); ?></p> <!-- Primera letra del usuario -->
                    </div>
                    <a href="cerrarSesion.php" class="btn btn-outline-danger m-2">Cerrar Sesión</a>
                <?php else: ?>
                    <a href="/inicioSesion.php" id="btnInit" class="btn btn-outline-success m-2">Iniciar Sesión</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <div class="row barra text-center p-2">
            <p class="fw-bold">
                <?= $camiseta ? htmlspecialchars($camiseta['nombre']) : "Producto no encontrado"; ?>
            </p>
            <a href="index.php" class="btn btn-outline-success">Continuar comprando</a>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="row columna p-3">
                    <div class="col-3 text-center">
                        <img src="<?= isset($camiseta['imagen']) ? $camiseta['imagen'] : 'ruta/por_defecto.jpg'; ?>" alt="camisa" class="img-fluid agrandada" id="camisa">
                    </div>
                    <div class=" col-3">
                        <p><strong>Producto</strong></p>
                        <p class="fw-bold">
                            <?= $camiseta ? htmlspecialchars($camiseta['nombre']) : "No disponible"; ?>
                        </p>
                    </div>
                    <div class="col-2">
                        <p><strong>Precio</strong></p>
                        <p class="text-success fs-4 fw-bold">
                            <?= $camiseta ? "$" . number_format($camiseta['precio'], 2) : "No disponible"; ?>
                        </p>
                    </div>
                    <div class="col-2">
                        <p><strong>Cantidad</strong></p>
                        <input type="number" min="1" max="20" value="1" class="form-control">
                    </div>
                    <div class="col-2">
                        <p><strong>Subtotal</strong></p>
                        <p id="subtotalP"><?= "$" . number_format($camiseta['precio'], 2); ?></p>
                    </div>


                </div>

                <!-- Cupon -->
                <div class="row columna cupon d-flex align-items-center justify-content-between flex-wrap">
                    <div class="col-12 col-md-3 d-flex align-items-center justify-content-center justify-content-md-end mt-2 mt-md-0">
                        <input type="text" class="codigo w-100 w-md-auto" name="cupon" value="" style="max-width: 200px; color:black;" placeholder="Código de cupón formato: AA999">
                    </div>
                    <div class="col-12 col-md-3 d-flex align-items-center justify-content-center justify-content-md-end mt-2 mt-md-0">
                        <button type="button" class="Aplicar w-100 w-md-auto" name="Aplicar" onclick="aplicarCupon()">Aplicar el cupón</button>
                    </div>
                </div>

                <!-- Mensaje del cupón -->
                <div id="error-message" style="display: none"></div>
            </div>

            <div class="col-lg-4">
                <div class="columnacarrito p-3">
                    <h3 class="text-center">Totales del carrito</h3>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Subtotal</span>
                        <span>$<?= number_format($camiseta['precio'], 2)?></span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Envío</span>
                        <span>Gratis</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Destino</span>
                        <span>Santo Domingo</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Iva</span>
                        <span id="subtotal">15%</span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Descuento</span>
                        <span id="descuento"></span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>Total</span>
                        <span id="total"><strong></strong></span>
                    </div>
                    <a href="registrarse.php" class="hacerPago btn btn-outline color:black" id="proceder">Proceder al pago</a>
                </div>
            </div>
        </div>
    </div>


    <footer class="row footer bg-black text-white d-flex align-items-center justify-content-center row p-3 text-center mt-5 row">
        <div class="information-footer  d-flex flex-column gap-3 col-6  text-center d-flex align-items-center justify-content-center p-3">
            <div class="row">
                <h3 class="m-0 ">EspeFlex</h3>
            </div>
            <svg width="44px" height="44px" viewBox="0 0 24 24" stroke-width="1.5" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000">
                <path d="M6 4H9C9 4 9 7 12 7C15 7 15 4 15 4H18M18 11V19.4C18 19.7314 17.7314 20 17.4 20H6.6C6.26863 20 6 19.7314 6 19.4L6 11" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M18 4L22.4429 5.77717C22.7506 5.90023 22.9002 6.24942 22.7772 6.55709L21.1509 10.6228C21.0597 10.8506 20.8391 11 20.5938 11H18" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M5.99993 4L1.55701 5.77717C1.24934 5.90023 1.09969 6.24942 1.22276 6.55709L2.84906 10.6228C2.94018 10.8506 3.1608 11 3.40615 11H5.99993" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
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
        <div class="cotact-container col  d-none d-md-flex flex-column gap-3 col-6 text-center  align-items-center justify-content-center p-3">
            <h3 class="m-0">Contactanos</h3>
            <div class="container-contactactanos row">
                <a>Contactos principales</a>
                <span>Av.Metropolitana Eloy Alfaro Km 1.5</span>
                <span>Portoviejo, Manabí 1301050</span>
                <span>Santo Domingo</span>
                <span>Telefonos: +593 52-933777</span>
                <span>andrespantoja@gmail.com </span>
                <div class="container-contactactanos gap-4 mt-3 d-flex justify-content-center">
                    <a href="">
                        <img width="20px" src="https://tctelevision.nyc3.digitaloceanspaces.com/Noticias_wordpress/2023/10/facebook.png" alt="">
                    </a>
                    <a href="">
                        <img width="20px" src="https://tctelevision.nyc3.digitaloceanspaces.com/Noticias_wordpress/2023/10/instagram-1.png" alt="">
                    </a>
                    <a href="">
                        <img width="20px" src="https://tctelevision.nyc3.digitaloceanspaces.com/Noticias_wordpress/2023/10/twitter.webp" alt="">
                    </a>
                    <a href="">
                        <img width="20px" src="https://tctelevision.nyc3.digitaloceanspaces.com/Noticias_wordpress/2023/10/youtube.png" alt="">
                    </a>
                    <a href="">
                        <img width="20px" src="https://tctelevision.nyc3.digitaloceanspaces.com/Noticias_wordpress/2023/10/tik-tok.png" alt="">
                    </a>
                    <a href="">
                        <img width="20px" src="https://tctelevision.nyc3.digitaloceanspaces.com/Noticias_wordpress/2023/10/threads.png" alt="">
                    </a>
                </div>
            </div>
        </div>
        <div class="row copyright">
            <div class="col col-12">
                Copyright &copy; 2024 Grupo #4

            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const cantidadInput = document.querySelector("input[type='number']");
            const precioElemento = document.querySelector(".text-success.fs-4.fw-bold");
            const subtotalElemento = document.querySelector(".d-flex.justify-content-between.border-bottom.py-2 span:nth-child(2)");
            const totalElemento = document.getElementById("total");

            if (cantidadInput && precioElemento && subtotalElemento && totalElemento) {
                // Obtener el precio inicial desde el texto
                let precioUnitario = parseFloat(precioElemento.innerText.replace("$", ""));

                cantidadInput.addEventListener("input", function () {
                    let cantidad = parseInt(cantidadInput.value);

                    // Validar que la cantidad sea un número válido
                    if (isNaN(cantidad) || cantidad < 1) {
                        cantidad = 1;
                        cantidadInput.value = 1;
                    }

                    // Calcular subtotal
                    let subtotal = precioUnitario * cantidad;
                    subtotalElemento.innerText = "$" + subtotal.toFixed(2);
                    $("#subtotalP").text("$" + subtotal.toFixed(2));

                    // Calcular total con IVA (15%)
                    let total = subtotal * 1.15;
                    totalElemento.innerHTML = "<strong>$" + total.toFixed(2) + "</strong>";
                });
            }
        });
    </script>

<script>
    function aplicarCupon() {
        let codigoCupon = document.querySelector(".codigo").value.trim();
        
        if (codigoCupon === "") {
            document.getElementById("error-message").innerText = "Ingrese un código de cupón.";
            document.getElementById("error-message").style.display = "block";
            return;
        }

        fetch("validar_cupon.php", {
            method: "POST",
            body: new URLSearchParams({ cupon: codigoCupon }),
            headers: { "Content-Type": "application/x-www-form-urlencoded" }
        })
        .then(response => response.json())
        .then(data => {
            if (data.valido) {
                const cantidadInput = document.querySelector("input[type='number']");
                let cantidad = parseInt(cantidadInput.value)
                let descuentoPorcentaje = data.descuento; // Ejemplo: 20
                let precioOriginal = parseFloat(<?= $camiseta['precio'] ?>)* cantidad;
                let descuento = (precioOriginal * descuentoPorcentaje) / 100;
                let precioFinal = precioOriginal - descuento;

            document.getElementById("descuento").innerText = `-${descuentoPorcentaje}%`;
            document.getElementById("total").innerText = `$${precioFinal.toFixed(2)}`;
            document.getElementById("error-message").style.display = "none";
            } else {
                document.getElementById("error-message").innerText = "Cupón inválido o expirado.";
                document.getElementById("error-message").style.display = "block";
            }
        })
        .catch(error => console.error("Error en la validación del cupón:", error));
    }
</script>
</body>

</html>corrige el error