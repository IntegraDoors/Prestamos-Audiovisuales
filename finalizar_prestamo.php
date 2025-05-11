<?php
$conn = new mysqli('localhost', 'root', '', 'prestamos');
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$prestamo_id = $_POST['prestamo_id'];
$fecha_devolucion = date('Y-m-d H:i:s');

// Obtener equipo y sala del préstamo
$result = $conn->query("SELECT equipo_id, sala_id FROM prestamos WHERE id = '$prestamo_id'");
$data = $result->fetch_assoc();
$equipo_id = $data['equipo_id'];
$sala_id = $data['sala_id'];

// Marcar devolución
$conn->query("UPDATE prestamos SET fecha_devolucion = '$fecha_devolucion' WHERE id = '$prestamo_id'");

// Marcar equipo como disponible
$conn->query("UPDATE equipos SET disponible = 1 WHERE id = '$equipo_id'");

// Marcar sala como no ocupada
$conn->query("UPDATE salas SET ocupada = 0 WHERE id = '$sala_id'");

$conn->close();

echo "✅ Préstamo finalizado correctamente";
?>
