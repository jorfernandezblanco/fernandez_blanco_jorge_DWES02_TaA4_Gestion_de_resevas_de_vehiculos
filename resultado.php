<?php
// Iniciar sesión para acceder a los datos almacenados en la sesión
session_start();

// Obtener los datos almacenados en la sesión
$reserva_valida = isset($_SESSION['reserva_valida']) ? $_SESSION['reserva_valida'] : false;
$nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '';
$apellido = isset($_SESSION['apellido']) ? $_SESSION['apellido'] : '';
$modelo = isset($_SESSION['modelo']) ? $_SESSION['modelo'] : '';
$duracion = isset($_SESSION['duracion']) ? $_SESSION['duracion'] : '';
$errores = isset($_SESSION['mensaje_error']) ? $_SESSION['mensaje_error'] : [];

// Incluir el archivo con los datos de los coches
include('recursos.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de la Reserva</title>
</head>
<body>
    <h1>Resultado de la Reserva</h1>

    <?php if ($reserva_valida): ?>
        <h2>Reserva Válida</h2>
        <p>Nombre: <?php echo htmlspecialchars($nombre) . ' ' . htmlspecialchars($apellido); ?></p>
        <p>Vehículo Seleccionado: <?php echo htmlspecialchars($modelo); ?></p>
        <p>Duración: <?php echo htmlspecialchars($duracion); ?> días</p>

        <!-- Buscar el coche en el array y mostrar la imagen correspondiente -->
        <?php 
        $imagen = '';
        foreach ($coches as $coche) {
            if (strtolower($coche['modelo']) == strtolower($modelo)) {
                $imagen = $coche['imagen']; // Obtener el nombre de la imagen
                break; // Salir del bucle una vez encontrado el coche
            }
        }

        if ($imagen) {
            echo "<img src='imagenes/$imagen' alt='Imagen del vehículo' />";
        } else {
            echo "<p>No se encontró la imagen del vehículo.</p>";
        }
    else: ?>
        <h2>Reserva No Válida</h2>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li style="color: red;"><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>

        <!-- Mostrar los campos incorrectos -->
        <ul>
            <li style="color: <?php echo in_array("Usuario no encontrado o DNI inválido.", $errores) ? 'red' : 'green'; ?>">Nombre y Apellido</li>
            <li style="color: <?php echo in_array("DNI inválido.", $errores) ? 'red' : 'green'; ?>">DNI</li>
            <li style="color: <?php echo in_array("La fecha de inicio debe ser posterior a la fecha actual.", $errores) ? 'red' : 'green'; ?>">Fecha de Inicio</li>
            <li style="color: <?php echo in_array("La duración debe ser entre 1 y 30 días.", $errores) ? 'red' : 'green'; ?>">Duración</li>
            <li style="color: <?php echo in_array("El vehículo seleccionado no está disponible.", $errores) ? 'red' : 'green'; ?>">Disponibilidad del Vehículo</li>
        </ul>
    <?php endif; ?>

    <!-- Limpiar los datos de la sesión para evitar mostrar información antigua en futuras cargas -->
    <?php session_unset(); ?>
</body>
</html>





