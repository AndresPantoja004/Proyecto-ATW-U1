<?php
// Iniciar la sesión para obtener los datos del usuario
session_start();

// Ruta al archivo JSON donde guardaremos los carritos
$carritoFile = 'json/carritosUsuarios.json';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    echo json_encode(['success' => false, 'error' => 'Usuario no autenticado']);
    exit;
}

// Obtener el nombre de usuario de la sesión
$usuario = $_SESSION['usuario'];

// Obtener los datos enviados desde el frontend
$data = json_decode(file_get_contents('php://input'), true);

// Verificar si los datos son válidos (incluyendo la imagen)
if (isset($data['idCamiseta'], $data['nombre'], $data['precio'], $data['imagen'])) {
    // Leer el archivo JSON existente (si existe)
    if (file_exists($carritoFile)) {
        $jsonData = file_get_contents($carritoFile);
        $carritos = json_decode($jsonData, true);  // Convertir a array PHP
    } else {
        $carritos = [];
    }

    // Crear un nuevo carrito con el usuario de la sesión
    $nuevoCarrito = [
        'usuario' => $usuario,
        'idCamiseta' => $data['idCamiseta'],
        'nombre' => $data['nombre'],
        'precio' => $data['precio'],
        'imagen' => $data['imagen'],  // Añadir la imagen
        'vendido' => false
    ];

    // Agregar el nuevo carrito a la lista existente
    $carritos[] = $nuevoCarrito;

    // Guardar los datos en el archivo JSON
    if (file_put_contents($carritoFile, json_encode($carritos, JSON_PRETTY_PRINT))) {
        // Responder con éxito
        echo json_encode(['success' => true]);
    } else {
        // Si ocurrió un error al guardar el archivo
        echo json_encode(['success' => false, 'error' => 'Error al guardar el carrito']);
    }
} else {
    // Si los datos no son válidos (falta alguno de los campos requeridos)
    echo json_encode(['success' => false, 'error' => 'Datos inválidos']);
}
?>
