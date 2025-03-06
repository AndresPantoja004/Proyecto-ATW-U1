<?php
    // Iniciar la sesión
    session_start();

    // Leer el contenido del archivo JSON
    $json = file_get_contents("json/camisetas.json");
    // Convertir el JSON en un array de PHP
    $camisetas = json_decode($json, true);

    // Obtener el ID de la camiseta
    $id = $_GET["id"];
    // Buscar la camiseta con el ID especificado
    $camiseta = null;

    foreach ($camisetas as $c) {
        if ($c["id"] == $id) {
            $camiseta = $c;
            break;
        }
    }

    // Verificar si el usuario está logueado
    $usuarioLogueado = isset($_SESSION['usuario']);  // Esto verifica si la variable de sesión 'usuario' existe
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EspeStore</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script defer  src="js/bootstrap.bundle.min.js" ></script>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
      .form-group {
          flex: 1;
          min-width: 120px;
      }

      .container {
          width: 100%;
          height: 100%;
      }

      .img-fluid {
          width: 100%;
          height: 100%;
          object-fit: cover;
      }

      .error {
          border: 2px solid red;
      }

      .error-message {
          color: red;
          font-size: 0.9em;
          margin-top: 5px;
      }

    </style>
    <script defer src="js/jQueryV3.7.1.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
          const addToCartButton = document.querySelector(".btn-primary");
      
          addToCartButton.addEventListener("click", function (event) {
              event.preventDefault(); 
      
              const size = document.getElementById("size").value;
              const name = document.getElementById("name").value.trim();
              const dorsal = document.getElementById("dorsal").value.trim();
              const quantity = document.getElementById("quantity").value;
      
              
              const errorMessages = document.querySelectorAll(".error-message");
              errorMessages.forEach(message => message.remove());
      
              const inputs = document.querySelectorAll(".form-control, .form-select");
              inputs.forEach(input => input.classList.remove("error"));
      
              let isValid = true;
      
              if (size === "Seleccionar") {
                  showError(document.getElementById("size"), "Seleccionar talla");
                  isValid = false;
              }
      
              if (!/^[a-zA-Z\s]{1,10}$/.test(name)) {
                  showError(document.getElementById("name"), "Max 10 letras.");
                  isValid = false;
              }
      
              if (!/^\d{1,2}$/.test(dorsal)) {
                  showError(document.getElementById("dorsal"), "Max 2 dígitos.");
                  isValid = false;
              }
              if (isNaN(dorsal)) {
                  showError(document.getElementById("dorsal"), "Solo números.");
                  isValid = false;
              }
      
              if (parseInt(quantity) < 1 || isNaN(quantity)) {
                  showError(document.getElementById("quantity"), "Minimo 1 Unidad");
                  isValid = false;
              }
      
              if (!isValid) {
                  return; 
              } else {
                  alert("Producto añadido al carrito exitosamente.");                
              }
          });
      
          function showError(inputElement, message) {
              inputElement.classList.add("error");
      
              const errorMessage = document.createElement("div");
              errorMessage.classList.add("error-message");
              errorMessage.textContent = message;
      
              inputElement.parentElement.appendChild(errorMessage);
          }

          // Cerrar el modal al hacer clic en el botón
          $("#closeModal2").on("click", function() {
              $("#notFoundModal2").fadeOut();
          });

          // Cerrar el modal al hacer clic fuera de la caja
          $(".modal-overlay").on("click", function(e) {
              if (e.target === this) {
                  $(this).fadeOut();
              }
          });

      });
    </script>
</head>
<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <img src="img/logoEspe2.png" width="50" height="40" alt="blue">
      <a class=" espe navbar-brand"  style="color: #27e03d; " href="index.php" >EspeStore</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="home navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" style="color: white;" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" style="color: white;" >Ofertas</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" style="color: white;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Temporadas
            </a>
            <ul class="dropdown-menu" >
              <li><a class="dropdown-item" href="#">Temporada 24-25</a></li>
              <li><a class="dropdown-item" href="#">Temporada 23-24</a></li>                 
              <li><a class="dropdown-item" href="#">Temporada 22-23</a></li>
            </ul>
          </li>
        </ul>
        <div id="contain-car" class="container-car d-flex gap-3 justify-content-between p-2 m-2">
          <div>
            <svg width="24px" height="24px" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#ffffff"><path d="M19.5 22C20.3284 22 21 21.3284 21 20.5C21 19.6716 20.3284 19 19.5 19C18.6716 19 18 19.6716 18 20.5C18 21.3284 18.6716 22 19.5 22Z" fill="#ffffff" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M9.5 22C10.3284 22 11 21.3284 11 20.5C11 19.6716 10.3284 19 9.5 19C8.67157 19 8 19.6716 8 20.5C8 21.3284 8.67157 22 9.5 22Z" fill="#ffffff" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M5 4H22L20 15H7L5 4ZM5 4C4.83333 3.33333 4 2 2 2" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M20 15H7H5.23077C3.44646 15 2.5 15.7812 2.5 17C2.5 18.2188 3.44646 19 5.23077 19H19.5" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
          </div>
          <div>
             $ <span id="totalAcumulado"> 9999</span>
          </div>
        </div>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
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
  <div>
    <div class="container my-5">
      <form>
          <div class="row">
              <div class="col-md-6 text-center">
                  <img src="<?= $camiseta['imagen']; ?>" alt="Camiseta AC Milan" class="rounded-image" width="400" height="400">
              </div>
              <div class="col-md-6">
                  <h2 class="fw-bold"><?= $camiseta['nombre']; ?></h2>
                  <p class="text-success fs-4 fw-bold"><?= $camiseta['precio']; ?> </p>
                  <div class="mb-3 d-flex gap-3">
                      <div class="form-group flex-fill">
                          <label for="size" class="form-label">Talla</label>
                          <select id="size" class="form-select" name="size">
                              <option selected>Seleccionar</option>
                              <option value="S">S</option>
                              <option value="M">M</option>
                              <option value="L">L</option>
                              <option value="XL">XL</option>
                          </select>
                      </div>
                      <div class="form-group flex-fill">
                          <label for="name" class="form-label">Nombre</label>
                          <input type="text" id="name" class="form-control" name="nameNumber" placeholder="Nombre">
                      </div>
                      <div class="form-group flex-fill">
                          <label for="dorsal" class="form-label">Dorsal</label>
                          <input type="text" id="dorsal" class="form-control" name="dorsal" placeholder="Dorsal">
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                        <p class="fw-bold">Parches</p>
                        <div class="form-check ">
                            <input class="form-check-input" type="radio" name="patches" id="no-patches" value="Sin parches" checked>
                            <label class="form-check-label" for="no-patches">Sin parches</label>
                        </div>
                        <div class="form-check ">
                            <input class="form-check-input" type="radio" name="patches" id="serie-a" value="Serie A">
                            <label class="form-check-label" for="serie-a">Serie A</label>
                        </div>
                        <div class="form-check ">
                            <input class="form-check-input" type="radio" name="patches" id="champions" value="Champions League">
                            <label class="form-check-label" for="champions">Champions League</label><br>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p class="fw-bold">Versión camiseta</p>
                        <div class="form-check ">
                            <input class="form-check-input" type="radio" name="version" id="fan-version" value="Fan version" checked>
                            <label class="form-check-label" for="fan-version">Versión fan</label>
                        </div>
                        <div class="form-check ">
                            <input class="form-check-input" type="radio" name="version" id="player-version" value="Player version">
                            <label class="form-check-label" for="player-version">Versión jugador</label>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                      <input type="number" id="quantity" class="form-control" name="quantity" value="1" min="1" style="width: 70px;">
                      <p>Unidades</p>
                      <button type="submit" class="btn btn-primary">Añadir al carrito</button>
                      <p class="mt-3">
                      <a href="/detalleCompra.php?id=<?=$camiseta['id']?>" class="btn btn-warning">Ver carrito</a>
                      </p>
                    </div>
              </div>
          </div>
      </form>
  </div>
  </div>
<footer class="row footer bg-black text-white d-flex align-items-center justify-content-center row p-3 text-center mt-5 row">
  <div class="information-footer  d-flex flex-column gap-3 col-6  text-center d-flex align-items-center justify-content-center p-3">
    <div class="row">
      <h3 class="m-0 ">EspeFlex</h3> 
    </div>  
    <svg width="44px" height="44px" viewBox="0 0 24 24" stroke-width="1.5" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><path d="M6 4H9C9 4 9 7 12 7C15 7 15 4 15 4H18M18 11V19.4C18 19.7314 17.7314 20 17.4 20H6.6C6.26863 20 6 19.7314 6 19.4L6 11" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M18 4L22.4429 5.77717C22.7506 5.90023 22.9002 6.24942 22.7772 6.55709L21.1509 10.6228C21.0597 10.8506 20.8391 11 20.5938 11H18" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M5.99993 4L1.55701 5.77717C1.24934 5.90023 1.09969 6.24942 1.22276 6.55709L2.84906 10.6228C2.94018 10.8506 3.1608 11 3.40615 11H5.99993" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
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
      <h3 class="m-0" >Contactanos</h3>
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
</body>
</html>