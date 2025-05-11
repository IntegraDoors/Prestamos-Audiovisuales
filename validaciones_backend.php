<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = trim($_POST['usuario']);
    $equipo = trim($_POST['equipo']);
    $fecha_prestamo = $_POST['fecha_prestamo'];
    $fecha_devolucion = $_POST['fecha_devolucion'];

    if (empty($usuario) || empty($equipo) || empty($fecha_prestamo) || empty($fecha_devolucion)) {
        die("Todos los campos son obligatorios.");
    }

    if ($fecha_devolucion < $fecha_prestamo) {
        die("La fecha de devolución no puede ser anterior a la fecha de préstamo.");
    }

    // Luego insertas normalmente en la base de datos
}
?>
