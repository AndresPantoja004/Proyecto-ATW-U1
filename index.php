<?php
  session_start(); // Iniciar sesión

  // Leer el contenido del archivo JSON
  $json = file_get_contents("json/camisetas.json");
  $camisetas = json_decode($json, true);

  // Verificar si el usuario ha iniciado sesión
  $usuario_logueado = isset($_SESSION['usuario']);
?>

<!DOCTYPE html>
<html lang="en">  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EspeStores</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
    <script defer  src="js/bootstrap.bundle.min.js" ></script>
    <script src="js/jQueryV3.7.1.js"></script>
    <script defer src="js/script.js" ></script>
    <script >
      $(document).ready(function() {
          $(".card").hover(
            function(){
            $(this).css({
                "transform": "scale(1.05)",
                "transition": "transform 0.3s ease-in-out",
                "cursor": "pointer",
                 "box-shadow": "0px 10px 20px rgb(124, 125, 123)"
            });
            },
            function(){
                $(this).css({
                    "transform": "scale(1)",
                    "transition": "transform 0.3s ease-in-out",
                    "box-shadow": "none"
                });
            }
          )
          $("#contain-car").click(function () {
              $(this).css("position", "relative")
                    .stop()
                    .animate({ left: "-30px" }, 350)
                    .animate({ left: "0px" }, 350);
          });
          $("form").on("submit", function(event) {
              event.preventDefault(); // Evita que la página se recargue
              var value = $(".form-control").val().toLowerCase(); // Obtener el texto del input en minúsculas
              var encontrar = false; // Variable para verificar si hay coincidencias
  
              $(".card").each(function() {
                  var cardText = $(this).find(".card-text").text().toLowerCase(); // Obtener el texto de la tarjeta
                  if (cardText.includes(value)) {
                      $(this).show(); // Mostrar si hay coincidencia
                      encontrar = true;  // Se encontró al menos una coincidencia
                  } else {
                      $(this).hide(); // Ocultar si no hay coincidencia
                  }
              });
              // Si no se encontró ninguna coincidencia, mostrar todas las tarjetas y alertar al usuario
              if (!encontrar) {
                  $(".card").show();
                  $("#notFoundModal").fadeIn(); // Mostrar el modal
              }
          });

          // Cerrar el modal al hacer clic en el botón
          $("#closeModal").on("click", function() {
              $("#notFoundModal").fadeOut();
          });
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

          $("#btnContact").click(function() {
              $("#notFoundModal2").fadeIn();
          });

              // Función para filtrar tarjetas según la temporada seleccionada
          function filtrarTarjetas(temporada) {
            $(".card").each(function () {
                  var cardText = $(this).find(".card-text").text();
                  if (cardText.includes(temporada)) {
                      $(this).show();  // Mostrar la tarjeta si coincide
                  } else {
                      $(this).hide();  // Ocultar la tarjeta si no coincide
                  }
              });
          }

          // Manejo de clics en los elementos del dropdown
          $("#temp24").click(function () {
              filtrarTarjetas("2024/2025");
          });

          $("#temp23").click(function () {
              filtrarTarjetas("2023/2024");
          });

          $("#temp22").click(function () {
              filtrarTarjetas("2022/2023");
          });

         
      });
  </script>
</head>
<body>
  <!--Modifico Camila-->
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
                  <li><a class="dropdown-item" id="temp24" href="#">Temporada 24-25</a></li>
                  <li><a class="dropdown-item" id="temp23" href="#">Temporada 23-24</a></li>                 
                  <li><a class="dropdown-item" id="temp22" href="#">Temporada 22-23</a></li>
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
            <?php if ($usuario_logueado): ?>
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
        <div class="row gap-3 justify-content-center">
          <?php foreach ($camisetas as $camiseta): ?>
              <div class="card" style="width: 18rem;">
                  <img src="<?= $camiseta['imagen']; ?>" class="card-img-to
                  p" alt="Imagen de <?= $camiseta['nombre']; ?>">
                  <div class="card-body">
                      <p class="card-text text-center h5"><?= $camiseta['nombre']; ?></p>
                      <span class="text-center d-flex justify-content-center">$<?= number_format($camiseta['precio'], 2); ?></span>
                  </div>
                  <div class="card-buttom justify-content-center d-flex mb-3">
                      <a href="/detalleProducto.php?id=<?=$camiseta['id']?>" class="btn btn-outline-success">Me interesa</a>
                  </div>
                  <p><?= $camiseta['id'] ?></p>
              </div>
          <?php endforeach; ?>
      </div>
      </div>
      <div style="display: none;"  id="notFoundModal" class="modal-overlay">
        <div class="modal-content">
            <p>Lo sentimos, pero no encontramos una camiseta relacionada con tu búsqueda.</p>
            <button id="closeModal">Cerrar</button>
        </div>
      </div>
      <div style="display: none;"  id="notFoundModal2" class="modal-overlay">
        <div class="modal-content">
          <h3>Contactanos</h3>
          <span>Av.Metropolitana Eloy Alfaro Km 1.5</span>
          <span>Portoviejo, Manabí 1301050</span>
          <span>Santo Domingo Gruas Jaramillo :o</span>
          <span>Telefonos: +593 52-933777</span>
          <span>virgiFueres@gmail.com </span>
          <button id="closeModal2">Cerrar</button>
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
      <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('server_info.php')
                .then(response => response.json())
                .then(data => {
                    alert('Servidor: ' + data.hostname + '\nIP: ' + data.ip);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
        </script>
</body>
</html>