<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Reserva</title>
</head>
<body>
    <h1>Formulario de Reserva de Vehículo</h1>
    <form action="procesar_reserva.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre"><br><br>

        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido"><br><br>

        <label for="dni">DNI:</label>
        <input type="text" name="dni" id="dni"><br><br>

        <label for="modelo">Modelo del Vehículo:</label>
        <select name="modelo" id="modelo">
            <option value="Lancia Stratos">Lancia Stratos</option>
            <option value="Audi Quattro">Audi Quattro</option>
            <option value="Ford Escort RS1800">Ford Escort RS1800</option>
            <option value="Subaru Impreza 555">Subaru Impreza 555</option>
        </select><br><br>

        <label for="fecha_inicio">Fecha de Inicio:</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio"><br><br>

        <label for="duracion">Duración (en días):</label>
        <input type="number" name="duracion" id="duracion"><br><br>

        <input type="submit" value="Realizar Reserva">
    </form>
</body>
</html>




