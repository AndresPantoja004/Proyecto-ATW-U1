<?php
    // Leer cupones desde el archivo JSON
    $cuponesjson = file_get_contents("json/cupones.json");
    $cupones = json_decode($cuponesjson, true);

    // Verificar si se recibió un código de cupón
    if (isset($_POST['cupon'])) {
        $codigoCupon = $_POST['cupon'];
        $descuento = 0;
        
        // Buscar el cupón en el JSON
        foreach ($cupones as $cupon) {
            if ($cupon['cupon'] === $codigoCupon) {
                $descuento = $cupon['descuento']; // Obtener el valor del descuento (ejemplo: 20 para 20%)
                break;
            }
        }

        // Si el cupón es válido, devolver el porcentaje de descuento
        if ($descuento > 0) {
            echo json_encode(["valido" => true, "descuento" => $descuento]);
        } else {
            echo json_encode(["valido" => false]);
        }
    }
?>