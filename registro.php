<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuariosFile = "json/usuarios.json"; // Ubicación del archivo JSON
    $usuarios = json_decode(file_get_contents($usuariosFile), true); // Cargar los usuarios

    $correo = $_POST['email'];
    $nombre = $_POST['name'];
    $usuario = $_POST['user']; // Obtener el usuario
    $telefono = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptar la contraseña

    // Verificar si el usuario o correo ya existe
    foreach ($usuarios as $user) {
        if ($user['email'] == $correo || $user['usuario'] == $usuario) {
            echo json_encode(['status' => 'error', 'message' => 'Correo o usuario ya registrados']);
            exit();
        }
    }

    // Crear el nuevo usuario
    $newUser = [
        'usuario' => $usuario,
        'email' => $correo,
        'nombre' => $nombre,
        'telefono' => $telefono,
        'password' => $password,
    ];

    // Agregarlo a la lista de usuarios
    $usuarios[] = $newUser;

    // Guardar el archivo JSON
    file_put_contents($usuariosFile, json_encode($usuarios, JSON_PRETTY_PRINT));

    // Responder con éxito
    echo json_encode(['status' => 'success', 'message' => 'Cuenta creada correctamente']);
}
?>