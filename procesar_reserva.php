<?php
// Iniciar sesión para almacenar los resultados en la sesión
session_start();

// Incluir recursos de coches y usuarios
include_once 'recursos.php';

// Recoger datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$dni = $_POST['dni'];
$modelo = $_POST['modelo'];
$fecha_inicio = $_POST['fecha_inicio'];
$duracion = $_POST['duracion'];

// Función para validar el DNI (usando el algoritmo módulo 23)
function validarDNI($dni) {
    $letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
    $numero = substr($dni, 0, -1);
    $letra = strtoupper(substr($dni, -1));
    $letraCalculada = $letras[$numero % 23];
    return $letra === $letraCalculada;
}

// Validar datos del usuario
$usuario_valido = false;
foreach (USUARIOS as $usuario) {
    if ($usuario['dni'] === $dni && $usuario['nombre'] === $nombre && $usuario['apellido'] === $apellido) {
        $usuario_valido = true;
        break;
    }
}

// Validar datos de la reserva
$reserva_valida = true;
$mensaje_error = [];

if (!$usuario_valido) {
    $reserva_valida = false;
    $mensaje_error[] = "Usuario no encontrado o DNI inválido.";
}

if (!validarDNI($dni)) {
    $reserva_valida = false;
    $mensaje_error[] = "DNI inválido.";
}

$fecha_actual = date('Y-m-d');
if ($fecha_inicio <= $fecha_actual) {
    $reserva_valida = false;
    $mensaje_error[] = "La fecha de inicio debe ser posterior a la fecha actual.";
}

if ($duracion < 1 || $duracion > 30) {
    $reserva_valida = false;
    $mensaje_error[] = "La duración debe ser entre 1 y 30 días.";
}

// Comprobar disponibilidad del coche
$coche_disponible = false;
foreach ($coches as $coche) {
    if ($coche['modelo'] === $modelo && $coche['disponible']) {
        $coche_disponible = true;
        break;
    }
}

if (!$coche_disponible) {
    $reserva_valida = false;
    $mensaje_error[] = "El vehículo seleccionado no está disponible.";
}

// Almacenar los resultados y los datos del formulario en la sesión
$_SESSION['reserva_valida'] = $reserva_valida;
$_SESSION['mensaje_error'] = $mensaje_error;
$_SESSION['nombre'] = $nombre;
$_SESSION['apellido'] = $apellido;
$_SESSION['dni'] = $dni;
$_SESSION['modelo'] = $modelo;
$_SESSION['fecha_inicio'] = $fecha_inicio;
$_SESSION['duracion'] = $duracion;

// Redirigir a la página de resultado
header("Location: resultado.php");
exit();
?>


